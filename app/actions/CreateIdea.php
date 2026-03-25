<?php

namespace App\actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateIdea
{
    public function handle(array $attributes)
    {
        $user = Auth::user();

        $data = collect($attributes)->only([
            'title', 'description', 'status', 'links',
        ])->toArray();

        if ($attributes['image'] ?? false) {
            $data['image_path'] = $attributes['image']->store('ideas', 'public');
        }

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
