<?php

namespace App\Http\Controllers;

use App\Models\ClientNote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClientNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $clientId=$request->val;
        return view('client_note/client_note_create',compact('clientId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'note' => 'required',
        ]);

        ClientNote::create([
            'client_id' => $request->client_id,
            'note' => $request->note,
            'created_by'=>Auth::user()->id
        ]);

        return response()->json([
            'code' => '200',
            'message' => 'Successfully added',
            'status' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ClientNote $clientNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClientNote $clientNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClientNote $clientNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClientNote $clientNote)
    {
        $clientNote->delete();
        return true;
    }
}
