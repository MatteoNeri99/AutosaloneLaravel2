@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Auto nel Cestino</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($trashedAutos->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Marca</th>
                        <th>Modello</th>
                        <th>Anno</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trashedAutos as $auto)
                        <tr>
                            <td>{{ $auto->marca }}</td>
                            <td>{{ $auto->modello }}</td>
                            <td>{{ $auto->anno }}</td>
                            <td>
                                <a href="{{ route('auto.restore', $auto->id) }}" class="btn btn-success">Ripristina</a>
                                <a href="{{ route('auto.forceDelete', $auto->id) }}" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare definitivamente questa auto?')">Elimina Definitivamente</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Non ci sono auto nel cestino.</p>
        @endif

        <a href="{{ url('/home') }}" class="btn btn-primary">Torna alla Home</a>
    </div>
@endsection
