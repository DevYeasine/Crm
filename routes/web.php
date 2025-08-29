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
    TeamMembersController
};

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/dashboard', DashboardController::class);
Route::resource('/leads', LeadsController::class);
Route::resource('/deals', DealsController::class);
Route::resource('/projects', ProjectsController::class);
Route::resource('/contacts', ContactsController::class);
Route::resource('/tasks', TasksController::class);
Route::resource('/events', EventsController::class);
Route::resource('/emails', EmailsController::class);
Route::resource('/automations', AutomationsController::class);
Route::resource('/integrations', IntegrationsController::class);
Route::resource('/team-members', TeamMembersController::class);

