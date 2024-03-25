<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'message',
        'type_of_service',
        'status',
        'district',
        'created_by',
        'user_id',
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
            $query->where('leads.user_id', Auth::user()->id);
        }
    }
}
