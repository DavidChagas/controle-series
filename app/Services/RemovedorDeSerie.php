<?php
namespace App\Services;

use App\Models\{Serie, Temporada, Episodio};

class RemovedorDeSerie{

    public function removerSerie(int $serieId) : string{
        $serie = Serie::find($serieId);

        $nome = $serie->nome;

        $serie->temporadas->each( function($temporada){

            $temporada->episodios->each( function($episodio){
                $episodio->delete();
            });

            $temporada->delete();
        });

        $serie->delete();

        //outra forma de deletar
        //$serie = Serie::destroy($serieId);

        return $nome;
    }
}