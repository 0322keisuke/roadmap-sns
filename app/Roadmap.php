<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Roadmap extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}