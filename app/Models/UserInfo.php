<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }
}
