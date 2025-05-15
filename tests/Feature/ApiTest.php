<?php

namespace Tests\Feature;

use App\Models\Auto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_api_controller_function(): void
    {
        //creo un'auto per avere un id dinamico per poter controllare il funzionamento delle funzioni API
       $auto = Auto::factory()->create();

        //controllo il funzionamento della function index
        $this->get('/api/auto')->assertStatus(200)->assertJsonPath('data.0.id',$auto->id);

        //controllo della funzione show
        $this->get("/api/auto/{$auto->id}")->assertStatus(200)->assertJson(['id'=>$auto->id]);


        //creo 9 auto per poter controllare function ultimeAuto
        Auto::factory(9)->create();

        //controllo la funzione ultimeAuto e che ne siano 9
        $this->get('/api/ultime-auto')->assertStatus(200)->assertJsonCount(9);

        //elimino tutti i record nella tabella autos
        Auto::truncate();


    }
}
