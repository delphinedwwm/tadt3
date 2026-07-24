<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Le constructeur applique des middlewares pour limiter l'accès à certaines méthodes
     */
    public function __construct()
    {
        // Middleware pour gérer les autorisations d'accès pour les utilisateurs
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        // Récupère les utilisateurs, les trie par date de création et les pagine
        $data = User::latest()->paginate(5);

        // Retourne la vue 'users.index' avec la liste des utilisateurs
        // Utilisé pour gérer la numérotation des utilisateurs dans la vue
        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        // Récupère tous les rôles sous la forme d'un tableau [nom => nom] pour les afficher dans un formulaire de sélection
        $roles = Role::pluck('name', 'name')->all();

        // Retourne la vue 'users.create' avec les rôles
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation des données envoyées par le formulaire
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|same:confirm-password',
            'confirm-password' => 'required|min:8',
            'roles' => 'required|array'
        ]);

        try {
            // Créer l'utilisateur avec les données validées
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // Assigne les rôles sélectionnés à l'utilisateur
            $user->assignRole($request->input('roles'));

            // Redirige vers la liste des utilisateurs avec un message de succès
            return redirect()->route('users.index')
                ->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating user: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        // Récupère un utilisateur par son ID
        $user = User::findOrFail($id);

        // Retourne la vue 'users.show' avec les détails de l'utilisateur
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        // Récupère l'utilisateur par son ID
        $user = User::findOrFail($id);

        // Récupère tous les rôles disponibles
        $roles = Role::pluck('name', 'name')->all();

        // Récupère les rôles déjà assignés à cet utilisateur sous la forme d'un tableau
        $userRole = $user->roles->pluck('name', 'name')->all();

        // Retourne la vue 'users.edit' avec l'utilisateur, ses rôles et les rôles disponibles
        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Récupère l'utilisateur à mettre à jour
        $user = User::findOrFail($id);

        // Validation des données envoyées par le formulaire
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8|same:confirm-password',
            'confirm-password' => 'nullable|min:8',
            'roles' => 'required|array'
        ]);

        try {
            // Mettre à jour les données de l'utilisateur
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            // Si un nouveau mot de passe est fourni, il est haché et mis à jour
            if (!empty($validated['password'])) {
                $user->update([
                    'password' => Hash::make($validated['password']),
                ]);
            }

            // Synchroniser les rôles (supprime les anciens et réassigne les nouveaux)
            $user->syncRoles($request->input('roles'));

            // Redirige vers la liste des utilisateurs avec un message de succès
            return redirect()->route('users.index')
                ->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating user: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id): View
    {
        // Trouve l'utilisateur correspondant dans la base de données
        $user = User::findOrFail($id);

        // Passe l'utilisateur à la vue
        return view('users.delete', compact('user'));
    }

    /**
     * Supprime un utilisateur
     */
    public function destroy($id): RedirectResponse
    {
        try {
            // Trouve et supprime l'utilisateur par son ID
            $user = User::findOrFail($id);
            $user->delete();

            // Redirige vers la liste des utilisateurs avec un message de succès
            return redirect()->route('users.index')
                ->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }
}