<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;



class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // DB::enableQueryLog();

        // DB::enableQueryLog();

        // dd(DB::getQueryLog());

        $userId = Auth::user()->id;
        $user = User::find($userId);
        $data['id'] = ucwords($user->id);
        $data['name'] = ucwords($user->name);
        $data['email'] = $user->email;
        $data['phone_number'] = $user->phone_number;
        $data['address'] = $user->address;
        $data['profile_picture'] = $user->profile_picture;

        return view('setting/user_setting', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       
        $userId = Auth::user()->id;
        $user = User::find($userId);
        // $request->validate([
        //     'nick_name' => ['required', 'max:255', 'unique:users', 'unique:users,deleted_at,NULL,id' . $user->id],
        // ]);

        $validatedData = $request->validate([
            'file' => 'png,jpg,jpeg|max:2048',

        ]);
        if ($request->hasFile('profile_picture')) {
            $request->validate([
                'file' => 'png,jpg,jpeg',
            ]);
            $previousPic = $user->profile_picture;
            if ($previousPic != 'uploads/profile/blank.png') {
                File::delete($previousPic);
            }
            $path = "uploads/profile/" . $user->id;
            $file = $request->file('profile_picture');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path($path), $filename);
            $user->profile_picture = $path. "/" . $filename;
        }

        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;

        $user->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function updateEmail(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'confirmemailpassword' => ['required'],

        ]);

        if (Hash::check($request->confirmemailpassword, $user->password)) {

            $user->email = $request->email;
            $user->save();
            return redirect()->back();
        } else {
            $request->session()->flash('error', 'Password does not match');
            return redirect()->back();
        }
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'confirmed|min:8|different:old_password',
        ]);
        if (Hash::check($request->old_password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->password),
                'password_show' => $request->password
            ])->save();
            // $user->password_show=$request->password;
            // $user->save();
            // ." ".$user->last_name
            $request->session()->flash('success', 'Password changed');

            return redirect()->back();
        } else {
            $request->session()->flash('error', 'Old password do not match');
            return redirect()->back();
        }
    }

   
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
