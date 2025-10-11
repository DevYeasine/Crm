<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\EmailAccount;
use Illuminate\Http\Request;

class EmailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $folder = $request->get('folder', 'inbox'); // default inbox

        $emails = Email::query();

        if ($folder == 'inbox') {
            $emails->where('direction', 'incoming')
                ->where('status', 'inbox');
        } elseif ($folder == 'sent') {
            $emails->where('direction', 'outgoing')
                ->where('status', 'sent');
        } elseif ($folder == 'trash') {
            $emails->where('status', 'trash');
        }

        $emails = $emails->latest()->paginate(10);

        $emailAccounts = EmailAccount::all(); // all connected email accounts

        return view('email.emails', compact('emails', 'folder', 'emailAccounts'));
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
