@vite(['resources/sass/home.scss'])
@extends('layouts.app')

@section('content')


<div class="container-button">



    <a class="button" href="{{ url('/auto') }}">Tutte le Auto</a>

    <a class="button" href="{{ url('/auto/create') }}">Aggiungi un auto</a>

    <a class="button" href="{{ url('/auto/search?marca=&anno=&prezzo_min=&prezzo_max=&nuova=0&tipologia_id=&carburante_id=&colore=') }}">Auto usate</a>

    <a class="button" href="{{ url('/auto/search?marca=&anno=&prezzo_min=&prezzo_max=&nuova=1&tipologia_id=&carburante_id=&colore=') }}">Auto Nuove</a>

    <a class="button" href="{{ url('/auto/search?marca=&anno=&prezzo_min=&prezzo_max=&nuova=&status=venduta&tipologia_id=&carburante_id=&colore=') }}">Auto vendute</a>

    <a class="button" href="{{ url('/auto/search?marca=&anno=&prezzo_min=&prezzo_max=&nuova=&status=disponibile&tipologia_id=&carburante_id=&colore=') }}">Auto disponibili</a>

    <a class="button" href="{{ url('/admin/messages') }}">Messaggi</a>

    <a href="{{ route('auto.cestino') }}" class="button">Vai al Cestino</a>

</div>
@endsection
