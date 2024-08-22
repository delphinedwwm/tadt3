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
        $categories = category::latest()->paginate(5);

        // Retourne la vue 'categories.index' avec les données des catégories
        // Ajoute également une variable 'i' pour la pagination
        return view('categories.index',compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
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
        request()->validate([
            'name' => 'required',
            'color' => 'required',
            'type'  => 'required',
        ]);

        // Crée une nouvelle categorie avec les données validées
        category::create($request->all());

        // Redirige vers la liste des catégories avec un message de succès
        return redirect()->route('categories.index')
                        ->with('success','category created successfully.');
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
        request()->validate([
            'name' => 'required',
            'color' => 'required',
            'type'  => 'required',
        ]);

        // Met à jour les informations d'une catégorie avec les données validées
        $category->update($request->all());

        // Redirige vers la liste des catégories avec un message de succès
        return redirect()->route('categories.index')
                        ->with('success','category updated successfully');
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
