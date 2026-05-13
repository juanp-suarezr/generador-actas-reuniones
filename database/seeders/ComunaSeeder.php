<?php

namespace Database\Seeders;

use App\Models\Comuna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            // Comunas
            'Comuna Boston',
            'Comuna Centro',
            'Comuna Consota',
            'Comuna Cuba',
            'Comuna Del Cafe',
            'Comuna El Jardín',
            'Comuna El Oso',
            'Comuna El Poblado',
            'Comuna El Rocío',
            'Comuna Ferrocarril',
            'Comuna Olímpica',
            'Comuna Oriente',
            'Comuna Perla Del Otún',
            'Comuna Rio Otún',
            'Comuna San Joaquin',
            'Comuna San Nicolas',
            'Comuna Universidad',
            'Comuna Villasantana',
            'Comuna Villavicencio',
            // Corregimientos
            'Corregimiento Altagracia',
            'Corregimiento Arabia',
            'Corregimiento Caimalito',
            'Corregimiento Cerritos',
            'Corregimiento Combia Alta',
            'Corregimiento Combia Baja',
            'Corregimiento La Bella',
            'Corregimiento La Estrella -- La palmilla',
            'Corregimiento La Florida',
            'Corregimiento Morelia',
            'Corregimiento Puerto Caldas',
            'Corregimiento Tribunas Córcega',
        ];

        foreach ($locations as $name) {
            Comuna::create(['name' => $name]);
        }
    }
}


