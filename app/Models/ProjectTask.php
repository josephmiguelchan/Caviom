<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    use HasFactory;
    protected $touches = ['project'];

    public function AssignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by', 'id');
    }

    public function AssignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
