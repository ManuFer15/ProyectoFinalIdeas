<?php

namespace Tests\Feature;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

// 👇 QUITAMOS "uses(TestCase::class)" porque ya está en Pest.php
// Solo mantenemos RefreshDatabase si lo necesitas
uses(RefreshDatabase::class);

test('pertenece a un usuario', function () {
    $user = User::factory()->create();
    $idea = Idea::factory()->for($user)->create();

    expect($idea->user)->toBeInstanceOf(User::class)
        ->and($idea->user->id)->toBe($user->id);
});

test('tiene pasos', function () {
    $idea = Idea::factory()->create();

    expect($idea->steps)->toBeEmpty();

    $paso = $idea->steps()->create([
        'description' => 'Este es un paso de prueba'
    ]);

    expect($idea->fresh()->steps)
        ->toHaveCount(1)
        ->and($idea->fresh()->steps->first()->description)
        ->toBe('Este es un paso de prueba');
});
