<?php
namespace App\Services;

use App\Models\Serie;

class CriadorDeSerie{

    public function criarSerie(string $nomeSerie, int $qtdTemporada, int $epPorTemporada) : Serie{
        // especificar na classe os atributos que o crete poderá receber atraves da variavel $fillable 
        $serie = Serie::create(['nome' => $nomeSerie]);

        // salva no banco já com o relacionamento
        $qtdTemporadas = $qtdTemporada;
        for ($i = 0; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            for ($j = 1; $j <= $epPorTemporada; $j++) {
                $temporada->episodios()->create(['numero' => $j]);
            }
        }

        return $serie;
    }
}