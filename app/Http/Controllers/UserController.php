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
    // Le constructeur applique des middlewares pour limiter l'accès à certaines méthodes
    public function __construct()
    {
        // Middleware pour gérer les autorisations d'accès pour les utilisateurs
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
        // $this->middleware('permission:user-create', ['only' => ['create','store']]);
        // $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:user-delete', ['only' => ['destroy']]);
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
        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5); // Utilisé pour gérer la numérotation des utilisateurs dans la vue
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        // Récupère toutes les données du formulaire
        $input = $request->all();

        // Hache le mot de passe avant de le stocker
        $input['password'] = Hash::make($input['password']);

        // Crée un nouvel utilisateur avec les données du formulaire
        $user = User::create($input);

        // Assigne les rôles sélectionnés à l'utilisateur
        $user->assignRole($request->input('roles'));

        // Redirige vers la liste des utilisateurs avec un message de succès
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
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
        $user = User::find($id);

        // Retourne la vue 'users.show' avec les détails de l'utilisateur
        return view('users.show',compact('user'));
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
        $user = User::find($id);

        // Récupère tous les rôles disponibles
        $roles = Role::pluck('name','name')->all();

        // Récupère les rôles déjà assignés à cet utilisateur sous la forme d'un tableau
        $userRole = $user->roles->pluck('name','name')->all();

        // Retourne la vue 'users.edit' avec l'utilisateur, ses rôles et les rôles disponibles
        return view('users.edit',compact('user','roles','userRole'));
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
        // Validation des données envoyées par le formulaire
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        // Récupère toutes les données du formulaire
        $input = $request->all();

        // Si un nouveau mot de passe est fourni, il est haché et mis à jour
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            // Si aucun mot de passe n'est fourni, on enlève cette entrée du tableau
            $input = Arr::except($input,array('password'));    
        }
    
        // Récupère l'utilisateur à mettre à jour
        $user = User::find($id);

        // Met à jour l'utilisateur avec les nouvelles données
        $user->update($input);

        // Supprime les anciens rôles de l'utilisateur
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        // Assigne les nouveaux rôles sélectionnés
        $user->assignRole($request->input('roles'));
    
        // Redirige vers la liste des utilisateurs avec un message de succès
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function delete($id)
     {
         // Trouve l'utilisateur correspondant dans la base de données
         $user = User::findOrFail($id);
        //  dd($user);
 
         // Passe l'utilisateur à la vue
         return view('users.delete', compact('user'));
     } 
    public function destroy($id): RedirectResponse
    {
        // Supprime l'utilisateur par son ID
        User::find($id)->delete();

        // Redirige vers la liste des utilisateurs avec un message de succès
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}