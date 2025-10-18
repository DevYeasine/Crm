<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\EmailAccount;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\GmailService;


class EmailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;
        $emailAccounts = EmailAccount::where('tenant_id', $tenantId)->get();

        if($emailAccounts->isEmpty()){
            return redirect()->route('emailconnect.index');
        }

        $folder = $request->get('folder', 'inbox'); 
        $emails = Email::where('email_account_id', $emailAccounts->first()->id)
                    ->where('status', $folder)
                    ->latest()
                    ->paginate(10);

        return view('email.emails', compact('emails', 'emailAccounts', 'folder'));
    }

    public function syncEmails()
{
    $tenantId = auth()->user()->tenant_id;
    $emailAccount = EmailAccount::where('tenant_id', $tenantId)->first();
    
    if (!$emailAccount) {
        return redirect()->back()->with('error', 'No email account connected');
    }
    
    $gmailService = new GmailService();
    $emailsSynced = $gmailService->fetchEmails($emailAccount);
    
    return redirect()->route('emails.index')
        ->with('success', "Synced {$emailsSynced} new emails");
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
}
