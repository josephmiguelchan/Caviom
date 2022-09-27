<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getuser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected $casts = [
        'action' => 'encrypted',    
    ];
    public $timestamps = false;
}
