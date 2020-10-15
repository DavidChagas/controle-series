<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temporada extends Model{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['numero'];

    public function episodios(){
    	return $this->hasMany(Episodio::class);
    }

    public function serie(){
    	//relação de uma temporada (this) para uma serie(Serie::class)
    	return $this->belongsTo(Serie::class);
    }

    public function getEpisodiosAssistidos(){
        return $this->episodios->filter(function (Episodio $episodio){
            return $episodio->assistido;
        });
    }
}
