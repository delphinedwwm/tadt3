<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer un utilisateur administrateur
        $adminUser = User::create([
            'name' => 'Delphine', 
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456')
        ]);

        // Créer un utilisateur standard
        $standardUser = User::create([
            'name' => 'User Standard', 
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456')
        ]);

         // Création du rôle admin et assignation de toutes les permissions
         $adminRole = Role::create(['name' => 'admin']);
         $adminRole->givePermissionTo(Permission::all());
 
         // Création du rôle utilisateur et assignation uniquement à l'accès au jeu
         $userRole = Role::create(['name' => 'user']);
         $userRole->givePermissionTo('play-game');
        
        // Assigner le rôle 'Admin' à l'utilisateur Admin
        $adminUser->assignRole($adminRole);
        
        // Assigner le rôle 'User' à l'utilisateur standard
        $standardUser->assignRole($userRole);
    }
}