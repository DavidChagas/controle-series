<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model{
	// não cria as colunas  de criação e atualização da tabela
    public $timestamps = false;

    protected $fillable = ['nome'];

    //as relações das tabelas no laravel são feitas atraves de metodos 
    public function temporadas(){
    	//relação de uma serie (this) para muitas temporadas (Temporada::class)
    	return $this->hasMany(Temporada::class);
    }
}
