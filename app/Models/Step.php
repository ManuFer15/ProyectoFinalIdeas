<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Step extends Model
{
    use HasFactory;

    protected $attributes = [
        'completada' => false,
    ];

    public function idea(): BelongsTo
    {
        return $this->belongsTo(Idea::class);
    }
}
