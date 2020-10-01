<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeriesController extends Controller{
    public function index(Request $request){
    	// $request->url()   	 Pega a url
    	// $request->query('id') Pega um parametro passado pela url
    	// $request->query()     Pega todos parametros passados pela url

    	$series = [
            'Grey\'s Anatomy',
            'Lost',
            'Agents of SHIELD'
        ];

    	return view('series.index', compact('series'));

    }

    public function create()
    {
        return view('series.create');
    }
}
