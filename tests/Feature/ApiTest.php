<?php

namespace Tests\Feature;

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

       $auto= \App\Models\Auto::factory()->create();

        //controllo il funzionamento della function index e vedo se ritorna l'auto con id 1
        $this->get('/api/auto')->assertStatus(200)->assertJsonPath('data.0.id',$auto->id);

        //controllo della funzione show e vedo che ritorni l'auto con id 1
        $this->get("/api/auto/{$auto->id}")->assertStatus(200)->assertJson(['id'=>$auto->id]);





    }
}
