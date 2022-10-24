<?php

namespace App\Models;

use App\Models\Admin\FeaturedProject;
use App\Models\Admin\order;
use App\Models\Charity\Public\Lead;
use App\Models\Charity\Public\Prospect;
use App\Models\Charity\Public\ProspectTrail;
use App\Models\Charity\Profile\ProfileAward;
use App\Models\Charity\Profile\ProfileCoverPhoto;
use App\Models\Charity\Profile\ProfileModeOfDonation;
use App\Models\Charity\Profile\ProfilePrimaryInfo;
use App\Models\Charity\Profile\ProfileProgram;
use App\Models\Charity\Profile\ProfileSecondaryInfo;
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
    public function leads()
    {
        return $this->hasMany(Lead::class, 'charitable_organization_id', 'id');
    }

    public function prospects()
    {
        return $this->hasMany(Prospect::class, 'charitable_organization_id', 'id');
    }

    public function prospectstrail()
    {
        return $this->hasMany(ProspectTrail::class, 'charitable_organization_id', 'id');
    }

    public function primaryInfo()
    {
        return $this->hasOne(ProfilePrimaryInfo::class, 'charitable_organization_id', 'id');
    }

    public function secondaryInfo()
    {
        return $this->hasOne(ProfileSecondaryInfo::class, 'charitable_organization_id', 'id');
    }

    public function coverPhotos()
    {
        return $this->hasMany(ProfileCoverPhoto::class, 'charitable_organization_id', 'id');
    }

    public function awards()
    {
        return $this->hasMany(ProfileAward::class, 'charitable_organization_id', 'id');
    }

    public function programs()
    {
        return $this->hasMany(ProfileProgram::class, 'charitable_organization_id', 'id');
    }

    public function donationModes()
    {
        return $this->hasMany(ProfileModeOfDonation::class, 'charitable_organization_id', 'id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'charitable_organization_id', 'id');
    }

}
