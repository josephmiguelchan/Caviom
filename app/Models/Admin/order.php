<?php

namespace App\Models\Admin;

use App\Models\CharitableOrganization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class order extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function order_items()
    {
        return $this->hasMany(order_items::class, 'order_id', 'id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'submitted_by', 'id');
    }

    public function charity()
    {
        return $this->belongsTo(CharitableOrganization::class, 'charitable_organization_id', 'id');
    }
}
