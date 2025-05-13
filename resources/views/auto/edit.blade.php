@vite(['resources/sass/form.scss'])
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifica Auto</h1>

    <form action="{{ route('auto.update', $auto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="flex">
            <div class="contenitore">
                <div class="form-group">
                    <label for="anno">Anno</label>
                    <input type="number" class="form-control" id="anno" name="anno" value="{{ old('anno', $auto->anno) }}" required>
                </div>

                <div class="form-group">
                    <label for="marca">Marca</label>
                    <input type="text" class="form-control" id="marca" name="marca" value="{{ old('marca', $auto->marca) }}" required>
                </div>

                <div class="form-group">
                    <label for="modello">Modello</label>
                    <input type="text" class="form-control" id="modello" name="modello" value="{{ old('modello', $auto->modello) }}" required>
                </div>

                <div class="form-group">
                    <label for="tipologia_id">Tipologia:</label>
                    <select class='form-select' name="tipologia_id" id="tipologia_id">

                        @foreach($tipologie as $tipologia)
                            <option value="{{ $tipologia->id }}" {{ old('tipologia_id', $auto->tipologia_id) == $tipologia->id ? 'selected' : '' }}>
                                {{ $tipologia->nome }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label for="cilindrata">Cilindrata</label>
                    <input type="number" class="form-control" id="cilindrata" name="cilindrata" value="{{ old('cilindrata', $auto->cilindrata) }}" required>
                </div>

                <div class="form-group">
                    <label for="cavalli">Cavalli</label>
                    <input type="number" class="form-control" id="cavalli" name="cavalli" value="{{ old('cavalli', $auto->cavalli) }}" required>
                </div>

                <div class="form-group">
                    <label for="emissioni">Emissioni</label>
                    <input type="text" class="form-control" id="emisione" name="emissioni" value="{{ old('emissioni', $auto->emissioni) }}" required>
                </div>

                <div class="form-group">
                    <label for="carburante_id">Carburante:</label>
                    <select class='form-select' name="carburante_id" id="carburante_id">

                        @foreach($carburanti as $carburante)
                            <option value="{{ $carburante->id }}" {{ old('carburante_id', $auto->carburante_id) == $carburante->id ? 'selected' : '' }}>
                                {{ $carburante->nome }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label for="km">Km</label>
                    <input type="number" class="form-control" id="km" name="km" value="{{ old('km', $auto->km) }}" required>
                </div>
            </div>

            <div class="contenitore">
                <div class="form-group">
                    <label for="cambio">cambio</label>
                    <input type="text" class="form-control" id="cambio" name="cambio" value="{{ old('cambio', $auto->cambio) }}" required>
                </div>

                <div class="form-group">
                    <label for="colore">Colore</label>
                    <input type="text" class="form-control" id="colore" name="colore" value="{{ old('colore', $auto->colore) }}" required>
                </div>

                <div class="form-group">
                    <label for="posti">Posti</label>
                    <input type="number" class="form-control" id="posti" name="posti" value="{{ old('posti', $auto->posti) }}" required>
                </div>

                <div class="form-group">
                    <label for="porte">Porte</label>
                    <input type="number" class="form-control" id="porte" name="porte" value="{{ old('porte', $auto->porte) }}" required>
                </div>

                <div class="form-group">
                    <label for="prezzo">Prezzo</label>
                    <input type="number" class="form-control" id="prezzo" name="prezzo" value="{{ old('prezzo', $auto->prezzo) }}" required>
                </div>

                <div class="form-group">
                    <label for="nuova">Condizione</label>
                    <select class="form-control" id="nuova" name="nuova" required>
                        <option value="1" {{ $auto->nuova == 1 ? 'selected' : '' }}>Nuova</option>
                        <option value="0" {{ $auto->nuova == 0 ? 'selected' : '' }}>Usata</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="disponibile" @if(old('status', $auto->status) == 'disponibile') selected @endif>Disponibile</option>
                        <option value="venduta" @if(old('status', $auto->status) == 'venduta') selected @endif>Venduta</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="descrizione">Descrizione</label>
                    <textarea class="form-control" id="descrizione" name="descrizione" required>{{ old('descrizione', $auto->descrizione) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="foto">Foto (puoi caricare più immagini):</label>
                    <input type="file" name="foto[]" multiple>
                </div>

        </div>

        </div>

        <button type="submit" class="btn btn-primary">Modifica Auto</button>
    </form>
</div>
@endsection
