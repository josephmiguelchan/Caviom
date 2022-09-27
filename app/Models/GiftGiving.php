<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftGiving extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $dates = [
        'start_at',
    ];

    public function GiftGivingBEneficiaries()
    // gift_giving_beneficiaries
    {
        return $this->hasMany(Gift_Giving_Beneficiaries::class, 'gift_giving_id', 'id');
    }

    public function downloadedBy()
    {
        return $this->belongsTo(User::class, 'last_downloaded_by', 'id');
    }

  
    protected $fillable = [
        
        'id',
        'code',
        'charitable_organization_id',
        'name',
        'objective',
        'start_at',
        'venue',
        'sponsor',
        'last_downloaded_by',
        'batch_no',
        'amount_per_pack',
        'no_of_packs',
        'total_budget',
    ];
 
    public function getRouteKeyName()
    {
        return 'code';
    }


 
}
