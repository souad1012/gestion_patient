<?php

namespace Database\Seeders;

use App\Models\Salle;
use Illuminate\Database\Seeder;

class SalleSeeder extends Seeder
{
    public function run()
    {
        $salles = [
            [
                'nom' => 'Salle A',
                'type' => 'Consultation',
                'capacite' => 10,
                'disponible' => true,
            ],
            [
                'nom' => 'Salle B',
                'type' => 'Urgence',
                'capacite' => 5,
                'disponible' => true,
            ],
            [
                'nom' => 'Salle C',
                'type' => 'Spécialiste',
                'capacite' => 8,
                'disponible' => false,
            ],
        ];

        foreach ($salles as $salle) {
            Salle::create($salle);
        }
    }
}