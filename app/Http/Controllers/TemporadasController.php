<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;

class TemporadasController extends Controller
{
    public function index(int $serieId){
    	$serie = Serie::find($serieId);
    	$temporadas = $serie->temporadas;

    	// outra alternativa mais performatica de consulta
    	//$temporadas = Temporada::query()->where('serie_id', $serieId)->orderBy('numero')->get();

    	return View('temporadas.index', compact('temporadas', 'serie'));
	}
}
