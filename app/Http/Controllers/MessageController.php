<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);

        Message::create($data);

        return response()->json(['message' => 'Messaggio salvato con successo!']);
    }

    // Recupera tutti i messaggi (solo per il backend)
    public function index()
    {
        return response()->json(Message::orderBy('created_at', 'desc')->get());
    }

    public function showAdminMessages()
    {
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('message.messages', compact('messages'));
    }

}


