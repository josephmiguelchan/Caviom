<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftGivingBeneficiary extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function GiftGiving()
    {
        return $this->belongsTo(GiftGiving::class, 'gift_giving_id', 'id');
    }

    protected $casts = [
        'name' => 'encrypted',
    ];

    public $timestamps = false;
}
