<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auto;
use App\Models\Carburante;
use App\Models\Tipologia;
use Illuminate\Support\Facades\Storage;

class AutoController extends Controller
{
    // Metodo per mostrare la lista delle auto
    public function index()
    {
        $tipologie=Tipologia::all();
        $carburanti=Carburante::all();
        $auto = Auto::all();
        return view('auto.index', compact('auto', 'tipologie', 'carburanti'));
    }






     // Metodo per mostrare i dettagli di una singola auto
    public function show($id)
    {
        // Trova l'auto con l'id specificato
        $auto = Auto::findOrFail($id);

        return view('auto.show', compact('auto'));
    }






    // Metodo per mostrare il form di creazione dell'auto
    public function create()
    {
        $auto =new Auto();
        $tipologie = Tipologia::all();
        $carburanti = Carburante::all();
        return view('auto.create' , compact('auto', 'tipologie','carburanti'));
    }





    public function store(Request $request)
    {
        // Validazione dei dati
        $data = $request->validate([
            'foto.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Accetta più file
            'anno' => 'required|integer',
            'marca' => 'required|string|max:255',
            'modello' => 'required|string|max:255',
            'cilindrata' => 'required|integer',
            'cavalli' => 'required|integer',
            'emissioni' => 'required|string|max:255',
            'km' => 'required|integer',
            'colore' => 'required|string|max:255',
            'cambio' => 'required|string|max:255',
            'posti' => 'required|integer',
            'porte' => 'required|integer',
            'prezzo' => 'required|integer',
            'nuova' => 'required|boolean',
            'tipologia_id' => 'required|exists:tipologias,id',
            'carburante_id' => 'required|exists:carburantes,id',
            'descrizione' => 'required|string',
            'status' => 'required|in:disponibile,venduta',
        ]);

        // Creazione di un nuovo oggetto Auto
        $auto = new Auto();
        $auto->anno = $data['anno'];
        $auto->marca = $data['marca'];
        $auto->modello = $data['modello'];
        $auto->cilindrata = $data['cilindrata'];
        $auto->cavalli = $data['cavalli'];
        $auto->emissioni = $data['emissioni'];
        $auto->km = $data['km'];
        $auto->colore = $data['colore'];
        $auto->cambio = $data['cambio'];
        $auto->posti = $data['posti'];
        $auto->porte = $data['porte'];
        $auto->prezzo = $data['prezzo'];
        $auto->nuova = $data['nuova'];
        $auto->tipologia_id = $data['tipologia_id'];
        $auto->carburante_id = $data['carburante_id'];
        $auto->descrizione = $data['descrizione'];
        $auto->status = $data['status'];

        // Salvataggio delle immagini
        $fotoPaths = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $path = $file->store('imgAuto', 'public');
                $fotoPaths[] = $path;
            }
        }

        // Salva le immagini come JSON nel database
        $auto->foto = json_encode($fotoPaths);
        $auto->save();

        return redirect()->route('auto.index')->with('success', 'Auto aggiunta con successo!');
    }





    // Metodo per mostrare il form di modifica dell'auto
    public function edit($id)
    {
        $auto = Auto::findOrFail($id);
        $tipologie = Tipologia::all();
        $carburanti = Carburante::all();

        return view('auto.edit', compact('auto', 'tipologie','carburanti'));
    }




    public function update(Request $request, $id)
    {
        // Validazione
        $request->validate([
            'foto.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'anno' => 'required|integer',
            'marca' => 'required|string|max:255',
            'modello' => 'required|string|max:255',
            'cilindrata' => 'required|integer',
            'cavalli' => 'required|integer',
            'emissioni' => 'required|string|max:255',
            'km' => 'required|integer',
            'colore' => 'required|string|max:255',
            'cambio' => 'required|string|max:255',
            'posti' => 'required|integer',
            'porte' => 'required|integer',
            'prezzo' => 'required|integer',
            'nuova' => 'required|boolean',
            'tipologia_id' => 'required|exists:tipologias,id',
            'carburante_id' => 'required|exists:carburantes,id',
            'descrizione' => 'required|string',
            'status' => 'required|in:disponibile,venduta',
        ]);

        $auto = Auto::findOrFail($id);

        // Se ci sono nuove immagini, elimina le vecchie
        if ($request->hasFile('foto')) {
            // Recupera le immagini attuali dal database
            $fotoPaths = json_decode($auto->foto, true) ?? [];

            // Elimina le immagini esistenti dallo storage
            foreach ($fotoPaths as $foto) {
                Storage::disk('public')->delete($foto);
            }

            // Carica le nuove immagini
            $newFotoPaths = [];
            foreach ($request->file('foto') as $file) {
                $path = $file->store('imgAuto', 'public');
                $newFotoPaths[] = $path;
            }

            // Aggiorna il campo `foto` nel database con le nuove immagini
            $auto->foto = json_encode($newFotoPaths);
        }

        // Aggiornamento dei campi
        $auto->update([
            'anno' => $request->anno,
            'marca' => $request->marca,
            'modello' => $request->modello,
            'cilindrata' => $request->cilindrata,
            'cavalli' => $request->cavalli,
            'emissioni' => $request->emissioni,
            'km' => $request->km,
            'colore' => $request->colore,
            'cambio' => $request->cambio,
            'posti' => $request->posti,
            'porte' => $request->porte,
            'prezzo' => $request->prezzo,
            'nuova' => $request->nuova,
            'tipologia_id' => $request->tipologia_id,
            'carburante_id' => $request->carburante_id,
            'descrizione' => $request->descrizione,
            'status' => $request->status,
        ]);

        return redirect()->route('auto.index')->with('success', 'Auto aggiornata con successo!');
    }


    public function search(Request $request)
    {

        $query = Auto::query();

        // Filtraggio per marca
        if ($request->has('marca') && $request->marca != '') {
            $query->where('marca', 'like', '%' . $request->marca . '%');
        }

        if ($request->has('modello') && $request->modello != '') {
            $query->where('modello', 'like', '%' . $request->modello . '%');
        }

        // Filtraggio per condizione (nuova o usata)
        if ($request->has('nuova') && $request->nuova != '') {
            $query->where('nuova', $request->nuova);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Esegui la query e ottieni i risultati
        $auto = $query->get();

        $tipologie= Tipologia::all();
        $carburanti = Carburante::all();

        // Restituisci la vista con i dati filtrati
        return view('auto.index', compact('auto', 'tipologie','carburanti'));
    }



    // Metodo per eliminare un'auto dal database
    public function destroy($id)
    {
        $auto = Auto::findOrFail($id);
        $auto->delete();

        return redirect()->route('auto.index')->with('success', 'Auto spostata nel cestino!');
    }

    public function restore($id)
    {
        $auto = Auto::withTrashed()->findOrFail($id);
        $auto->restore(); // Ripristina l'auto
        return redirect()->back()->with('success', 'Auto ripristinata con successo.');
    }

    public function forceDelete($id)
    {
        $auto = Auto::withTrashed()->findOrFail($id);
        $auto->forceDelete(); // Elimina definitivamente l'auto
        return redirect()->back()->with('success', 'Auto eliminata definitivamente.');
    }

    public function trashed()
    {
        $trashedAutos = Auto::onlyTrashed()->get(); // Recupera solo le auto nel cestino
        return view('auto.cestino', compact('trashedAutos'));
    }
}




