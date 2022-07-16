<?php

namespace App\Models;

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
        'visibility_status', // Tentative
        'verification_status', // Tentative
        'remarks_subject',
        'remarks_message',
    ];
    protected $casts = [
        'subscribed_at' => 'datetime',
        'status_updated_at' => 'datetime',
    ];
    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }
}
