<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Salle;
use App\Models\Consultation;
use App\Models\FileAttente;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $patientsCount = Patient::count();
        $sallesCount = Salle::count();
        $consultationsCount = Consultation::count();
        $fileAttentesCount = FileAttente::where('statut', 'en_attente')->count();

        $salles = Salle::all();
        #withCount(['fileAttentes as patients_en_attente' => function ($query) {
        #    $query->where('statut', 'en_attente');
        #}])->get();

        return view('home', compact(
            'patientsCount',
            'sallesCount',
            'consultationsCount',
            'fileAttentesCount',
            'salles'
        ));
    }
}
