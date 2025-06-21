<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use App\Models\Project;
use Illuminate\Contracts\Auth\MustVerifyEmail;



class User extends Authenticatable 
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'usercode', 'registration_status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email',
    ];
    protected static function boot()
{
    parent::boot();

    static::creating(function ($user) {
        do {
            $usercode = Str::upper(Str::random(8));
        } while (User::where('usercode', $usercode)->exists());
        
        $user->usercode = $usercode;
    });
}
public function projects()
{
    return $this->hasMany(Project::class);
}

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function joinedProjects()
    {
        return $this->belongsToMany(Project::class, 'project_user');
    }

    public function essaiMessures()
    {
        return $this->hasMany(EssaiMessure::class);
    }

    public function permissions()
    {
        return $this->hasMany(ProjectPermission::class);
    }
}
