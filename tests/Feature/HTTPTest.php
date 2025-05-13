<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HTTPTest extends TestCase
{
    public function HTTP_test(){

        //controllo caricamento homepage
       $this->get('/home')->assertStatus(200);

        //controllo caricamento auto (index)
       $this->get('/auto')->assertStatus(200);

        //controllo caricamento page messaggi ricevuti
       $this->get('/admin/messages')->assertStatus(200);

        //controllo caricamento page per aggiungere auto
       $this->get('/auto/create')->assertStatus(200);

        //controllo caricamento page per modificare auto
       $this->get('/auto/1/edit')->assertStatus(200);

       //controllo caricamento page che mostra una sola auto (show)
       $this->get('/auto/1')->assertStatus(200);

        //controllo caricamento page che mostra le auto sof deleted
       $this->get('/cestino')->assertStatus(200);


    }
}
