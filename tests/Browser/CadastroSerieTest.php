<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CadastroSerieTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            if ($browser->seeLink('Entrar')) {
                $browser->clickLink('Entrar')
                ->typeSlowly('email', 'david@teste.com')
                ->typeSlowly('password', '123')
                ->click('@botao-entrar');
            }
            
            $browser->clickLink('Adicionar')
                ->typeSlowly('nome', 'SerieTeste')
                ->typeSlowly('qtd_temporadas', '3')
                ->typeSlowly('ep_por_temporada', '8')
                ->click('@botao-criar-serie')
                ->assertPathIs('/')
                ->assertSee('Série SérieTeste e suas temporadas e episódios criados com sucesso!!!');
        });
    }
}
