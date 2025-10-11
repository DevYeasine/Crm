<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;

class EmailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emails = Email::where('direction', 'incoming')
                   ->whereNull('deleted_at')
                   ->latest()
                   ->get();

        return view('emails', compact('emails'));
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
