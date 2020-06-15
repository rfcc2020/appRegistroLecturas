<?php

use Illuminate\Database\Seeder;
use App\sector;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        sector::create([
            'nombre'        => 'portete',
        ]);
        sector::create([
            'nombre'        => 'pedregal',
        ]);
        sector::create([
            'nombre'        => 'la union',
        ]);
        sector::create([
            'nombre'        => 'rayoloma',
        ]);
    }
}
