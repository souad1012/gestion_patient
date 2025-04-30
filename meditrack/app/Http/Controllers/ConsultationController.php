<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\RendezVous;
use App\Models\Salle;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function index()
    {
        $consultations = Consultation::with(['rendezVous.patient', 'salle'])->get();
        return view('consultations.index', compact('consultations'));
    }

    public function create()
    {
        $rendezVous = RendezVous::with('patient')->get();
        $salles = Salle::where('disponible', true)->get();
        return view('consultations.create', compact('rendezVous', 'salles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rendez_vous_id' => 'nullable|exists:rendez_vous,id',
            'salle_id' => 'required|exists:salles,id',
            'heure_debut' => 'required|date',
            'heure_fin' => 'nullable|date|after:heure_debut',
            'type' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'statut' => 'required|string|max:255',
        ]);

        Consultation::create($validated);

        // Mettre à jour la disponibilité de la salle
        $salle = Salle::find($request->salle_id);
        $salle->disponible = false;
        $salle->save();

        return redirect()->route('consultations.index')
            ->with('success', 'Consultation créée avec succès.');
    }

    public function show(Consultation $consultation)
    {
        return view('consultations.show', compact('consultation'));
    }

    public function edit(Consultation $consultation)
    {
        $rendezVous = RendezVous::with('patient')->get();
        $salles = Salle::all();
        return view('consultations.edit', compact('consultation', 'rendezVous', 'salles'));
    }

    public function update(Request $request, Consultation $consultation)
    {
        $validated = $request->validate([
            'rendez_vous_id' => 'nullable|exists:rendez_vous,id',
            'salle_id' => 'required|exists:salles,id',
            'heure_debut' => 'required|date',
            'heure_fin' => 'nullable|date|after:heure_debut',
            'type' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'statut' => 'required|string|max:255',
        ]);

        // Si la salle a changé, mettre à jour les disponibilités
        if ($consultation->salle_id != $request->salle_id) {
            // Libérer l'ancienne salle
            $ancienneSalle = Salle::find($consultation->salle_id);
            $ancienneSalle->disponible = true;
            $ancienneSalle->save();

            // Occuper la nouvelle salle
            $nouvelleSalle = Salle::find($request->salle_id);
            $nouvelleSalle->disponible = false;
            $nouvelleSalle->save();
        }

        $consultation->update($validated);

        return redirect()->route('consultations.index')
            ->with('success', 'Consultation mise à jour avec succès.');
    }

    public function destroy(Consultation $consultation)
    {
        // Libérer la salle
        $salle = $consultation->salle;
        $salle->disponible = true;
        $salle->save();

        $consultation->delete();

        return redirect()->route('consultations.index')
            ->with('success', 'Consultation supprimée avec succès.');
    }
}