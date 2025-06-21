<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'project_id', 'permission_type', 'essai_messure_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function essaiMessure()
    {
        return $this->belongsTo(EssaiMessure::class, 'essai_messure_id');
    }

    public static function canEdit($userId, $essaiMessureId)
    {
        return self::where('user_id', $userId)
            ->where('essai_messure_id', $essaiMessureId)
            ->where('permission_type', 'edit')
            ->exists();
    }
} 