<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientUser;
use App\Models\Contract;
use App\Models\ContractFile;
use App\Models\ProviderUser;
use App\Models\User;
use Illuminate\Support\Facades\File As FileObj;
use Illuminate\Support\Facades\Auth;
use App\Models\Provider;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $contract=Contract::UserWise()->Join('clients AS c', 'contracts.client_id', '=', 'c.id')->
        Join('providers AS p', 'contracts.provider_id', '=', 'p.id')->
        when($request->status, function ($query, $data) {
            return $query->where('contracts.status', $data);
        })->when($request->provider_id, function ($query, $data) {
            return $query->where('contracts.provider_id', $data);
        })->when($request->start_date, function ($query, $startDate) {
            return $query->where('contracts.start_date', '>=', $startDate);
        })->when($request->end_date, function ($query, $endDate) {
            return $query->where('contracts.end_date', '<=', $endDate);
        })->select(['contracts.*','p.name as p_name','c.id as c_id','c.name as c_name','c.image as c_image'])->get();
        $provider=Provider::UserWise()->get();
        $userType=Auth::user()->hasRole('admin');
        return view('contract/contract_index',compact('contract','provider','userType'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $provider=Provider::UserWise()->get();
        if(isset($request->val))
        {
            $clientId=$request->val;
            return view('contract/contract_client_create',compact('clientId','provider'));
        }
        return view('contract/contract_create',compact('provider'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->has('vat_number'))
        {
            $request->validate([
                'vat_number' => 'required',
            ]);
        }
        $request->validate([
            'name' => 'required',
            'start_date' => ['required'],
            'duration' => 'required|integer|between:1,12',
            'end_date' => 'required',
            'renews_in' => 'required|integer|between:1,12',
            'type_of_service' => 'required',
            'monthly_fee' => 'required',
            'provider' => 'required',
            'user' => 'required',
            'tension' => 'required',
            'power' => 'required',
            'cicle' => 'required',
            'tariff' => 'required',
            'reception_phase' => 'required',
            'gas_pressure' => 'required',
            'gas_scalation' => 'required',
            'gas_tariff' => 'required',
            'energy_market' => 'required',
            'gas_market' => 'required',
            'status' => 'required',
            'contract' => 'required',
            'client_id' => 'required',
        ]);

        $userId=Auth::user()->id;

        if ($request->hasFile('contract')) {
            $destinationPath = base_path('public/uploads/contract/' . $userId);
            $file = $request->file('contract');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $size = $file->getSize();
            $file->move($destinationPath, $filename);
            $path = "uploads/contract/" . $userId . "/" . $filename;
        }

        Contract::create([
            'name' => $request->name,
            'start_date' => Date("Y-m-d",strtotime($request->start_date)),
            'duration' => $request->duration,
            'end_date' => Date("Y-m-d",strtotime($request->end_date)),
            'renews_in' => $request->renews_in,
            'renews_in_date' => date("Y-m-d", strtotime($request->end_date . ' +' . $request->renews_in . ' months')),
            'type_of_service' => $request->type_of_service,
            'monthly_fee' => $request->monthly_fee,
            'provider_id'=>$request->provider,
            'user_id'=>$request->user,
            'tension'=>$request->tension,
            'power'=>$request->power,
            'cicle'=>$request->cicle,
            'tariff'=>$request->tariff,
            'reception_phase'=>$request->reception_phase,
            'gas_pressure'=>$request->gas_pressure,
            'gas_scalation'=>$request->gas_scalation,
            'gas_tariff'=>$request->gas_tariff,
            'energy_market'=>$request->energy_market,
            'gas_market'=>$request->gas_market,
            'status'=>$request->status,
            'contract_path'=>$path,
            'client_id'=>$request->client_id,
            'created_by'=> $userId,
            'client_address'=> isset($request->client_address) ? $request->client_address : ''
        ]);

        if($request->has('vat_number'))
        {
            $clientUserExists = ClientUser::where('user_id', $request->user)
            ->where('client_id', $request->client_id)
            ->exists();
            if(!$clientUserExists)
            {
                ClientUser::create([
                    'user_id' => $request->user,
                    'client_id' => $request->client_id,
                ]);
            }
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
    public function show(Contract $contract)
    {
        $client=Client::find($contract->client_id);
        $provider=Provider::find($contract->provider_id);
        $contractFile=ContractFile::where('contract_id',$contract->id)->get();;
        return view('contract/contract_show',compact('contract','client','provider','contractFile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        $provider=Provider::get();
        return view('contract/contract_edit',compact('provider','contract'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contract $contract)
    {
        $request->validate([
            'name' => 'required',
            'start_date' => ['required'],
            'duration' => 'required|integer|between:1,12',
            'end_date' => 'required',
            'renews_in' => 'required|integer|between:1,12',
            'type_of_service' => 'required',
            'monthly_fee' => 'required',
            'provider' => 'required',
            'user' => 'required',
            'tension' => 'required',
            'power' => 'required',
            'cicle' => 'required',
            'tariff' => 'required',
            'reception_phase' => 'required',
            'gas_pressure' => 'required',
            'gas_scalation' => 'required',
            'gas_tariff' => 'required',
            'energy_market' => 'required',
            'gas_market' => 'required',
            'status' => 'required',
        ]);

        $userId=Auth::user()->id;

        if ($request->hasFile('contract')) {
            $destinationPath = base_path('public/uploads/contract/' . $userId);
            $file = $request->file('contract');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $size = $file->getSize();
            $file->move($destinationPath, $filename);
            $contract->contract_path = "uploads/contract/" . $userId . "/" . $filename;
        }

        $contract->name  =  $request->name;
        $contract->start_date  =  Date("Y-m-d",strtotime($request->start_date));
        $contract->duration  =  $request->duration;
        $contract->end_date  =  Date("Y-m-d",strtotime($request->end_date));
        $contract->renews_in  =  $request->renews_in;
        $contract->renews_in_date  =  date("Y-m-d", strtotime($request->end_date . ' +' . $request->renews_in . ' months'));
        $contract->type_of_service  =  $request->type_of_service;
        $contract->monthly_fee  =  $request->monthly_fee;
        $contract->provider_id = $request->provider;
        $contract->user_id = $request->user;
        $contract->tension = $request->tension;
        $contract->power = $request->power;
        $contract->cicle = $request->cicle;
        $contract->tariff = $request->tariff;
        $contract->reception_phase = $request->reception_phase;
        $contract->gas_pressure = $request->gas_pressure;
        $contract->gas_scalation = $request->gas_scalation;
        $contract->gas_tariff = $request->gas_tariff;
        $contract->energy_market = $request->energy_market;
        $contract->gas_market = $request->gas_market;
        $contract->status = $request->status;
        $contract->client_address= isset($request->client_address) ? $request->client_address : '';
        $contract->save();

        return response()->json([
            'code' => '200',
            'message' => 'Successfully updated',
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {

        $contractFiles=ContractFile::where('contract_id',$contract->id)->get();
        foreach ($contractFiles as $files) {
            FileObj::delete($files->path);
            $files->delete();
        }
        $contract->delete();
        return true;
    }

    public function providerUser(Request $request)
    {
        $providerUser=ProviderUser::where('provider_id',$request->provider)->pluck('user_id')->toarray();
        return User::whereIn('id',$providerUser)->get();
    }
    public function checkVatNumberClient(Request $request)
    {
        $vatNumber=$request->vat_number;
        $data= Client::where('vat_number',$vatNumber)->first();
        if($data !=  null)
        {
            $data->address=explode('||||',@$data->address);
        }
        return $data;
    }
}
