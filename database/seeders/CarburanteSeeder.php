<?php

namespace Database\Seeders;

use App\Models\Carburante;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarburanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carburanti = [
            ['nome' => 'Benzina'],
            ['nome' => 'Diesel'],
            ['nome' => 'GPL'],
            ['nome' => 'Metano'],
            ['nome' => 'Elettrico'],
            ['nome' => 'Ibrido Benzina'],
            ['nome' => 'Ibrido Diesel'],
            ['nome' => 'Idrogeno']
        ];

        foreach($carburanti  as $carburante ){
            $carburante = new Carburante( $carburante );
            $carburante ->save();

        }
    }
}
