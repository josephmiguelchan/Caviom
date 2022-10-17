<?php

namespace App\Models\Charity\Public;

use App\Models\CharitableOrganization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProspectTrail extends Model
{
    use HasFactory;
    public $timestamps = false;
    

    public function charity()
    {
        return $this->belongsTo(CharitableOrganization::class,'charitable_organization_id', 'id');
    }

}
