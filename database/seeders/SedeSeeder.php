<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sedes;


class SedeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Sedes::create(['nombre_sede' => 'SEDE CENTRAL', 'direccion' => 'Jr. Deustua 356, Puno 21001']);
        Sedes::create(['nombre_sede' => 'SUB SEDE', 'direccion' => 'Jr Lima, 152']);
        // Sedes::create(['nombre_sede' => 'SEDE JULIACA', 'direccion' => 'Jr Arequipa, 203']);
    }
}
