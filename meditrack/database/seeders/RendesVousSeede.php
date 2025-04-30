<?php

namespace Database\Seeders;

use App\Models\RendezVous;
use Illuminate\Database\Seeder;

class RendezVousSeeder extends Seeder
{
    public function run()
    {
        $rendezVous = [
            [
                'patient_id' => 1,
                'date_heure' => now()->addDays(1)->setHour(9)->setMinute(0),
                'motif' => 'Consultation générale',
                'confirme' => true,
            ],
            [
                'patient_id' => 2,
                'date_heure' => now()->addDays(1)->setHour(10)->setMinute(30),
                'motif' => 'Douleurs abdominales',
                'confirme' => true,
            ],
            [
                'patient_id' => 3,
                'date_heure' => now()->addDays(2)->setHour(14)->setMinute(0),
                'motif' => 'Suivi traitement',
                'confirme' => false,
            ],
        ];

        foreach ($rendezVous as $rdv) {
            RendezVous::create($rdv);
        }
    }
}