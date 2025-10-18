<?php

namespace App\Http\Controllers;

use App\Models\EmailAccount;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class EmailAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('email.connect-email');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function redirectToGoogle()
{
    return Socialite::driver('google')
            ->scopes(['https://www.googleapis.com/auth/gmail.readonly'])
            ->redirect();
}

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = auth()->user();
            $tenantId = $user->tenant_id;

            EmailAccount::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'tenant_id' => $tenantId,
                    'email' => $googleUser->getEmail(),
                    'provider' => 'gmail',
                ],
                [
                    'access_token' => $googleUser->token,
                    'refresh_token' => $googleUser->refreshToken,
                    'token_expires_at' => now()->addSeconds($googleUser->expiresIn),
                ]
            );

            return redirect()->route('emails.index')->with('success', 'Gmail connected successfully!');

        } catch (Exception $e) {
            return redirect()->route('emailconnect.index')
                ->with('error', 'Failed to connect Gmail: ' . $e->getMessage());
        }
    }
}