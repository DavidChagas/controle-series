<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Temporada;
use App\Models\Episodio;

class EpisodiosController extends Controller{
    public function index(Temporada $temporada, Request $request){
        $episodios = $temporada->episodios;
       	$temporadaId = $temporada->id;

       	return view('episodios.index', ['episodios' => $temporada->episodios,'temporadaId' => $temporada->id, 'mensagem' => $request->session()->get('mensagem')]);
    }

    public function assistir(Temporada $temporada, Request $request){
    	$episodiosAssistidos = $request->episodios;

        $temporada->episodios->each(function (Episodio $episodio) use ($episodiosAssistidos){
            $episodio->assistido = in_array($episodio->id, $episodiosAssistidos);
        });

        $temporada->push();
        $request->session()->flash('mensagem', 'Episódios marcados como assistidos');

        return redirect()->back();
	}
}
