@vite(['resources/js/show.js'])
@vite(['resources/sass/show.scss'])

@extends('layouts.app')

@section('content')

<div class="background">

    <p class="titolo">Dettagli Auto: <strong>{{ $auto->marca }} {{ $auto->modello }}</strong></p>
    <hr>

    <div class="card-container">


        <div class="carousel-container">


            <button id="prevBtn" class="carousel-btn">❮</button>

            <div class="carousel">
                @foreach(json_decode($auto->foto, true) as $foto)
                    <img src="{{ asset('storage/' . $foto) }}" alt="Foto Auto" class="carousel-img ">
                @endforeach
            </div>

            <button id="nextBtn" class="carousel-btn">❯</button>

        </div>



        <div >
            <p >Anno: {{ $auto->anno }}</p>
            <p >Cilindrata: {{ $auto->cilindrata }} CC</p>
            <p class="card-text">Tipologia: {{ $auto->tipologia->nome }}</p>
            <p class="card-text">Cavalli: {{ $auto->cavalli }} CV</p>
            <p class="card-text">Carburante: {{ $auto->carburante->nome }}</p>
            <p class="card-text">Km: {{ $auto->km }} km</p>
            <p class="card-text">Colore: {{ $auto->colore }}</p>
            <p class="card-text">Cambio: {{ $auto->cambio }}</p>
            <p class="card-text">Posti: {{ $auto->posti }}</p>
            <p class="card-text">Porte: {{ $auto->porte }}</p>
            <p class="card-text">Prezzo: €{{ number_format($auto->prezzo, 2) }}</p>
            <p class="card-text">Emissioni: {{ $auto->emissioni }}</p>
            <p class="card-text">Condizione: {{ $auto->nuova ? 'Nuova' : 'Usata' }}</p>
        </div>
    </div>

    <div class="descrizione">
        <h2>Descrizione :</h2>
        <p>{!! nl2br(e($auto->descrizione)) !!}</p>
    </div>

</div>
@endsection



