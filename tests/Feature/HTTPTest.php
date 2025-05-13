<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HTTPTest extends TestCase
{
    //controllo caricamento page
    public function test_caricamento_page(){

        //controllo caricamento homepage
       $this->get('/home')->assertStatus(200);

        //controllo caricamento auto (index)
       $this->get('/auto')->assertStatus(200);

        //controllo caricamento page messaggi ricevuti
       $this->get('/admin/messages')->assertStatus(200);

        //controllo caricamento page per aggiungere auto (create)
       $this->get('/auto/create')->assertStatus(200);

        //controllo caricamento page per modificare auto (edit)
       $this->get('/auto/1/edit')->assertStatus(200);

       //controllo caricamento page che mostra una sola auto (show)
       $this->get('/auto/1')->assertStatus(200);

        //controllo caricamento page che mostra le auto sof deleted (trashed)
       $this->get('/cestino')->assertStatus(200);


    }

    // funzione per controllare function del AutoController
    public function test_function_AutoController(){

        //controllo inserimento di una nuova auto (store)
        $this->post('/auto', [

             'anno' => '2000',
            'marca' => 'Alfa',
            'modello' => 'Romeo',
            'cilindrata' => '2000',
            'cavalli' => '200',
            'emissioni' => 'nessuna',
            'km' => '150000',
            'colore' => 'bianca',
            'cambio' => 'automatico',
            'posti' => '4',
            'porte' => '4',
            'prezzo' => '1500',
            'nuova' => false ,
            'tipologia_id' => 2,
            'carburante_id' => 2,
            'descrizione' => 'bella',
            'status' => 'disponibile',

        ])->assertStatus(302);
    }
}
