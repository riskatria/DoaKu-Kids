<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    protected $fillable = [
        'user_id',
        'prayer_id',
        'prayer_title',
    ];

    /**
     * Get the user that owns the favorite entry.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
