<?php

namespace App\Models\Charity\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;

class ProfilePrimaryInfo extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }
}
