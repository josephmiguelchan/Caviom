<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedProjectPhotos extends Model
{
    use HasFactory;


    public function featuredProject()
    {
        return $this->belongsTo(featuredProject::class, 'featured_project_id ', 'id');
    }
}
        