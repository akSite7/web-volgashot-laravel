<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'name',
        'spec',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'spec' => 'array',
    ];
}
