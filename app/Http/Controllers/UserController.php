<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Affiche une liste paginée des utilisateurs.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        // Récupère les utilisateurs les plus récents et les pagine par groupes de 5
        $data = User::latest()->paginate(5);

        // Retourne la vue 'users.index' avec les données des utilisateurs
        // Ajoute également une variable 'i' pour la pagination
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Affiche le formulaire de création d'un nouvel utilisateur.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        // Récupère tous les rôles sous forme de liste clé-valeur
        $roles = Role::pluck('name','name')->all();

        // Retourne la vue 'users.create' avec les rôles
        return view('users.create',compact('roles'));
    }

    /**
     * Enregistre un nouvel utilisateur dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Valide les données du formulaire
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        // Récupère toutes les données du formulaire
        $input = $request->all();
        // Hash le mot de passe avant de le sauvegarder
        $input['password'] = Hash::make($input['password']);

        // Crée un nouvel utilisateur avec les données validées
        $user = User::create($input);
        // Assigne les rôles sélectionnés à l'utilisateur
        $user->assignRole($request->input('roles'));

        // Redirige vers la liste des utilisateurs avec un message de succès
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    /**
     * Affiche les détails d'un utilisateur spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id): View
    {
        // Récupère un utilisateur par son ID
        $user = User::find($id);

        // Retourne la vue 'users.show' avec les informations de l'utilisateur
        return view('users.show',compact('user'));
    }

    /**
     * Affiche le formulaire d'édition d'un utilisateur spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id): View
    {
        // Récupère un utilisateur par son ID
        $user = User::find($id);
        // Récupère tous les rôles sous forme de liste clé-valeur
        $roles = Role::pluck('name','name')->all();
        // Récupère les rôles actuels de l'utilisateur sous forme de liste clé-valeur
        $userRole = $user->roles->pluck('name','name')->all();

        // Retourne la vue 'users.edit' avec les informations de l'utilisateur et les rôles
        return view('users.edit',compact('user','roles','userRole'));
    }

    /**
     * Met à jour un utilisateur existant dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Valide les données du formulaire
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        // Récupère toutes les données du formulaire
        $input = $request->all();
        // Si le mot de passe est fourni, le hash et l'inclut dans les données
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        } else {
            // Sinon, exclut le mot de passe des données
            $input = Arr::except($input, ['password']);    
        }

        // Récupère un utilisateur par son ID
        $user = User::find($id);
        // Met à jour les informations de l'utilisateur
        $user->update($input);

        // Supprime les rôles actuels de l'utilisateur
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        // Assigne les nouveaux rôles à l'utilisateur
        $user->assignRole($request->input('roles'));

        // Redirige vers la liste des utilisateurs avec un message de succès
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Supprime un utilisateur de la base de données.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        // Supprime l'utilisateur par son ID
        User::find($id)->delete();

        // Redirige vers la liste des utilisateurs avec un message de succès
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}
