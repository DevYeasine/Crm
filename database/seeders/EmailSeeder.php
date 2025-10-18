<?php

namespace Database\Seeders;

use App\Models\Email;
use App\Models\EmailAccount;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = Tenant::all();

        $tenants->each(function($tenant) {
            Email::factory()->count(rand(1, 10))->create([
                'tenant_id' => $tenant->id
            ]);
        });


        
        $emailAccount = EmailAccount::where('email', 'mohammadziaurrahmansarkar@gmail.com')->first();
        Email::create([
        'email_account_id' => $emailAccount->id,
        'subject' => 'Welcome to our CRM',
        'from_email' => 'support@company.com',
        'body' => 'Thank you for joining our CRM system...',
        'folder' => 'inbox',
        'status' => 'inbox', 
        'direction' => 'incoming',
        'tenant_id' => 5,
    ]);
    }
}
