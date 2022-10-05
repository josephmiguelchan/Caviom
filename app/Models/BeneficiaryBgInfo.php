<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeneficiaryBgInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'problem_presented',
        'about_client',
        'about_family',
        'about_community',
        'assessment',
    ];

    protected $guarded = [
        'beneficiary_id',
    ];

    protected $casts = [
        'problem_presented' => 'encrypted',
        'about_client' => 'encrypted',
        'about_family' => 'encrypted',
        'about_community' => 'encrypted',
        'assessment' => 'encrypted',
    ];

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class, 'beneficiary_bg_id', 'id');
    }
}
