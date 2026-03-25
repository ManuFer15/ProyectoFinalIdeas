<?php

namespace App\actions;

use App\Models\Idea;
use Illuminate\Support\Facades\DB;

class UpdateIdea
{
    /**
     * Actualiza la idea y sincroniza su lista de pasos.
     */
    public function handle(array $attributes, Idea $idea)
    {
        // Campos permitidos para actualización masiva.
        $data = collect($attributes)->only([
            'title', 'description', 'status', 'links',
        ])->toArray();

        if ($attributes['image'] ?? false) {
            $data['image_path'] = $attributes['image']->store('ideas', 'public');
        }

        // Garantiza consistencia entre cabecera (idea) y detalle (steps).
        DB::transaction(function () use ($idea, $data, $attributes) {
            $idea->update($data);
            // Actualizar pasos: eliminar los antiguos y crear los nuevos
            $idea->steps()->delete();
            $steps = collect($attributes['steps'] ?? [])
                ->filter(fn ($step) => ! empty($step['description']))
                ->toArray();
            if (! empty($steps)) {
                $idea->steps()->createMany($steps);
            }
        });
    }
}
