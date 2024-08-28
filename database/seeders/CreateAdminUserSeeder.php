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
            'name' => 'Delphine Moulin', 
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456')
        ]);

        // Créer un utilisateur standard
        $standardUser = User::create([
            'name' => 'User Standard', 
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456')
        ]);

        // Créer un rôle 'Admin'
        $adminRole = Role::create(['name' => 'Admin']);
        
        // Créer un rôle 'User'
        $userRole = Role::create(['name' => 'User']);
        
        // Assigner toutes les permissions au rôle 'Admin'
        $adminRole->syncPermissions(Permission::all());
        
        // Assigner des permissions spécifiques au rôle 'User'
        $userPermissions = [
            'category-list',
            'questionanswer-list',
        ];
        $userRole->syncPermissions($userPermissions);
        
        // Assigner le rôle 'Admin' à l'utilisateur Admin
        $adminUser->assignRole($adminRole);
        
        // Assigner le rôle 'User' à l'utilisateur standard
        $standardUser->assignRole($userRole);
    }
}