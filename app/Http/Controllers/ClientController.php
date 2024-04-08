<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientUser;
use App\Models\User;
use App\Models\ClientNote;
use App\Models\Contract;
use App\Models\ClientFile;
use App\Models\ContractFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File As FileObj;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->input('status');
        
        $client=Client::UserWise()->when($status, function ($query, $status) {
            return $query->where('status', $status);
        })->get();
        $userType=Auth::user()->hasRole('admin');
        return view('client/client_index',compact('client','userType'));
    }
    public function clientCounter(Request $request)
    {
        $date=Date("Y-m-d H:i:s");
        $contactsId=$request->contacts_id;
        $count=$request->value;
        Client::where('id', $contactsId)->update(['no_phone_call' => $count,'no_phone_call_date'=>$date]);
        return true;
    }
    public function clientStatusUpdate(Request $request)
    {
        $conatact=Client::find($request->contacts_id);
        $conatact->status=strtolower($request->status);
        $conatact->save();
        return __('client.'.ucwords($request->status));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user=User::where('user_type','user')->get();
        return view('client/client_create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'job_title' => ['required'],
            'email' => 'required',
            'phone' => 'required',
            'vat_number' => 'required|unique:clients,vat_number',
            'contact_person_name' => 'required',
            'document_or_photo' => 'required',
            'status' => 'required',
            'user' => 'required',
        ]);

        $userId=Auth::user()->id;
        $path='theme/assets/media/svg/avatars/blank.svg';

        if ($request->hasFile('avatar')) {
            $destinationPath = base_path('public/uploads/client/' . $userId);
            $file = $request->file('avatar');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $size = $file->getSize();
            $file->move($destinationPath, $filename);
            $path = "uploads/client/" . $userId . "/" . $filename;
        }

        if ($request->hasFile('document_or_photo')) {
            $destinationPath = base_path('public/uploads/clientdocumentorphoto/' . $userId);
            $file = $request->file('document_or_photo');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $size = $file->getSize();
            $file->move($destinationPath, $filename);
            $pathdoc = "uploads/clientdocumentorphoto/" . $userId . "/" . $filename;
        }

        $client=Client::create([
            'name' => $request->name,
            'job_title' => $request->job_title,
            'email' => $request->email,
            'phone' => $request->phone,
            'vat_number' => $request->vat_number,
            'contact_person_name' => $request->contact_person_name,
            'document_path' => $pathdoc,
            'status' => $request->status,
            'cpe' => implode('||||',$request->cpe),
            'cui' => implode('||||',$request->cui),
            'electricity_consumption' => implode('||||',$request->electricity_consumption),
            'gas_consumption' => implode('||||',$request->gas_consumption),
            'address' => implode('||||',$request->address),
            'image' => $path,
            'created_by'=>$userId,
            'no_phone_call_date'=>Date('Y-m-d H:i:s')
        ]);

        for ($i=0; $i < count($request->user) ; $i++) { 
            ClientUser::create([
                'user_id' => $request->user[$i],
                'client_id' => $client->id,
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
    public function show(Client $client)
    {
        $clientNote=ClientNote::join('users AS u', 'client_notes.created_by', '=', 'u.id')->select(['client_notes.*','u.name as user_name'])->where('client_notes.client_id',$client->id)->get();
        $clientFile=ClientFile::where('client_id',$client->id)->get();
        $contract=Contract::UserWise()->where('client_id',$client->id)->get();
        $userType=Auth::user()->hasRole('admin');
        return view('client/client_show',compact('client','clientNote','clientFile','contract','userType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        $user=User::where('user_type','user')->get();
        $clientUser=ClientUser::where('client_id',$client->id)->pluck('user_id')->toArray();
        return view('client/client_edit',compact('user','client','clientUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required',
            'job_title' => ['required'],
            'email' => 'required',
            'phone' => 'required',
            'vat_number' => 'required|unique:clients,vat_number,'.$client->id,
            'contact_person_name' => 'required',
            'status' => 'required',
            'user' => 'required',
        ]);

        $userId=Auth::user()->id;
        $path='theme/assets/media/svg/avatars/blank.svg';

        if ($request->hasFile('avatar')) {
            $destinationPath = base_path('public/uploads/client/' . $userId);
            $file = $request->file('avatar');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $size = $file->getSize();
            $file->move($destinationPath, $filename);
            $client->image = "uploads/client/" . $userId . "/" . $filename;
        }

        if ($request->hasFile('document_or_photo')) {
            $destinationPath = base_path('public/uploads/clientdocumentorphoto/' . $userId);
            $file = $request->file('document_or_photo');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $size = $file->getSize();
            $file->move($destinationPath, $filename);
            $client->document_path = "uploads/clientdocumentorphoto/" . $userId . "/" . $filename;
        }

        $client->name = $request->name;
        $client->job_title = $request->job_title;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->vat_number = $request->vat_number;
        $client->contact_person_name = $request->contact_person_name;
        $client->status = $request->status;
        $client->cpe = implode('||||',$request->cpe);
        $client->cui = implode('||||',$request->cui);
        $client->electricity_consumption = implode('||||',$request->electricity_consumption);
        $client->gas_consumption = implode('||||',$request->gas_consumption);
        $client->address = implode('||||',$request->address);
        $client->save();

        ClientUser::where('client_id',$client->id)->delete();

        for ($i=0; $i < count($request->user) ; $i++) { 
            ClientUser::create([
                'user_id' => $request->user[$i],
                'client_id' => $client->id,
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
    public function destroy(Client $client)
    {
        if($client->image != 'theme/assets/media/svg/avatars/blank.svg')
            {
        FileObj::delete($client->image);
            }
        FileObj::delete($client->document_path);

        ClientUser::where('client_id',$client->id)->delete();
        ClientNote::where('client_id',$client->id)->delete();
        $clientFiles=ClientFile::where('client_id',$client->id)->get();
        foreach ($clientFiles as $file) {
            
                FileObj::delete($file->path);
            
        }
        ClientFile::where('client_id', $client->id)->delete();

        $contract=Contract::where('client_id',$client->id)->get();

        foreach ($contract as $file) {
            FileObj::delete($file->contract_path);
            $contractFiles=ContractFile::where('contract_id',$file->id)->get();
            foreach ($contractFiles as $files) {
                FileObj::delete($files->path);
                $files->delete();
            }
            $file->delete();
        }

        $client->delete();
        return true;
    }
}
