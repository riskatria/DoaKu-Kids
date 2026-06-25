<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MemorizationList extends Model
{
    protected $table = 'memorization_lists';

    protected $fillable = [
        'user_id',
        'prayer_id',
        'prayer_title',
        'status',
    ];

    /**
     * Get the user that owns the memorization entry.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
