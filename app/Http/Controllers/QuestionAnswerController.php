<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class QuestionAnswerController extends Controller
{
    /**
     * Constructeur de la classe qui définit les middlewares pour les permissions.
     */
    function __construct()
    {
        // Applique les permissions pour les actions index et show
        $this->middleware('permission:questionanswer-list|questionanswer-create|questionanswer-edit|questionanswer-delete', ['only' => ['index', 'show']]);
        // Applique les permissions pour les actions create et store
        $this->middleware('permission:questionanswer-create', ['only' => ['create', 'store']]);
        // Applique les permissions pour les actions edit et update
        $this->middleware('permission:questionanswer-edit', ['only' => ['edit', 'update']]);
        // Applique les permissions pour l'action destroy
        $this->middleware('permission:questionanswer-delete', ['only' => ['destroy']]);
    }

    // Pour les Questions
    public function index(): View
    {
        // Récupérer toutes les questions (vous pouvez ajouter des conditions si nécessaire)
        $questions = Question::with('answers')->latest()->paginate(15);

        // Récupérer toutes les catégories
        $categories = Category::all();
        
        return view('questionsanswers.index', compact('categories', 'questions'))
            ->with('i', (request()->input('page', 1) - 1) * 15);
    }

    public function show($id): View
    {
        $question  = Question::with('answers')->findOrFail($id);
        return view('questionsanswers.show', compact('question'));
    }

    public function create(): View
    {
        // Assurez-vous de passer les catégories disponibles à la vue
        $categories = Category::all();
        return view('questionsanswers.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Valider les données envoyées dans la requête
        $validated = $request->validate([
            'question' => 'required|string|max:200',
            'level' => 'required|integer|min:1|max:3',
            'category_id' => 'required|integer|min:1',
            'answers' => 'required|array|size:4', // Exactement 4 réponses attendues', // S'assurer qu'il y a au moins deux réponses
            'answers.*.description' => 'required|string', // Valider la description de chaque réponse
            'correct_answer' => 'required|integer', // Valider la réponse correcte (doit être un entier)
        ]);

        // Vérifier si la question existe déjà
        $existingQuestion = Question::where('question', $request->input('question'))->first();
        if ($existingQuestion) {
            return redirect()->back()->withErrors(['question' => 'La question existe déjà.'])->withInput();
        }

        // Récupérer l'ID de la dernière question et l'incrémenter de 1
        $lastQuestion = Question::latest()->first();
        $nextId = $lastQuestion ? $lastQuestion->id + 1 : 1;

        // Récupérer la catégorie par son ID
        $category = Category::findOrFail($request->input('category_id'));

        // Créer la question avec l'ID incrémenté
        $question = Question::create([
            'id' => $nextId,
            'question' => $validated['question'],
            'level' => $validated['level'],
            'category_id' => $validated['category_id'],
            'user_id' => auth()->id(),  // Récupérer l'ID de l'utilisateur authentifié
        ]);

        // Créer les réponses associées pour les entrer dans la base de données
        foreach ($validated['answers'] as $index => $answerData) {
            Answer::create([
                'description' => $answerData['description'],
                'is_correct' => $index == $validated['correct_answer'], // Marque la bonne réponse
                'question_id' => $question->id, // Associe la réponse à la question
            ]);
        }

        return redirect()->route('questionsanswers.index')
            ->with('success', 'Question et réponses créées avec succès.');
    }
    

    public function edit($id): View
    {
        $question = Question::findOrFail($id);
        $answers = $question->answers;
        $categories = Category::all(); 
        return view('questionsanswers.edit', compact('question', 'answers', 'categories'));
    }

    public function update(Request $request, $id): RedirectResponse
{
    $request->validate([
        'question' => 'required|string|max:200',
        'level' => 'required|integer|min:1|max:3',
        'category_id' => 'required|integer|min:1|exists:categories,id', 
        'answers.*.description' => 'string|max:400',
        'correct_answer' => 'required|integer|min:0|max:3', // pour s'assurez-vous qu'une réponse correcte est sélectionnée
    ]);

    $question = Question::findOrFail($id);
    $question->update([
        'question' => $request->input('question'),
        'level' => $request->input('level'),
        'category_id' => $request->input('category_id'),
        // 'updated_by' => auth()->id(), // Mettre à jour par l'utilisateur authentifié
    ]);

    // Mettre à jour les réponses associées
    foreach ($request->input('answers') as $index => $answerData) {
        $answer = Answer::findOrFail($answerData['id']);
        $answer->update([
            'description' => $answerData['description'],
            // Compare l'index courant avec la valeur de `correct_answer` pour déterminer si cette réponse est correcte
            'is_correct' => $index == $request->input('correct_answer'),
        ]);
    }

    return redirect()->route('questionsanswers.index')->with('success', 'Question et réponses mises à jour avec succès.');
    }

    public function delete($id)
    {
        // Trouver la question correspondante dans la base de données
        $question = Question::findOrFail($id);

        // Passer la question à la vue
        return view('questionsanswers.delete', compact('question'));
    }
    public function destroy($id): RedirectResponse
    {
        // Trouve la question à supprimer
        $question = Question::findOrFail($id); // findOrFail = méthode utilisée pour récupérer un modèle par sa clé primaire (ID) à partir de la base de données
        $question->answers()->delete();
        $question->delete();

        // Redirige l'utilisateur vers la page index 
        return redirect()->route('questionsanswers.index')->with('success', 'Question et réponses supprimées avec succès.');

     
    }
}
