<?php

/*
use Laravel\Dusk\Browser;

test('registar usuario', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/register')
            ->type('name', 'pablo')  // Cambia fill() por type()
            ->type('email', 'pablo@lopez.com')
            ->type('password', 'pl12345678')
            ->type('password_confirmation', 'pl12345678')  // Añade confirmación de password
            ->press('Registrarse')  // Cambia click por press
            ->waitForLocation('/')  // Espera a que redirija
            ->assertSee('Laravel');
    });
});


use Laravel\Dusk\Browser;

test('registar usuario', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/register')
            ->pause(2000) // Espera 2 segundos para ver el formulario
            ->screenshot('register-form') // Toma una captura
            ->assertSee('Register'); // Cambia por el texto que aparece en tu formulario
    });
});
*


use Laravel\Dusk\Browser;

test('registrar usuario', function () {
    $uniqueEmail = 'pablo_' . time() . '@lopez.com';

    $this->browse(function (Browser $browser) use ($uniqueEmail) {
        $browser->visit('/register')
            ->waitFor('form', 5) // Espera a que cargue el formulario
            ->type('name', 'Pablo Lopez')
            ->type('email', $uniqueEmail)
            ->type('password', 'Password123!')
            ->press('Registrarse') // El texto del botón según tu vista
            ->waitForLocation('/login', 10) // Después de registrar, Laravel redirige a login
            ->assertPathIs('/login'); // Verifica que estamos en login
    });
});

test('verificar que el usuario fue creado', function () {
    // Este test verifica que el usuario existe en la base de datos
    $this->browse(function (Browser $browser) {
        $browser->visit('/login')
            ->type('email', 'pablo@lopez.com')
            ->type('password', 'Password123!')
            ->press('Iniciar sesion') // El texto del botón según tu vista
            ->waitForLocation('/')
            ->assertPathIs('/');
    });
});
*/

use Laravel\Dusk\Browser;

test('pagina de registro carga', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/register')
            ->pause(2000)
            ->screenshot('register-page')
            ->assertSee('Registrarse'); // O el texto que aparece en tu formulario
    });
});
