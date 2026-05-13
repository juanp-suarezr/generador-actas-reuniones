<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cargos = [
            'Director',
            'Coordinador',
            'Asistente',
            'Técnico',
            'Profesional',
            'Secretario',
            'Subsecretario',
            'Funcionario',
            'Contratista',
            'Otro',
        ];

        foreach ($cargos as $name) {
            Cargo::create(['name' => $name]);
        }
    }
}
