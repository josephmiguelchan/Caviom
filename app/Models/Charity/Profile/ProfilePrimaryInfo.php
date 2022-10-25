<?php

namespace App\Models\Charity\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;
use App\Models\CharitableOrganization;

class ProfilePrimaryInfo extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    protected $touches = ['charitableOrganization'];
    public function charitableOrganization()
    {
        return $this->belongsTo(CharitableOrganization::class, 'charitable_organization_id', 'id');
    }
    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }
}
