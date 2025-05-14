<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HTTPTest extends TestCase
{

    // funzione per controllare function del AutoController
    public function test_function_AutoController(){

        //elimino tutti i record nella tabella autos
        \App\Models\Auto::truncate();

        //disabilitato CSRF
        $this->withoutMiddleware();

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

        ])->assertRedirect('/auto');


        //controllo se l'auto inserita e presente nel databes
        $this->assertDatabaseHas('autos', ['marca' => 'Alfa',
        'modello' => 'Romeo',]);


        //controllo che la function update funzioni correttamente
        //campo modificato colore
        $this->put('/auto/1', [
            'anno' => '2000',
            'marca' => 'Alfa',
            'modello' => 'Romeo',
            'cilindrata' => '2000',
            'cavalli' => '200',
            'emissioni' => 'nessuna',
            'km' => '150000',
            'colore' => 'nera',
            'cambio' => 'automatico',
            'posti' => '4',
            'porte' => '4',
            'prezzo' => '1500',
            'nuova' => false ,
            'tipologia_id' => 2,
            'carburante_id' => 2,
            'descrizione' => 'bella',
            'status' => 'disponibile',
        ])->assertRedirect('/auto');

        //controllo che il campo sia stato effettivamente modificato
        $this->assertDatabaseHas('autos', ['marca' => 'Alfa',
        'modello' => 'Romeo', 'colore'=>'nera']);


        //controlla che la funzione di ricerca funzioni (search)
       $response = $this->get('auto/search?q=nuova')->assertStatus(200);

       //controllo che nel HTML sia presente la parola 'nuova'
       $response->assertSee('nuova');

       //controllo che nel HTML non sia presente la parola 'usata'
       $response->assertDontSee('usata');



       //controllo la funzione di soft delete
       $this->delete('/auto/1')->assertStatus(302);

       //controllo che sia stato effettivamente soft deleted
       $this->assertSoftDeleted('autos', ['id' => 1]);

       //controllo funzionamento di ripristino auto (restore)
       $this->get('/cestino/ripristina/1')->assertStatus(302);


    }


    //controllo caricamento page
    public function test_caricamento_page(){

        //creo un profili fake per permettere l'accesso alle page
        $user = \App\Models\Admin::factory()->create();
        $this->actingAs($user);

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

    public function test_forceDelete(){

       //controllo la funzione di soft delete
       $this->delete('/auto/1')->assertStatus(302);

       //controllo che sia stato effettivamente soft deleted
       $this->assertSoftDeleted('autos', ['id' => 1]);

        $this->get('/cestino/elimina/1')->assertStatus(302);

        $this->assertDatabaseMissing('autos', ['id' => 1]);
    }


}


