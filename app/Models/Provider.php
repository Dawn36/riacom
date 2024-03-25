<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'type_of_service',
        'image',
        'created_by',
    ];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => date('d M Y',strtotime($value)),
        );
    }

    public  function scopeUserWise($query): void
    {
        if(Auth::user()->user_type == 'user')
        {
            $query->Join('provider_users AS pu', 'pu.provider_id', '=', 'providers.id')->
            where('pu.user_id', Auth::user()->id)->select('providers.*');
        }
    }
}
