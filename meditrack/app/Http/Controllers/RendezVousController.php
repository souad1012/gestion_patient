<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\RendezVous;
use Illuminate\Http\Request;

class RendezVousController extends Controller
{
    public function index()
    {
        $rendezVous = RendezVous::with('patient')->get();
        return view('rendez_vous.index', compact('rendezVous'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('rendez_vous.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date_heure' => 'required|date',
            'motif' => 'nullable|string',
            'confirme' => 'boolean',
        ]);

        RendezVous::create($validated);

        return redirect()->route('rendez_vous.index')
            ->with('success', 'Rendez-vous créé avec succès.');
    }

    public function show(RendezVous $rendezVous)
    {
        return view('rendez_vous.show', compact('rendezVous'));
    }

    public function edit(RendezVous $rendezVous)
    {
        $patients = Patient::all();
        return view('rendez_vous.edit', compact('rendezVous', 'patients'));
    }

    public function update(Request $request, RendezVous $rendezVous)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date_heure' => 'required|date',
            'motif' => 'nullable|string',
            'confirme' => 'boolean',
        ]);

        $rendezVous->update($validated);

        return redirect()->route('rendez_vous.index')
            ->with('success', 'Rendez-vous mis à jour avec succès.');
    }

    public function destroy(RendezVous $rendezVous)
    {
        $rendezVous->delete();

        return redirect()->route('rendez_vous.index')
            ->with('success', 'Rendez-vous supprimé avec succès.');
    }
}