<?php

namespace App\Models\Admin;

use App\Models\CharitableOrganization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedProject extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'reviewed_by', 'id');
    }
    public function charity()
    {
        return $this->belongsTo(CharitableOrganization::class, 'charitable_organization_id', 'id');
    }
    public function photos()
    {
        return $this->hasOne(FeaturedProjectPhotos::class, 'featured_project_id', 'id');
    }
}
