<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LuckyWheelHistory extends Model
{
    protected $fillable = [
        'user_id',
        'prize_amount',
        'prize_label',
    ];

    protected function casts(): array
    {
        return [
            'prize_amount' => 'integer',
        ];
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
