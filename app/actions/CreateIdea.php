<?php

namespace App\actions;

use App\Http\Requests\StoreIdeaRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateIdea{
    public function handle(array $attributes, ?User $user = null){
        $user ??= Auth::user();
        $data = collect($attributes)->only([
            'title', 'description', 'status', 'links'
        ])->toArray();

        if($attributes['image'] ?? false){
            $data['image_path'] = $attributes['image']->store('ideas', 'public');
        }

        DB::transaction(function() use ($data, $user){
            $idea = $user->ideas()->create($data);
            $steps = collect($attributes['steps'] ?? [])->map(fn($step) => ['description' => $step]);
            $idea->steps()->createMany($steps);
        });
    }
}
