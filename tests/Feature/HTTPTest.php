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
    }
}
