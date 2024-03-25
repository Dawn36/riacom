<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\File as FileObj;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=User::where('user_type','user')->get();
        return view('user/user_index',compact('user'));
    }
    public function admin()
    {
        $admin=User::where('user_type','admin')->get();
        return view('admin/admin_index',compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $role=$request->val;
        return view('user/user_create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => 'required',
            'password' => ['required',  Rules\Password::defaults()],
        ]);
        $path = 'uploads/profile/blank.png';

        $userId = Auth::user()->id;
        if ($request->hasFile('avatar')) {
            $destinationPath = base_path('public/uploads/profile/' . $userId);
            $file = $request->file('avatar');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $size = $file->getSize();
            $file->move($destinationPath, $filename);
            $path = "uploads/profile/" . $userId . "/" . $filename;
        }
         $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'user_type' => $request->role,
            'profile_picture' => $path,
            'password' => Hash::make($request->password),
        ]);
        $user->addRole($request->role);

        return response()->json([
            'code' => '200',
            'message' => 'Successfully added',
            'status' => 'success',
        ]);
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
    public function edit(User $user)
    {
        return view('user/user_edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone_number' => 'required',
        ]);
        $userId = Auth::user()->id;
        if ($request->hasFile('avatar')) {
            if ($request->profile_picture != 'uploads/profile/blank.png') {
                FileObj::delete($request->profile_picture);
            }
            $destinationPath = base_path('public/uploads/profile/' . $userId);
            $file = $request->file('avatar');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $size = $file->getSize();
            $file->move($destinationPath, $filename);
            $path = "uploads/profile/" . $userId . "/" . $filename;
            $user->profile_picture = $path;
        }
        if (isset($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->save();

        return response()->json([
            'code' => '200',
            'message' => 'Successfully updated',
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
