<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Admin role
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        // Manager role
        $manager = Role::firstOrCreate(['name' => 'manager']);
        $manager->givePermissionTo([
            'view leads', 'create leads', 'edit leads', 'delete leads', 'assign leads', 'status-change leads',
            'view deals', 'create deals', 'edit deals', 'delete deals', 'assign deals', 'status-change deals',
            'view projects', 'create projects', 'edit projects', 'delete projects', 'assign projects',
            'view contacts', 'create contacts', 'edit contacts', 'delete contacts',
            'view tasks', 'create tasks', 'edit tasks', 'delete tasks', 'assign tasks',
            'view invoices', 'create invoices', 'edit invoices', 'delete invoices',
            'view products', 'create products', 'edit products', 'delete products',
            'view emails', 'send emails',
            'view notes', 'create notes', 'edit notes', 'delete notes',
            'view automations', 'create automations',
            'view integrations',
            'view team-members', 'add team-members'
        ]);

        // Team Leader role
        $teamLeader = Role::firstOrCreate(['name' => 'team-leader']);
        $teamLeader->givePermissionTo([
            'view leads', 'create leads', 'edit leads', 'status-change leads',
            'view deals', 'create deals', 'edit deals',
            'view projects', 'create projects', 'edit projects',
            'view tasks', 'create tasks', 'edit tasks', 'assign tasks',
            'view contacts', 'create contacts', 'edit contacts',
            'view notes', 'create notes', 'edit notes',
            'view invoices',
            'view products',
            'view emails', 'send emails'
        ]);

        // User role
        $user = Role::firstOrCreate(['name' => 'user']);
        $user->givePermissionTo([
            'view leads', 'edit leads',
            'view deals',
            'view projects', 'edit projects',
            'view tasks', 'edit tasks',
            'view contacts',
            'view notes', 'create notes',
            'view invoices',
            'view products',
            'view emails', 'send emails'
        ]);
    }
}
