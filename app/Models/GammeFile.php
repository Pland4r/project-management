<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GammeFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'gamme_id',
        'project_gamme_id',
        'essai_messure_gamme_id',
        'file_name',
        'file_path',
        'original_name',
        'size',
        'type',
        'description'
    ];

    public function gamme()
    {
        return $this->belongsTo(Gamme::class);
    }

    public function projectGamme()
    {
        return $this->belongsTo(ProjectGamme::class);
    }

    public function essaiMessureGamme()
    {
        return $this->belongsTo(EssaiMessureGamme::class);
    }

    public function essaiMessure()
    {
        return $this->belongsTo(EssaiMessure::class, 'essai_messure_id');
    }
}
