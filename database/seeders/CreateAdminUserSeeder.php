<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Crée les rôles et assigne les permissions
     * RESPONSABILITÉ UNIQUE : Gérer les rôles et permissions
     */
    public function run(): void
    {
        // ===== CRÉER LES RÔLES =====
        
        // Rôle Admin
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions(Permission::all());

        // Rôle User standard
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->syncPermissions(['play-game']);
    }
}