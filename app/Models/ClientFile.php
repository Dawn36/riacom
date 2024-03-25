<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ClientFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'name',
        'path',
        'created_by',
    ];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => date('d M Y',strtotime($value)),
        );
    }
}
