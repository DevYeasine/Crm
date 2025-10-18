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
    Route::post('/emails/sync', [EmailsController::class, 'syncEmails'])->name('emails.sync');
    Route::get('emails/folder/{folder}', [EmailsController::class, 'index'])->name('emails.folder');

    // ✅ FIRST - Google routes (resource-এর আগে)
    Route::get('/emailconnect/google', [EmailAccountController::class, 'redirectToGoogle'])->name('emailconnect.google');
    Route::get('/emailconnect/google/callback', [EmailAccountController::class, 'handleGoogleCallback'])->name('emailconnect.google.callback');

    // ✅ THEN - Resource route
    Route::resource('/emailconnect', EmailAccountController::class);

    // Test route
    Route::get('/test-auth-google', function() {
        try {
            echo "User: " . auth()->user()->email . "<br>";
            echo "Testing Google from within auth middleware...<br>";
            
            return Socialite::driver('google')->redirect();
            
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    });

    Route::resource('/automations', AutomationsController::class);
    Route::resource('/integrations', IntegrationsController::class);
    Route::resource('/team-members', TeamMembersController::class);
});

Route::get('/test-google-debug', function() {
    try {
        if (!auth()->check()) {
            return "Not logged in";
        }
        
        echo "User: " . auth()->user()->email . "<br>";
        echo "Starting Google redirect...<br>";
        
        // Redirect URL টা先 দেখে নিন
        $redirectUrl = Socialite::driver('google')
            ->scopes(['https://www.googleapis.com/auth/gmail.readonly'])
            ->redirect()
            ->getTargetUrl();
            
        echo "Google OAuth URL: <br>";
        echo "<a href='" . $redirectUrl . "' target='_blank'>" . $redirectUrl . "</a>";
        echo "<br><br>";
        echo "এই লিঙ্কে ক্লিক করুন Google OAuth-এ যাওয়ার জন্য";
        
        return;
        
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

Route::get('/debug-config', function() {
    echo "GOOGLE_CLIENT_ID: " . config('services.google.client_id') . "<br>";
    echo "GOOGLE_CLIENT_SECRET: " . config('services.google.client_secret') . "<br>";
    echo "GOOGLE_REDIRECT_URI: " . config('services.google.redirect') . "<br>";
    
    // Check if values are coming from .env
    echo "ENV CLIENT_ID: " . env('GOOGLE_CLIENT_ID') . "<br>";
    
    return "Config debug complete";
});

Route::get('/manual-google-oauth', function() {
    $clientId = config('services.google.client_id');
    $redirectUri = config('services.google.redirect');
    
    if (empty($clientId)) {
        return "ERROR: GOOGLE_CLIENT_ID is empty!";
    }
    
    $authUrl = "https://accounts.google.com/o/oauth2/auth?" . http_build_query([
        'client_id' => $clientId,
        'redirect_uri' => $redirectUri,
        'response_type' => 'code',
        'scope' => 'https://www.googleapis.com/auth/gmail.readonly https://www.googleapis.com/auth/gmail.send https://www.googleapis.com/auth/gmail.modify',
        'access_type' => 'offline',
        'prompt' => 'consent'
    ]);
    
    echo "Manual OAuth URL: <br>";
    echo "<a href='" . $authUrl . "' target='_blank'>" . $authUrl . "</a>";
    return;
});


Route::get('/fixed-google-oauth', function() {
    try {
        // Explicitly pass config
        $socialite = Socialite::driver('google')
            ->with([
                'client_id' => config('services.google.client_id'),
                'redirect_uri' => config('services.google.redirect')
            ]);
            
        $redirectUrl = $socialite->redirect()->getTargetUrl();
        
        echo "Fixed OAuth URL: <br>";
        echo "<a href='" . $redirectUrl . "' target='_blank'>" . $redirectUrl . "</a>";
        return;
        
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

Route::get('/test-final-oauth', function() {
    $clientId = config('services.google.client_id');
    $redirectUri = config('services.google.redirect');
    
    echo "Using Client ID: " . $clientId . "<br>";
    
    $authUrl = "https://accounts.google.com/o/oauth2/auth?" . http_build_query([
        'client_id' => $clientId,
        'redirect_uri' => $redirectUri,
        'response_type' => 'code',
        'scope' => 'https://www.googleapis.com/auth/gmail.readonly',
        'access_type' => 'offline',
        'prompt' => 'consent'
    ]);
    
    echo "<a href='$authUrl' target='_blank'>Test Google OAuth</a>";
    return;
});

Route::get('/test-fixed', function() {
    try {
        echo "1. Testing Socialite...<br>";
        
        // Check if Socialite class exists
        if (class_exists('Laravel\\Socialite\\Facades\\Socialite')) {
            echo "2. Socialite class found!<br>";
        } else {
            echo "2. Socialite class NOT found!<br>";
            return;
        }
        
        $redirect = Socialite::driver('google')->redirect();
        echo "3. Redirect created successfully!<br>";
        
        return $redirect;
        
    } catch (Exception $e) {
        echo "ERROR: " . $e->getMessage() . "<br>";
        return;
    }
});

// Route::get('/debug-google', function() {
//     try {
//         echo "1. Starting Google redirect...<br>";
        
//         $redirect = Socialite::driver('google')->redirect();
//         echo "2. Redirect object created<br>";
        
//         return $redirect;
        
//     } catch (\Exception $e) {
//         echo "Error: " . $e->getMessage();
//         echo "<br>File: " . $e->getFile();
//         echo "<br>Line: " . $e->getLine();
//         return;
//     }
// });