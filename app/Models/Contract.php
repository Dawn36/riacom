<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'duration',
        'end_date',
        'renews_in',
        'renews_in_date',
        'type_of_service',
        'monthly_fee',
        'provider_id',
        'tension',
        'power',
        'cicle',
        'tariff',
        'reception_phase',
        'gas_pressure',
        'gas_scalation',
        'gas_tariff',
        'energy_market',
        'gas_market',
        'status',
        'contract_path',
        'user_id',
        'created_by',
        'client_id',
        'client_address',
    ];
    
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => date('d M Y',strtotime($value)),
        );
    }
    protected function startDate(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => date('d M Y',strtotime($value)),
        );
    }
    protected function endDate(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => date('d M Y',strtotime($value)),
        );
    }

    protected function renewsInDate(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => date('d M Y',strtotime($value)),
        );
    }

    public  function scopeUserWise($query): void
    {
        if(Auth::user()->user_type == 'user')
        {
            $query->where('contracts.user_id', Auth::user()->id);
        }
    }
}