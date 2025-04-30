<?php

namespace Database\Seeders;

use App\Models\Consultation;
use Illuminate\Database\Seeder;

class ConsultationSeeder extends Seeder
{
    public function run()
    {
        $consultations = [
            [
                'rendez_vous_id' => 1,
                'salle_id' => 1,
                'heure_debut' => now()->addDays(1)->setHour(9)->setMinute(0),
                'heure_fin' => null,
                'type' => 'Consultation',
                'notes' => null,
                'statut' => 'en_attente',
            ],
            [
                'rendez_vous_id' => 2,
                'salle_id' => 2,
                'heure_debut' => now()->addDays(1)->setHour(10)->setMinute(30),
                'heure_fin' => null,
                'type' => 'Urgence',
                'notes' => null,
                'statut' => 'en_attente',
            ],
            [
                'rendez_vous_id' => 3,
                'salle_id' => 3,
                'heure_debut' => now()->addDays(2)->setHour(14)->setMinute(0),
                'heure_fin' => null,
                'type' => 'Spécialiste',
                'notes' => null,
                'statut' => 'en_attente',
            ],
        ];

        foreach ($consultations as $consultation) {
            Consultation::create($consultation);
        }
    }
}