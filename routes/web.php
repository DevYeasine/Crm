<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AutomationsController,
    ContactsController,
    DashboardController,
    LeadsController,
    DealsController,
    ProjectsController,
    TasksController,
    EventsController,
    EmailsController,
    IntegrationsController,
    TeamMembersController,
    EmailAccountController
};
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});
//Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/leads', LeadsController::class);
    Route::resource('/deals', DealsController::class);
    Route::resource('/projects', ProjectsController::class);
    Route::resource('/contacts', ContactsController::class);
    Route::resource('/tasks', TasksController::class);
    Route::resource('/events', EventsController::class);
    Route::resource('/emails', EmailsController::class);
    Route::resource('/emailconnect', EmailAccountController::class);
    Route::get('emails/folder/{folder}', [EmailsController::class, 'index'])->name('emails.folder');

    Route::get('/emailconnect/google', [EmailAccountController::class, 'redirectToGoogle'])->name('emailconnect.google');
    Route::get('/emailconnect/google/callback', [EmailAccountController::class, 'handleGoogleCallback'])->name('emailconnect.google.callback');


    Route::resource('/automations', AutomationsController::class);
    Route::resource('/integrations', IntegrationsController::class);
    Route::resource('/team-members', TeamMembersController::class);
});


Route::get('/debug-google', function() {
    try {
        echo "1. Starting Google redirect...<br>";
        
        $redirect = Socialite::driver('google')->redirect();
        echo "2. Redirect object created<br>";
        
        return $redirect;
        
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
        echo "<br>File: " . $e->getFile();
        echo "<br>Line: " . $e->getLine();
        return;
    }
});