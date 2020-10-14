<?php
namespace App\Services;

use App\Models\{Serie, Temporada, Episodio};
use Illuminate\Support\Facades\DB;

class RemovedorDeSerie{

    public function removerSerie(int $serieId) : string{
        $nome = '';

        DB::transaction( function() use ($serieId, &$nome){

            $serie = Serie::find($serieId);

            $nome = $serie->nome;

            $this->removerTemporadas($serie);

            $serie->delete();
        });

        return $nome;
    }

    private function removerTemporadas(Serie $serie): void{
        $serie->temporadas->each( function($temporada){
            $this->removerEpisodios($temporada);
            $temporada->delete();
        });
    }

    private function removerEpisodios(Temporada $temporada): void{
        $temporada->episodios->each( function($episodio){
            $episodio->delete();
        });
    }
}