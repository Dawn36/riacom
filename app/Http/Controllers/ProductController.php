<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File As FileObj;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
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
        $providerId=$request->val;
        return view('product/product_create',compact('providerId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        
        
        Product::create([
            'name' => $request->name,
            'provider_id' => $request->provider_id,
            'created_by'=>Auth::user()->id,
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
    public function show(Product $product)
    {
        $productDocumentCampaign=ProductDocument::where('product_id',$product->id)->where('type','Campaign')->get();
        $productDocumentDocument=ProductDocument::where('product_id',$product->id)->where('type','Document')->get();
        return view('product/product_show',compact('product','productDocumentCampaign','productDocumentDocument'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product/product_edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
        ]);

        
        $product->name = $request->name;
        $product->save();

        return response()->json([
            'code' => '200',
            'message' => 'Successfully updated',
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $productDocument=ProductDocument::where('product_id',$product->id)->get();
        foreach ($productDocument as $item) {
            FileObj::delete($item->path);
            $item->delete();
        }
        $product->delete();
        return true;
    }
}
