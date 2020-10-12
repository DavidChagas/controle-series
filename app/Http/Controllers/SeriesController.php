<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Serie;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller{
    public function index(Request $request){
    	// $request->url()   	 Pega a url
    	// $request->query('id') Pega um parametro passado pela url
    	// $request->query()     Pega todos parametros passados pela url

    	$series = Serie::query()->orderBy('nome')->get();

    	$mensagem = $request->session()->get('mensagem');

    	return view('series.index', compact('series', 'mensagem'));

    }

    public function create(){
        return view('series.create');
    }

    public function store(SeriesFormRequest $request){
        // especificar na classe os atributos que o crete poderá receber atraves da variavel $fillable 
        $serie = Serie::create(['nome' => $request->nome]);
        
        // salva no banco já com o relacionamento
        $qtdTemporadas = $request->qtd_temporadas;
        for($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            for ($j = 1; $j <= $request->ep_por_temporada; $j++) {
                $temporada->episodios()->create(['numero' => $j]);
            }
        }

        // flash() ao contrario do ´put() guarda essa variavel apenas para uma requisição
        $request->session()->flash('mensagem', "Série {$serie->nome} e suas temporadas e episódios criados com sucesso!!!");

        return redirect()->route('listar_series');

    }

    public function destroy(Request $request){
        $serie = Serie::destroy($request->id);

        $request->session()->flash('mensagem', "Série removida com sucesso!!!");
        return redirect()->route('listar_series');
    }
}
