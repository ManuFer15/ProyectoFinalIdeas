<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Step extends Model
{
    use HasFactory;

    public function idea(): BelongsTo
    {
        return $this->belongsTo(Idea::class);
    }
}
