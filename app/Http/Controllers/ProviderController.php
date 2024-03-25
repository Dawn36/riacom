<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Provider;
use App\Models\ProviderUser;
use App\Models\ProductDocument;
use Illuminate\Support\Facades\File As FileObj;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provider=Provider::UserWise()->get();
        $userType=Auth::user()->hasRole('admin');
        return view('provider/provider_index',compact('provider','userType'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user=User::where('user_type','user')->get();
        return view('provider/provider_create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required'],
            'phone' => 'required',
            'users' => 'required',
            'type_of_service' => 'required',
        ]);
        $userId=Auth::user()->id;
        $path='theme/assets/media/svg/avatars/blank.svg';
        if ($request->hasFile('avatar')) {
            $destinationPath = base_path('public/uploads/provider/' . $userId);
            $file = $request->file('avatar');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $size = $file->getSize();
            $file->move($destinationPath, $filename);
            $path = "uploads/provider/" . $userId . "/" . $filename;
        }

        $provider=Provider::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'type_of_service' => $request->type_of_service,
            'image' => $path,
            'created_by'=>$userId
        ]);
        for ($i=0; $i < count($request->users) ; $i++) { 
            ProviderUser::create([
                'user_id' => $request->users[$i],
                'provider_id' => $provider->id,
            ]);
        }

        return response()->json([
            'code' => '200',
            'message' => 'Successfully added',
            'status' => 'success',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Provider $provider)
    {
        $product=Product::where('provider_id',$provider->id)->get();
        return view('provider/provider_show',compact('provider','product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provider $provider)
    {
        $user=User::where('user_type','user')->get();
        $providerUser=ProviderUser::where('provider_id',$provider->id)->pluck('user_id')->toArray();
        return view('provider/provider_edit',compact('user','provider','providerUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provider $provider)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required'],
            'phone' => 'required',
            'users' => 'required',
            'type_of_service' => 'required',
        ]);

        $userId=Auth::user()->id;
        $path='theme/assets/media/svg/avatars/blank.svg';

        if ($request->hasFile('avatar')) {
            $destinationPath = base_path('public/uploads/provider/' . $userId);
            $file = $request->file('avatar');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $size = $file->getSize();
            $file->move($destinationPath, $filename);
            $path = "uploads/provider/" . $userId . "/" . $filename;
            $provider->image=$path;
        }

        
        $provider->name = $request->name;
        $provider->email = $request->email;
        $provider->phone = $request->phone;
        $provider->type_of_service = $request->type_of_service;
        $provider->save();
        
        ProviderUser::where('provider_id',$provider->id)->delete();

        for ($i=0; $i < count($request->users) ; $i++) { 
            ProviderUser::create([
                'user_id' => $request->users[$i],
                'provider_id' => $provider->id,
            ]);
        }

        return response()->json([
            'code' => '200',
            'message' => 'Successfully updated',
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provider $provider)
    {
        $product=Product::where('provider_id',$provider->id)->get();
        foreach ($product as $item) {
            $productDocument=ProductDocument::where('product_id',$item->id)->get();
            foreach ($productDocument as $items) {
                FileObj::delete($items->path);
                $items->delete();
            }
            $item->delete();
        }
        FileObj::delete($provider->image);
        $provider->delete();
        return true;
    }
}
