<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_items extends Model
{
    use HasFactory;

    protected $guarded = [
        'order_id',
    ];

    protected $fillable = [
        'name',
        'price',
        'quantity',
        'subtotal',
    ];

    public $timestamps = false;


}
