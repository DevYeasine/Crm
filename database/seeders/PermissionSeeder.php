<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            'leads', 'deals', 'projects', 'contacts', 
            'tasks', 'emails', 'notes', 'invoices', 
            'products', 'automations', 'integrations', 
            'team-members'
        ];

        $actions = ['view', 'create', 'edit', 'delete', 'export', 'assign', 'status-change'];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => $action.' '.$module]);
            }
        }
    }
}
