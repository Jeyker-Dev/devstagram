<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }   // Here End Function User

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }   // Here End Function Comentarios

    public function likes()
    {
        return $this->hasMany(Like::class);
    }   // Here End Function Likes

    public function checkLike( User $user )
    {
        return $this->likes->contains('user_id', $user->id );
    }   // Here End Function checkLike
}   // Here End Class Post
