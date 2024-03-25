<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'job_title',
        'email',
        'phone',
        'vat_number',
        'contact_person_name',
        'document_path',
        'status',
        'cpe',
        'cui',
        'electricity_consumption',
        'gas_consumption',
        'address',
        'created_by',
        'no_phone_call',
        'no_phone_call_date',
    ];
    
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => date('d M Y',strtotime($value)),
        );
    }

    protected function noPhoneCallDate(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => date('d/m/Y h:i:s A',strtotime($value)),
        );
    }

    public  function scopeUserWise($query): void
    {
        if(Auth::user()->user_type == 'user')
        {
            $query->Join('client_users AS cu', 'cu.client_id', '=', 'clients.id')->
            where('cu.user_id', Auth::user()->id)->select('clients.*');
        }
    }

   
}
