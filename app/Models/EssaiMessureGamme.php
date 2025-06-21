<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EssaiMessureGamme extends Model
{
    use HasFactory;

    protected $fillable = [
        'essai_messure_id', 'gamme_id', 'type'
    ];

    public function essaiMessure()
    {
        return $this->belongsTo(EssaiMessure::class);
    }

    public function gamme()
    {
        return $this->belongsTo(Gamme::class);
    }

    public function files()
    {
        return $this->hasMany(GammeFile::class, 'essai_messure_gamme_id');
    }
} 