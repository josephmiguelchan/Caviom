<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $guarded = [
        'code',

        'charitable_organization_id',
        'address_id',
    ];

    protected $fillable = [
        'profile_photo',

        'first_name',
        'last_name',
        'middle_name',
        'email_address',
        'cel_no',
        'tel_no',

        'category',
        'label',

        'last_modified_by_id',
    ];

    protected $casts = [
        'first_name' => 'encrypted',
        'last_name' => 'encrypted',
        'middle_name' => 'encrypted',
        'email_address' => 'encrypted',
        'cel_no' => 'encrypted',
        'tel_no' => 'encrypted',
    ];

    public function charitableOrganization()
    {
        return $this->belongsTo(CharitableOrganization::class, 'charitable_organization_id', 'id');
    }

    public function Address()
    {
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }

    public function lastModifiedBy()
    {
        return $this->belongsTo(User::class, 'last_modified_by_id', 'id');
    }
}
