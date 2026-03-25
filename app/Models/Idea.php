<?php

namespace App\Models;

use App\IdeaStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Idea extends Model
{
    use HasFactory;

    /**
     * Conversión de atributos para trabajar con tipos de dominio en PHP.
     */
    protected $casts = [
        'links' => 'array',
        'status' => IdeaStatus::class,
    ];

    /**
     * Estado inicial al crear una idea sin estado explícito.
     */
    protected $attributes = [
        'status' => IdeaStatus::PENDIENTE,
    ];

    /**
     * Devuelve el total de ideas del usuario agrupadas por estado.
     */
    public static function statusCounts(User $user): Collection
    {
        $counts = $user->ideas()
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        return collect(IdeaStatus::cases())
            ->mapWithKeys(fn ($status) => [
                $status->value => $counts->get($status->value, 0),
            ])->put('all', $user->ideas()->count());
    }

    public function user(): BelongsTo
    {
        // Cada idea pertenece a un único autor.
        return $this->belongsTo(User::class);
    }

    public function steps(): HasMany
    {
        // Una idea puede descomponerse en múltiples pasos.
        return $this->hasMany(Step::class);
    }

    public function formattedDescription(): Attribute
    {
        // Exponer la descripción como Stringable para facilitar formateo en vistas.
        return Attribute::get(fn ($value, $attributes) => str($attributes['description']));
    }
}
