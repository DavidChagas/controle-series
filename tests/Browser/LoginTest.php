<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLoginSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/entrar')
                ->typeSlowly('email', 'david@teste.com')
                ->typeSlowly('password', '123')
                ->click('@botao-entrar')
                ->assertPathIs('/')
                ->assertSeeLink('Sair');
        });
    }

    public function testLoginError()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/entrar')
                ->typeSlowly('email', 'david@teste')
                ->typeSlowly('password', '1234')
                ->click('@botao-entrar')
                ->assertPathIs('/entrar')
                ->assertSee('Usuário e/ou senha incorretos');
        });
    }
}
