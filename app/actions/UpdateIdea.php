<?php

namespace App\actions;

use App\Models\Idea;
use Illuminate\Support\Facades\DB;

class UpdateIdea
{
    public function handle(array $attributes, Idea $idea)
    {
        $data = collect($attributes)->only([
            'title', 'description', 'status', 'links',
        ])->toArray();

        if ($attributes['image'] ?? false) {
            $data['image_path'] = $attributes['image']->store('ideas', 'public');
        }

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
