<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Auto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
       'anno', 'marca', 'modello','cilindrata', 'cavalli',
        'emissioni', 'km', 'colore', 'posti', 'porte', 'prezzo',
        'nuova', 'foto', 'tipologia_id','carburante_id','descrizione','status','cambio'
    ];



    public function carburante(){
        return $this->belongsTo(Carburante::class);
    }

    public function tipologia(){
        return $this->belongsTo(Tipologia::class);
    }

    protected $casts = [
        'images' => 'array', // Laravel convertirà automaticamente JSON in un array PHP
    ];
}
