<?php

namespace App\Http\Controllers;

use App\Models\FileAttente;
use App\Models\Patient;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FileAttenteController extends Controller
{
    public function index()
    {
        $fileAttentes = FileAttente::with(['patient', 'consultation.salle'])
            ->orderBy('position')
            ->get();
        return view('file_attentes.index', compact('fileAttentes'));
    }

    public function create()
    {
        $patients = Patient::all();
        $consultations = Consultation::whereDoesntHave('fileAttente')
            ->with('salle')
            ->get();
        return view('file_attentes.create', compact('patients', 'consultations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'consultation_id' => 'nullable|exists:consultations,id',
            'heure_arrivee' => 'required|date',
            'statut' => 'required|string|max:255',
        ]);

        // Calculer la position dans la file d'attente
        $position = FileAttente::where('statut', 'en_attente')
            ->when($request->consultation_id, function ($query) use ($request) {
                return $query->where('consultation_id', $request->consultation_id);
            })
            ->count() + 1;

        $validated['position'] = $position;

        FileAttente::create($validated);

        return redirect()->route('file_attentes.index')
            ->with('success', 'Patient ajouté à la file d\'attente avec succès.');
    }

    public function show(FileAttente $fileAttente)
    {
        return view('file_attentes.show', compact('fileAttente'));
    }

    public function edit(FileAttente $fileAttente)
    {
        $patients = Patient::all();
        $consultations = Consultation::with('salle')->get();
        return view('file_attentes.edit', compact('fileAttente', 'patients', 'consultations'));
    }

    public function update(Request $request, FileAttente $fileAttente)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'consultation_id' => 'nullable|exists:consultations,id',
            'heure_arrivee' => 'required|date',
            'position' => 'required|integer|min:1',
            'statut' => 'required|string|max:255',
        ]);

        $fileAttente->update($validated);

        return redirect()->route('file_attentes.index')
            ->with('success', 'File d\'attente mise à jour avec succès.');
    }

    public function destroy(FileAttente $fileAttente)
    {
        // Réorganiser les positions des autres patients dans la file
        FileAttente::where('position', '>', $fileAttente->position)
            ->when($fileAttente->consultation_id, function ($query) use ($fileAttente) {
                return $query->where('consultation_id', $fileAttente->consultation_id);
            })
            ->decrement('position');

        $fileAttente->delete();

        return redirect()->route('file_attentes.index')
            ->with('success', 'Patient retiré de la file d\'attente avec succès.');
    }
}