<?php

namespace Database\Seeders;

use App\Models\EstadoActa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoActaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estados = [
            'Borrador',
            'Publicado',
            'Archivado',
        ];

        foreach ($estados as $name) {
            EstadoActa::create(['name' => $name]);
        }
    }
}
