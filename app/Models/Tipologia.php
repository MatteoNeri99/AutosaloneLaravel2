<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipologia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
    ];

    public function autos(){
        return $this->hasMany(Auto::class);
    }
}
