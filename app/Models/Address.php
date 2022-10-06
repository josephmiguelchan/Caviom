<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'type',
        'address_line_one',
        'address_line_two',
        'region',
        'province',
        'city',
        'barangay',
        'postal_code'
    ];

    protected $casts = [
        'address_line_one' => 'encrypted',
        'address_line_two' => 'encrypted',
        'region' => 'encrypted',
        'province' => 'encrypted',
        'city' => 'encrypted',
        'barangay' => 'encrypted',
        'postal_code' => 'encrypted',
    ];

    public function info()
    {
        return $this->hasOne(UserInfo::class, 'address_id', 'id');
    }
}
