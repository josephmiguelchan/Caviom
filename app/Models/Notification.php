<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $dates = [
        'created_at',
    ];
    protected $casts = [
        'message' => 'encrypted',
    ];

    public $timestamps = false;
}
