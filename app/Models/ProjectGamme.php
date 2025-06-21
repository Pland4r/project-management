<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectGamme extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'type'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function files()
    {
        return $this->hasMany(GammeFile::class, 'project_gamme_id');
    }
} 