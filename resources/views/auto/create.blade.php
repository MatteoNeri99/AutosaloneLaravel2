@vite(['resources/sass/form.scss'])
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Aggiungi Nuova Auto</h1>

    <form action="{{ route('auto.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex">
            <div class="contenitore">
                <div class="form-group">
                    <label for="anno">Anno</label>
                    <input type="number" class="form-control" id="anno" name="anno" required>
                </div>

                <div class="form-group">
                    <label for="marca">Marca</label>
                    <input type="text" class="form-control" id="marca" name="marca" required>
                </div>

                <div class="form-group">
                    <label for="modello">Modello</label>
                    <input type="text" class="form-control" id="modello" name="modello" required>
                </div>

                <div class="form-group">
                    <label for="tipologia_id">Tipologia:</label>
                    <select class='form-select' name="tipologia_id" id="tipologia_id">
                        @foreach ($tipologie as $tipologia)

                        <option value="{{ $tipologia->id }}">{{$tipologia->nome}}</option>

                        @endforeach


                    </select>
                </div>

                <div class="form-group">
                    <label for="cilindrata">Cilindrata</label>
                    <input type="number" class="form-control" id="cilindrata" name="cilindrata" required>
                </div>

                <div class="form-group">
                    <label for="cavalli">Cavalli</label>
                    <input type="number" class="form-control" id="cavalli" name="cavalli" required>
                </div>

                <div class="form-group">
                    <label for="emissioni">Emissioni</label>
                    <input type="text" class="form-control" id="emissioni" name="emissioni" required>
                </div>

                <div class="form-group">
                    <label for="carburante_id">Carburante:</label>
                    <select class='form-select' name="carburante_id" id="carburante_id">
                        @foreach ($carburanti as $carburante)

                        <option value="{{ $carburante->id }}">{{$carburante->nome}}</option>

                        @endforeach


                    </select>
                </div>

                <div class="form-group">
                    <label for="km">Km</label>
                    <input type="number" class="form-control" id="km" name="km" required>
                </div>
            </div>


            <div class="contenitore">
                <div class="form-group">
                    <label for="cambio">Cambio</label>
                    <input type="text" class="form-control" id="cambio" name="cambio" required>
                </div>

                <div class="form-group">
                    <label for="colore">Colore</label>
                    <input type="text" class="form-control" id="colore" name="colore" required>
                </div>

                <div class="form-group">
                    <label for="posti">Posti</label>
                    <input type="number" class="form-control" id="posti" name="posti" required>
                </div>

                <div class="form-group">
                    <label for="porte">Porte</label>
                    <input type="number" class="form-control" id="porte" name="porte" required>
                </div>

                <div class="form-group">
                    <label for="prezzo">Prezzo</label>
                    <input type="number" class="form-control" id="prezzo" name="prezzo" required>
                </div>

                <div class="form-group">
                    <label for="nuova">Nuova</label>
                    <select class="form-control" id="nuova" name="nuova" required>
                        <option value="1">Sì</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="disponibile" @if(old('status') == 'disponibile') selected @endif>Disponibile</option>
                        <option value="venduta" @if(old('status') == 'venduta') selected @endif>Venduta</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="descrizione">Descrizione</label>
                    <textarea class="form-control" id="descrizione" name="descrizione" required> </textarea>
                </div>

                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control-file" id="foto" name="foto[]"  multiple required>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Aggiungi Auto</button>
    </form>
</div>
@endsection

