<?php

namespace App\Http\Controllers;

use App\Models\ContractFile;
use Illuminate\Support\Facades\File As FileObj;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ContractFileController extends Controller
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
        $contractId=$request->val;
        return view('contract_file/contract_file_create',compact('contractId'));
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
            $destinationPath = base_path('public/uploads/contractFile/' . $userId);
            $file = $request->file('file');
            $fileName=$file->getClientOriginalName();
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $size = $file->getSize();
            $file->move($destinationPath, $filename);
            $path = "uploads/contractFile/" . $userId . "/" . $filename;
        }

        ContractFile::create([
            'contract_id' => $request->contract_id,
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
    public function show(ContractFile $contractFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContractFile $contractFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContractFile $contractFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContractFile $contractFile)
    {
        FileObj::delete($contractFile->path);
        $contractFile->delete();
        return true;
    }
}
