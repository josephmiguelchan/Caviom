<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    protected $touches = ['user'];

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class, 'last_modified_by_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected $casts = [
        'first_name' => 'encrypted',
        'middle_name' => 'encrypted',
        'last_name' => 'encrypted',
        'cel_no' => 'encrypted',
        'tel_no' => 'encrypted',
        'work_position' => 'encrypted',
    ];
}
