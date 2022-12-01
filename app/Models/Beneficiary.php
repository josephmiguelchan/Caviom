<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

    protected $guarded = [
        'code',

        'charitable_organization_id',
        'present_address_id',
        'permanent_address_id',
        'provincial_address_id',
        'last_modified_by_id',
    ];

    protected $fillable = [
        'code',
        'nick_name',
        'profile_photo',
        'first_name',
        'last_name',
        'middle_name',
        'birth_date',
        'birth_place',
        'religion',
        'educational_attainment',
        'last_school_year_attended',
        'interviewed_at',
        'contact_no',
        'prepared_by',
        'noted_by',
        'category',
        'label',

    ];

    protected $casts = [
        'interviewed_at' => 'datetime',

        #Encrypted Fields
        'nick_name' => 'encrypted',
        'first_name' => 'encrypted',
        'last_name' => 'encrypted',
        'middle_name' => 'encrypted',
        'birth_date' => 'encrypted',
        'birth_place' => 'encrypted',
        'religion' => 'encrypted',
        'educational_attainment' => 'encrypted',
        'last_school_year_attended' => 'encrypted',
        'contact_no' => 'encrypted',
        'prepared_by' => 'encrypted',
        'noted_by' => 'encrypted',

        #Not Encrypted
        /*
          'category' =>
          'label' =>     */
    ];

    public function presentAddress()
    {
        return $this->belongsTo(Address::class, 'present_address_id');
    }

    public function permanentAddress()
    {
        return $this->belongsTo(Address::class, 'permanent_address_id', 'id');
    }

    public function provincialAddress()
    {
        return $this->belongsTo(Address::class, 'provincial_address_id', 'id');
    }

    public function charitableOrganization()
    {
        return $this->belongsTo(CharitableOrganization::class, 'charitable_organization_id', 'id');
    }

    public function families()
    {
        return $this->hasMany(BeneficiaryFamilyInfo::class, 'beneficiary_id', 'id');
    }

    public function lastModifiedBy()
    {
        return $this->belongsTo(User::class, 'last_modified_by_id', 'id');
    }

    public function bg_info()
    {
        return $this->hasOne(BeneficiaryBgInfo::class, 'beneficiary_id', 'id');
    }
}
