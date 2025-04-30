<?php

namespace Database\Seeders;

use App\Models\FileAttente;
use Illuminate\Database\Seeder;

class FileAttenteSeeder extends Seeder
{
    public function run()
    {
        $fileAttentes = [
            [
                'patient_id' => 1,
                'consultation_id' => 1,
                'heure_arrivee' => now()->subHours(1),
                'position' => 1,
                'statut' => 'en_attente',
            ],
            [
                'patient_id' => 2,
                'consultation_id' => 2,
                'heure_arrivee' => now()->subMinutes(30),
                'position' => 1,
                'statut' => 'en_attente',
            ],
        ];

        foreach ($fileAttentes as $fileAttente) {
            FileAttente::create($fileAttente);
        }
    }
}