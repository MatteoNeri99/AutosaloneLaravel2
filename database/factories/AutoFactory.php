<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Auto>
 */
class AutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'anno' => $this->faker->year(),
            'marca' => $this->faker->word(),
            'modello' => $this->faker->word(),
            'cilindrata' => $this->faker->numberBetween(1000,3000),
            'cavalli' => $this->faker->numberBetween(50,500),
            'emissioni' => $this->faker->randomElement(['euro3', 'euro5']),
            'km' => $this->faker->numberBetween(0,350000),
            'colore' => $this->faker->colorName(),
            'cambio' => $this->faker->randomElement(['manuale', 'automatico']),
            'posti' => $this->faker->numberBetween(3,5),
            'porte' => $this->faker->numberBetween(3,5),
            'prezzo' => $this->faker->numberBetween(1000,10000),
            'nuova' => $this->faker->boolean(),
            'tipologia_id' =>  \App\Models\Tipologia::inRandomOrder()->first()?->id,
            'carburante_id' => \App\Models\Carburante::inRandomOrder()->first()?->id,
            'descrizione' => $this->faker->text(100),
            'status' => $this->faker->randomElement(['nuova', 'usata']),
        ];
    }
}
