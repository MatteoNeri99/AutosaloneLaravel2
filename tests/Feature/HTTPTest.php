<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Auto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HTTPTest extends TestCase
{
    public function test_utente_creazione_auto(){

        //elimino tutti i record nella tabella autos
        Auto::truncate();

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

    }


    // funzione per controllare function del AutoController
    public function test_utente_modifica_auto(){

        //disabilitato CSRF
        $this->withoutMiddleware();

        $auto = Auto::factory()->create([
            'carburante_id' => 1,
            'tipologia_id' => 1
        ]);

        //controllo che la function update funzioni correttamente
        $this->put("/auto/{$auto -> id}", [
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

        //controllo che i campi siano stati effettivamente modificati
        $this->assertDatabaseHas('autos', ['marca' => 'Alfa',
        'modello' => 'Romeo', 'colore'=>'nera']);

    }


    public function test_funzione_ricerca(){

        //disabilitato CSRF
        $this->withoutMiddleware();

        //controlla che la funzione di ricerca funzioni (search)
        $response = $this->get('auto/search?q=nuova')->assertStatus(200);

        //controllo che nel HTML sia presente la parola 'nuova'
        $response->assertSee('nuova');

        //controllo che nel HTML non sia presente la parola 'usata'
        $response->assertDontSee('usata');

    }

    public function test_softDelete (){

        //disabilitato CSRF
        $this->withoutMiddleware();

        $auto = Auto::factory()->create([
            'carburante_id' => 1,
            'tipologia_id' => 1
        ]);

        //controllo la funzione di soft delete
        $this->delete("/auto/{$auto-> id}")->assertStatus(302);

        //controllo che sia stato effettivamente soft deleted
        $this->assertSoftDeleted('autos', ['id' => $auto-> id]);

        //controllo funzionamento di ripristino auto (restore)
        $this->get("/cestino/ripristina/{$auto-> id}")->assertStatus(302);
    }




    //controllo caricamento page
    public function test_caricamento_page(){

        //creo un profili fake per permettere l'accesso alle page
        $user = Admin::factory()->create();
        $this->actingAs($user);

        $auto = Auto::factory()->create([
            'carburante_id' => 1,
            'tipologia_id' => 1
        ]);

        //controllo caricamento homepage
        $this->get('/home')->assertStatus(200);

        //controllo caricamento auto (index)
        $this->get('/auto')->assertStatus(200);

        //controllo caricamento page messaggi ricevuti
        $this->get('/admin/messages')->assertStatus(200);

        //controllo caricamento page per aggiungere auto (create)
        $this->get('/auto/create')->assertStatus(200);

        //controllo caricamento page per modificare auto (edit)
        $this->get("/auto/{$auto-> id}/edit")->assertStatus(200);

        //controllo caricamento page che mostra una sola auto (show)
        $this->get("/auto/{$auto-> id}")->assertStatus(200);

        //controllo caricamento page che mostra le auto sof deleted (trashed)
        $this->get('/cestino')->assertStatus(200);

        //elimino tutti i record nella tabella autos
        Auto::truncate();

    }

    //public function test_forceDelete(){

        //$auto = \App\Models\Auto::factory()->create();

        //controllo la funzione di soft delete
        //$this->delete("/auto/{$auto->id}")->assertStatus(302);

        //controllo che sia stato effettivamente soft deleted
        //$this->assertSoftDeleted('autos', ['id' => $auto->id]);

        //$this->get("/cestino/elimina/{$auto->id}")->assertStatus(302);

        //$this->assertDatabaseMissing('autos', ['id' => $auto->id]);


    //}


}


