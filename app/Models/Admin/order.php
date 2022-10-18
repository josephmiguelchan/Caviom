<?php

namespace App\Models\Admin;

use App\Models\CharitableOrganization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class order extends Model
{
    use HasFactory;

    protected $guarded = [
        'code',
        'charitable_organization_id',
        'submitted_by'
    ];

    protected $fillable = [
        'reference_no',
        'proof_of_payment',
        'mode_of_payment',
        'total',
        'status',

        'remarks_subject',
        'remarks_message',
    ];

    protected $casts = [
        'status_updated_at' => 'datetime',
        'created_at' => 'datetime',
        'paid_at' => 'datetime',
    ];


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
