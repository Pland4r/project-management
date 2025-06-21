<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gamme_id',
        'original_name',
        'path',
        'mime_type',
        'size',
        'download_count',
        'user_id',
    ];

    /**
     * Get the gamme that owns the file.
     */
    public function gamme()
    {
        return $this->belongsTo(Gamme::class);
    }

    /**
     * Get the user that uploaded the file.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
