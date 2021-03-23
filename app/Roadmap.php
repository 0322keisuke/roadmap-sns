<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Roadmap extends Model
{
    //レベル定義
    const LEVEL = [
        1 => '初級',
        2 => '中級',
        3 => '上級',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    public function isLikedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->likes->where('id', $user->id)->count()
            : false;
    }

    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }

    public function getLevelTextAttribute()
    {
        $level = $this->attributes['level'];

        if (!isset(self::LEVEL[$level])) {
            return '';
        }

        return self::LEVEL[$level];
    }
}
