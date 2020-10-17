<?php

namespace Tests\Feature;

use App\Models\Serie;
use App\Services\CriadorDeSerie;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CriadorDeSerieTest extends TestCase
{
    public function testCriarSerie(){
        DB::beginTransaction();
            $criadorDeSerie = new CriadorDeSerie();
            $nomeSerie = 'Nome de teste';
            $serieCriada = $criadorDeSerie->criarSerie($nomeSerie, 1, 1);

            // tipo série
            $this->assertInstanceOf(Serie::class, $serieCriada);
            // confere se no banco existe os registros inseridos
            $this->assertDatabaseHas('series', ['nome' => $nomeSerie]);
            $this->assertDatabaseHas('temporadas', ['serie_id' => $serieCriada->id, 'numero'=> 1]);
            $this->assertDatabaseHas('episodios', ['numero'=> 1]);
        DB::rollBack();
    }
}
