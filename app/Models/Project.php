<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_name',
        'person_name',
        'reference',
        'contreMarque',
        'issues'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            // Generate a unique reference if not set
            if (empty($project->reference)) {
                $project->reference = strtoupper(uniqid('PRJ'));
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }

    public function gammes()
    {
        return $this->hasMany(ProjectGamme::class);
    }

    public function essaiMessures()
    {
        return $this->hasMany(EssaiMessure::class);
    }

    public function responsible()
    {
        return $this->belongsTo(User::class, 'responsible_id');
    }
}