<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lead=Lead::UserWise()->leftJoin('users AS u', 'leads.user_id', '=', 'u.id')
        ->select(['leads.*','u.name as user_name'])->get();
        return view('lead/lead_index',compact('lead'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->hasRole('admin'))
        $user=User::get();
        else
        $user=array();
        return view('lead/lead_create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required'],
            'message' => 'required',
            'type_of_service' => 'required',
            'status' => 'required',
            'district' => 'required',
            'user' => 'required',
        ]);

        Lead::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'type_of_service' => $request->type_of_service,
            'status' => $request->status,
            'district' => $request->district,
            'user_id' => $request->user,
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
    public function show(Lead $lead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead)
    {
        if(Auth::user()->hasRole('admin'))
        $user=User::get();
        else
        $user=array();
        return view('lead/lead_edit',compact('user','lead'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lead $lead)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required'],
            'message' => 'required',
            'type_of_service' => 'required',
            'status' => 'required',
            'district' => 'required',
            'user' => 'required',
        ]);

        $lead->name = $request->name;
        $lead->email = $request->email;
        $lead->message = $request->message;
        $lead->type_of_service = $request->type_of_service;
        $lead->status = $request->status;
        $lead->district = $request->district;
        $lead->user_id = $request->user;
        $lead->save();

        return response()->json([
            'code' => '200',
            'message' => 'Successfully updated',
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();
        return true;
    }
}
