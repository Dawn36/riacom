<?php

namespace App\Http\Controllers;

use App\Models\ProductDocument;
use Illuminate\Support\Facades\File As FileObj;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductDocumentController extends Controller
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
        $type=$request->val['type'];
        $productId=$request->val['product_id'];
        return view('product_document/product_document_create',compact('type','productId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'documents' => 'required',
        ]);

        $userId=Auth::user()->id;

        if ($request->hasFile('documents')) {
            $destinationPath = base_path('public/uploads/prodcutDoc/' . $userId);
            $file = $request->file('documents');
            $fileNameReal=$file->getClientOriginalName();
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $size = $file->getSize();
            $file->move($destinationPath, $filename);
            $path = "uploads/prodcutDoc/" . $userId . "/" . $filename;
        }

        ProductDocument::create([
            'product_id' => $request->product_id,
            'doc_name' => $fileNameReal,
            'path' => $path,
            'type' => $request->type,
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
    public function show(ProductDocument $productDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductDocument $productDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductDocument $productDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductDocument $product_doc)
    {
        FileObj::delete($product_doc->path);
        $product_doc->delete();
        return true;
    }
}
