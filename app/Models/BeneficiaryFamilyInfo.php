<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeneficiaryFamilyInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'birth_date',
        'relationship',
        'civil_status',
        'education',
        'occupation',
        'income',
        'where_abouts',
    ];

    protected $casts = [
        'first_name' => 'encrypted',
        'last_name' => 'encrypted',
        'middle_name' => 'encrypted',
        'birth_date' => 'encrypted',
        'relationship' => 'encrypted',
        'civil_status' => 'encrypted',
        'education' => 'encrypted',
        'occupation' => 'encrypted',
        'income' => 'encrypted',
        'where_abouts' => 'encrypted',
    ];

    protected $guarded = [
        'beneficiary_id',
    ];

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class,'beneficiary_id', 'id');
    }
}
