<?php

namespace App\Http\Controllers;

use App\Models\ClientFile;
use Illuminate\Support\Facades\File As FileObj;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClientFileController extends Controller
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
        return view('client_file/client_file_create',compact('clientId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $userId=Auth::user()->id;

        if ($request->hasFile('file')) {
            $destinationPath = base_path('public/uploads/clientFile/' . $userId);
            $file = $request->file('file');
            $fileName=$file->getClientOriginalName();
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $size = $file->getSize();
            $file->move($destinationPath, $filename);
            $path = "uploads/clientFile/" . $userId . "/" . $filename;
        }

        ClientFile::create([
            'client_id' => $request->client_id,
            'name' => $fileName,
            'path' => $path,
            'created_by'=>$userId
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
    public function show(ClientFile $clientFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClientFile $clientFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClientFile $clientFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClientFile $clientFile)
    {
        FileObj::delete($clientFile->path);
        $clientFile->delete();
        return true;
    }
}
