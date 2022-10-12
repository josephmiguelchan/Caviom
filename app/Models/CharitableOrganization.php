<?php

namespace App\Models;

use App\Models\Admin\FeaturedProject;
use App\Models\Admin\order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharitableOrganization extends Model
{
    use HasFactory;
    protected $guarded = [
        'code',
        'star_tokens',
        'featured_project_credits',
        'subscription',
        'view_count'
    ];
    protected $fillable = [
        'name',
        'profile_photo', // Tentative
        'profile_status', // Tentative
        'verification_status', // Tentative
        'remarks_subject',
        'remarks_message',
    ];
    protected $casts = [
        'subscribed_at' => 'datetime',
        'status_updated_at' => 'datetime',
    ];
    public function users()
    {
        return $this->hasMany(User::class, 'charitable_organization_id', 'id');
    }

    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class, 'charitable_organization_id', 'id');
    }

    public function giftgiving()
    {
        return $this->hasMany(GiftGiving::class, 'charitable_organization_id', 'id');
    }

    public function featuredProject()
    {
        return $this->hasMany(FeaturedProject::class, 'charitable_organization_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(order::class, 'charitable_organization_id', 'id');
    }
}
