<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $modules = [
            'leads', 'deals', 'projects', 'contacts', 
            'tasks', 'emails', 'notes', 'invoices', 
            'products', 'automations', 'integrations', 
            'team-members'
        ];

        // Common actions (without "send emails")
        $actions = ['view', 'create', 'edit', 'delete', 'export', 'assign', 'status-change'];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => $action.' '.$module,
                    'guard_name' => 'web',
                ]);
            }
        }

        // Only for emails module
        Permission::firstOrCreate([
            'name' => 'send emails',
            'guard_name' => 'web',
        ]);

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
