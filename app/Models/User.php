<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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

    public function posts()
    {
        // Relationship between User and Post one to many(Uno a Muchos)
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany( Like::class );
    }   // Here End Function Likes

    public function followers()
    {
        return $this->belongsToMany( User::class, 'followers', 'user_id', 'follower_id' );
    }   // Here End Function Followers

    public function followings()
    {
        return $this->belongsToMany( User::class, 'followers', 'follower_id', 'user_id' );
    }   // Here End Function Followers

    // Check if the user is following another user
    public function siguiendo( User $user)
    {
        return $this->followers->contains( $user->id );
    }   // Here End Function Siguiendo
}   // Here End Class User
