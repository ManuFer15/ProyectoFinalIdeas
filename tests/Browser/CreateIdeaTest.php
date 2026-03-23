<?php

use App\Models\Idea;
use App\Models\User;
use Laravel\Dusk\Browser;

it('crear idea', function () {
    $user = User::factory()->create();

    $this->browse(function (Browser $browser) use ($user) {
        $browser->loginAs($user)
            ->visit('/ideas')
            ->click('@create-idea-button')
            ->pause(1000)  // Espera 1 segundo
            ->type('title', 'Mi nueva idea')
            ->type('description', 'Esta es la descripción de mi nueva idea')
            ->press('Crear')
            ->waitForLocation('/ideas', 10)
            ->assertSee('Mi nueva idea');
    });

    expect(Idea::count())->toBe(1);
});
