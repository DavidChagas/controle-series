<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Serie;

class SeriesController extends Controller{
    public function index(Request $request){
    	// $request->url()   	 Pega a url
    	// $request->query('id') Pega um parametro passado pela url
    	// $request->query()     Pega todos parametros passados pela url

    	$series = Serie::all();

    	return view('series.index', compact('series'));

    }

    public function create(){
        return view('series.create');
    }

    public function store(Request $request){
        //$nome = $request->nome;

    	// como os campos retornados do all() é igual aos campos do banco não precisa montar a estrutura para salvar
    	// especificar na classe os atributos que o crete poderá receber atraves da variavel $fillable 
        $serie = Serie::create($request->all());

        echo "Série com id {$serie->id} criada: {$serie->nome}";
    }
}
