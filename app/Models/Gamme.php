<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gamme extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'display_name',
    ];

    public function projectGammes()
    {
        return $this->hasMany(ProjectGamme::class);
    }

    public function essaiMessureGammes()
    {
        return $this->hasMany(EssaiMessureGamme::class);
    }

    public function files()
    {
        return $this->hasMany(GammeFile::class);
    }
}
