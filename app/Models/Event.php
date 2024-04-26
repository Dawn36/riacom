<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    use HasFactory;

    public  function scopeUserWise($query): void
    {
        if(Auth::user()->user_type == 'user')
        {
            $query->where('contracts.user_id', Auth::user()->id);
        }
    }
}
