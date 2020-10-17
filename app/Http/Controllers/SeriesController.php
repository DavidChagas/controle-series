<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Serie;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

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

    public function store(SeriesFormRequest $request, CriadorDeSerie $criadorDeSerie){
        
        $serie = $criadorDeSerie->criarSerie($request->nome, $request->qtd_temporadas, $request->ep_por_temporada);

        // flash() ao contrario do ´put() guarda essa variavel apenas para uma requisição
        $request->session()->flash('mensagem', "Série {$serie->nome} e suas temporadas e episódios criados com sucesso!!!");

        return redirect()->route('listar_series');

    }

    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie){
        $nomeSerie = $removedorDeSerie->removerSerie($request->id);

        $request->session()->flash('mensagem', "Série $nomeSerie removida com sucesso!!!");
        return redirect()->route('listar_series');
    }

    public function editaNome(int $id, Request $request){
        $novoNome = $request->nome;
        $serie = Serie::find($id);
        $serie->nome = $novoNome;
        $serie->save();
    }
}
