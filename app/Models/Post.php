<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): hasMany
    {
        return $this->hasMany(Comment::class);
    }

    protected function postImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::disk(config('filesystems.default'))->url($this->image),
        );
    }
}
