@vite(['resources/sass/index.scss'])
@extends('layouts.app')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    <div class="contenitore">
        <form class="form" method="GET" action="{{ route('auto.search') }}">
            <div class="form-group filtro">
                <label for="marca">Marca</label>
                <input type="text" name="marca" class="form-control" value="{{ request('marca') }}">
            </div>

            <div class="form-group filtro">
                <label for="modello">Modello</label>
                <input type="text" name="modello" class="form-control" value="{{ request('modello') }}">
            </div>

            <div class="form-group filtro">
                <label for="nuova">Condizione</label>
                <select name="nuova" class="form-control">
                    <option value="">Tutte</option>
                    <option value="1" {{ request('nuova') == '1' ? 'selected' : '' }}>Nuova</option>
                    <option value="0" {{ request('nuova') == '0' ? 'selected' : '' }}>Usata</option>
                </select>
            </div>

            <div class="form-group filtro">
                <label for="status">Filtra per disponibilità</label>
                <select name="status" id="status" class="form-control" onchange="this.form.submit()">
                    <option value="" @if(request('status') == '') selected @endif>Tutti</option>
                    <option value="disponibile" @if(request('status') == 'disponibile') selected @endif>Disponibile</option>
                    <option value="venduta" @if(request('status') == 'venduta') selected @endif>Venduta</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary filtra">Filtra</button>
        </form>


        <div class="row contenitore-card">
            @foreach($auto as $auto)
                <div class="col-md-4">
                    <div class="card mb-4 auto-card">
                        @php
                            $immagini = json_decode($auto->foto, true);
                        @endphp

                        @if(!empty($immagini) && is_array($immagini))
                            <img src="{{ asset('storage/' . $immagini[0]) }}" class="card-img-top" alt="{{ $auto->marca }} {{ $auto->modello }}">
                        @else
                            <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Immagine non disponibile">
                        @endif

                        <div class="card-body">
                            <h3 class="card-title">{{ $auto->marca }} {{ $auto->modello }}</h3>
                            <p class="card-text"><strong>Anno:</strong> {{ $auto->anno }}</p>
                            <p class="card-text"><strong>Prezzo:</strong> €{{ number_format($auto->prezzo, 2, ',', '.') }}</p>
                            <p class="card-text"><strong>KM:</strong> {{ $auto->km ?? 'N/A' }}</p>
                            <p class="card-text"><strong>Condizione:</strong>
                                <span class="badge {{ $auto->nuova ? 'bg-success' : 'bg-warning' }}">
                                    {{ $auto->nuova ? 'Nuova' : 'Usata' }}
                                </span>
                            </p>

                            <p class="card-text"><strong>Disponibilita:</strong>
                                <span class="badge {{ $auto->status == 'disponibile' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $auto->status  == 'disponibile' ? 'Disponibile' : 'venduta' }}
                                </span>
                            </p>
                            <a href="{{ route('auto.show', $auto) }}" class="btn btn-primary azioni">Dettagli</a>
                            <a href="{{ route('auto.edit', $auto) }}" class="btn btn-warning azioni">Modifica</a>
                            <form action="{{ route('auto.destroy', $auto) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger azioni" onclick="return confirm('Sei sicuro di voler spostare questa auto nel cestino?');">Cestina</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

</div>

@endsection
