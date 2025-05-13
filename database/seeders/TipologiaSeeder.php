<?php

namespace Database\Seeders;

use App\Models\Tipologia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipologiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipologieAuto = [
            ["nome" => "Utilitaria"],
            ["nome" => "City Car"],
            ["nome" => "Berlina"],
            ["nome" => "Berlina compatta"],
            ["nome" => "Berlina di lusso"],
            ["nome" => "SUV"],
            ["nome" => "SUV Compatto"],
            ["nome" => "SUV Coupé"],
            ["nome" => "SUV di lusso"],
            ["nome" => "Crossover"],
            ["nome" => "Station Wagon"],
            ["nome" => "Cabriolet"],
            ["nome" => "Roadster"],
            ["nome" => "Spider"],
            ["nome" => "Coupe"],
            ["nome" => "Monovolume"],
            ["nome" => "Monovolume compatto"],
            ["nome" => "Furgone"],
            ["nome" => "Minivan"],
            ["nome" => "Pickup"],
            ["nome" => "Fuoristrada"],
            ["nome" => "Auto Sportiva"],
            ["nome" => "Supercar"],
            ["nome" => "Hypercar"],
            ["nome" => "Auto Elettrica"],
            ["nome" => "Auto Ibrida"],
            ["nome" => "Auto Plug-in Hybrid"],
            ["nome" => "Auto a idrogeno"],
            ["nome" => "Auto d'epoca"],
            ["nome" => "Auto tuning"],
            ["nome" => "Limousine"],
            ["nome" => "Muscle Car"],
            ["nome" => "Hot Hatch"],
            ["nome" => "Microcar"],
            ["nome" => "Coupé 4 porte"]
        ];

        foreach($tipologieAuto as $tipologiaAuto){
            $tipologiaAuto= new Tipologia( $tipologiaAuto);
            $tipologiaAuto->save();

        }

    }
}
