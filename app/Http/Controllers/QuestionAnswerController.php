<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuestionAnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:questionanswer-list|questionanswer-create|questionanswer-edit|questionanswer-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:questionanswer-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:questionanswer-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:questionanswer-delete', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        $questions = Question::with('answers')->latest()->paginate(15);
        $categories = Category::all();

        return view('questionsanswers.index', compact('categories', 'questions'))
            ->with('i', (request()->input('page', 1) - 1) * 15);
    }

    public function show($id): View
    {
        $question = Question::with('answers')->findOrFail($id);
        return view('questionsanswers.show', compact('question'));
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('questionsanswers.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'question' => 'required|string|max:200',
            'level' => 'required|integer|min:1|max:3',
            'category_id' => 'required|integer|min:1|exists:categories,id',
            'answers' => 'required|array|size:4',
            'answers.*.description' => 'required|string|max:400',
            'correct_answer' => 'required|integer|min:0|max:3',
        ]);

        $existingQuestion = Question::where('question', $validated['question'])->first();
        if ($existingQuestion) {
            return redirect()->back()
                ->withErrors(['question' => 'La question existe déjà.'])
                ->withInput();
        }

        $question = Question::create([
            'question' => $validated['question'],
            'level' => $validated['level'],
            'category_id' => $validated['category_id'],
            'user_id' => auth()->id(),
        ]);

        foreach ($validated['answers'] as $index => $answerData) {
            Answer::create([
                'description' => $answerData['description'],
                'is_correct' => $index == $validated['correct_answer'],
                'question_id' => $question->id,
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
        $validated = $request->validate([
            'question' => 'required|string|max:200',
            'level' => 'required|integer|min:1|max:3',
            'category_id' => 'required|integer|min:1|exists:categories,id',
            'answers' => 'required|array',
            'answers.*.id' => 'required|integer|exists:answers,id',
            'answers.*.description' => 'required|string|max:400',
            'correct_answer' => 'required|integer|min:0|max:3',
        ]);

        $question = Question::findOrFail($id);
        $question->update([
            'question' => $validated['question'],
            'level' => $validated['level'],
            'category_id' => $validated['category_id'],
        ]);

        foreach ($validated['answers'] as $index => $answerData) {
            $answer = Answer::findOrFail($answerData['id']);
            $answer->update([
                'description' => $answerData['description'],
                'is_correct' => $index == $validated['correct_answer'],
            ]);
        }

        return redirect()->route('questionsanswers.index')
            ->with('success', 'Question et réponses mises à jour avec succès.');
    }

    public function delete($id): View
    {
        $question = Question::findOrFail($id);
        return view('questionsanswers.delete', compact('question'));
    }

    public function destroy($id): RedirectResponse
    {
        $question = Question::findOrFail($id);
        $question->answers()->delete();
        $question->delete();

        return redirect()->route('questionsanswers.index')
            ->with('success', 'Question et réponses supprimées avec succès.');
    }
}