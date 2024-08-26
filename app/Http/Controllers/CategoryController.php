<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{ 
    /**
     * Constructeur de la classe qui définit les middlewares pour les permissions.
     */
    function __construct()
    {
        // Applique les permissions pour les actions index et show
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','show']]);
        // Applique les permissions pour les actions create et store
        $this->middleware('permission:category-create', ['only' => ['create','store']]);
        // Applique les permissions pour les actions edit et update
        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
        // Applique les permissions pour l'action destroy
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }

    /**
     * Affiche une liste paginée des produits.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        // Récupère les catégories les plus récents et les pagine par groupes de 5
        $categories = category::latest()->paginate(10);

        // Retourne la vue 'categories.index' avec les données des catégories
        // Ajoute également une variable 'i' pour la pagination
        return view('categories.index',compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Affiche le formulaire de création d'une nouvelle categorie.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        // Retourne la vue 'categories.create' pour afficher le formulaire de création
        return view('categories.create');
    }

    /**
     * Enregistre une nouvelle categorie dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
    // Valide les données du formulaire
    $request->validate([
        'name' => 'required',
        'type'  => 'required',
        'logo'  => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation du fichier image
    ]);

    // Utilisation du nom d'origine du fichier logo
    // $request->image->move(public_path('images'), $request->image->getClientOriginalName()); risque d'écraser un fichier existant si un autre utilisateur télécharge une image avec le même nom.

    // Utilisation d'un nom unique pour le fichier logo
    $logoName = time().'.'.$request->logo->getClientOriginalName(); // le nom unique permet d'éviter d'écraser une image existante avec le même nom.
    $request->logo->move(public_path('logos'), $logoName);

    // création d'une nouvelle category
    $category = new Category(); 
    $category->name = $request->name;
    $category->type = $request->type;
    $category->logo = 'logos/' . $logoName;
   
    // Sauvegarde la catégorie dans la base de données
    $category->save();

    // Redirige vers la liste des catégories avec un message de succès
    return redirect()->route('categories.index')
                    ->with('success', 'Category created successfully');
    }

    /**
     * Affiche les détails d'une catégorie spécifique.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\View\View
     */
    public function show($id): View
    {
        $category = Category::find($id);
        // Retourne la vue 'categories.show' avec les informations de la catégorie
        return view('categories.show',compact('category'));
    }

    /**
     * Affiche le formulaire d'édition d'une catégorie spécifique.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\View\View
     */
    public function edit(int $id_category): View
    {
        // dump('yoyo');
        // 
        $category = Category::findOrFail($id_category);
        
        // dd($category->name);

        // Retourne la vue 'categories.edit' avec les informations de la catégorie à éditer
        return view('categories.edit',compact('category'));
    }

    /**
     * Met à jour une catégorie existante dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id_category): RedirectResponse
{
    $category = Category::findOrFail($id_category);

    // Valide les données du formulaire
    $validated = $request->validate([
        'name' => 'required',
        'type'  => 'required',
        'logo'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation du fichier image
    ]);

    // Gère l'upload du logo
    if ($request->hasFile('logo')) {
        // méthode hasFile() pour vérifier si un fichier a été téléchargé avec la clé 'logo' dans la requête.
    
        // Supprimer l'ancien logo si nécessaire
        if ($category->logo && file_exists(public_path($category->logo))) {
            unlink(public_path($category->logo));
        }
        
        // Sauvegarder le nouveau logo
        $logoName = time().'.'.$request->logo->extension();
        $request->logo->move(public_path('logos'), $logoName);
        $category->logo = 'logos/' . $logoName;
    }   
        
     // Mise à jour des autres champs
     $category->name = $request->name;
     $category->type = $request->type;
     $category->save();

    // Redirige vers la liste des catégories avec un message de succès
    return redirect()->route('categories.index')
                    ->with('success', 'Category updated successfully');
}


    /**
     * Supprime une catégorie de la base de données.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        // Trouver la category correspondante dans la base de données
        $category = category::findOrFail($id);

        // Passer la category à la vue
        return view('categories.delete', compact('category'));
    }

    public function destroy(int $id_category): RedirectResponse
    {
        $category = Category::findOrFail($id_category);
        // Supprime la catégorie
        $category->delete();

        // Redirige vers la liste des catégories avec un message de succès
        return redirect()->route('categories.index')
                        ->with('success','category deleted successfully');
    }
}
