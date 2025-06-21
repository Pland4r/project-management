<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EssaiMessure extends Model
{
    use HasFactory;

    protected $table = 'essais_messures';

    protected $fillable = [
        'project_id', 'user_id', 'type', 'name', 'person_name', 'validator_name', 'start_date', 'end_date', 'commentaire', 'issues', 'etat'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gammes()
    {
        return $this->hasMany(EssaiMessureGamme::class);
    }

    public function files()
    {
        return $this->hasMany(GammeFile::class, 'essai_messure_id');
    }

    // Validation rules stub
    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|in:essai,messure',
            // ... other rules ...
        ];
    }

    // File handling stub
    public function uploadFile($file, $branch)
    {
        // Implement file upload logic for a branch (CTR, STR, LAS)
    }
} 