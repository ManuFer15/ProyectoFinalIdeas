<?php

namespace App\actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateIdea
{
    /**
     * Crea una idea para el usuario autenticado junto con sus pasos.
     */
    public function handle(array $attributes)
    {
        $user = Auth::user();

        // Lista blanca de campos persistibles para evitar guardar input no esperado.
        $data = collect($attributes)->only([
            'title', 'description', 'status', 'links',
        ])->toArray();

        if ($attributes['image'] ?? false) {
            $data['image_path'] = $attributes['image']->store('ideas', 'public');
        }

        // La creación de idea y pasos debe ser atómica.
        DB::transaction(function () use ($data, $user, $attributes) {
            $idea = $user->ideas()->create($data);
            // Crear los pasos filtrando solo aquellos que tengan descripción
            $steps = collect($attributes['steps'] ?? [])
                ->filter(fn ($step) => ! empty($step['description']))
                ->toArray();
            if (! empty($steps)) {
                $idea->steps()->createMany($steps);
            }
        });
    }
}
