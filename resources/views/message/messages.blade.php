@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Messaggi Ricevuti</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Messaggio</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
            <tr>
                <td>{{ $message->name }}</td>
                <td>{{ $message->email }}</td>
                <td>{{ $message->message }}</td>
                <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
