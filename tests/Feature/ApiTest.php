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
        //controllo il funzionamento della function index e vedo se ritorna l'auto con id 1
        $this->get('/api/auto')->assertStatus(200)->assertJsonPath('data.0.id',1);

        //controllo della funzione show e vedo che ritorni l'auto con id 1
        $this->get('/api/auto/1')->assertStatus(200)->assertJson(['id'=>1]);





    }
}
