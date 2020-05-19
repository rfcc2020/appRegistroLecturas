<?php

use Illuminate\Database\Seeder;
use App\Medidor;

class MedidorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Medidor::create([
            'codigo'        => 'MED1',
            'numero'        => '1',
            'marca'   	=> 'LAsi',
            'modelo'		=> 'abc',
            'sector'		=> 'portete',
            'imagen'		=> 'sinimg.jpg',
            'latitud'		=> '0',
            'longitud'		=> '0',
            'estado'		=> 'A',
            'persona_id'		=> '1',
        ]);
        Medidor::create([
            'codigo'        => 'MED2',
            'numero'        => '2',
            'marca'     => 'LAsi',
            'modelo'        => 'abc',
            'sector'        => 'portete',
            'imagen'        => 'sinimg.jpg',
            'latitud'       => '0',
            'longitud'      => '0',
            'estado'        => 'A',
            'persona_id'        => '2',
        ]);
        Medidor::create([
            'codigo'        => 'MED3',
            'numero'        => '3',
            'marca'     => 'LAsi',
            'modelo'        => 'abc',
            'sector'        => 'portete',
            'imagen'        => 'sinimg.jpg',
            'latitud'       => '0',
            'longitud'      => '0',
            'estado'        => 'A',
            'persona_id'        => '3',
        ]);
        Medidor::create([
            'codigo'        => 'MED4',
            'numero'        => '4',
            'marca'     => 'LAsi',
            'modelo'        => 'abc',
            'sector'        => 'portete',
            'imagen'        => 'sinimg.jpg',
            'latitud'       => '0',
            'longitud'      => '0',
            'estado'        => 'A',
            'persona_id'        => '4',
        ]);
        Medidor::create([
            'codigo'        => 'MED5',
            'numero'        => '5',
            'marca'     => 'LAsi',
            'modelo'        => 'abc',
            'sector'        => 'portete',
            'imagen'        => 'sinimg.jpg',
            'latitud'       => '0',
            'longitud'      => '0',
            'estado'        => 'A',
            'persona_id'        => '5',
        ]);
        Medidor::create([
            'codigo'        => 'MED6',
            'numero'        => '6',
            'marca'     => 'LAsi',
            'modelo'        => 'abc',
            'sector'        => 'portete',
            'imagen'        => 'sinimg.jpg',
            'latitud'       => '0',
            'longitud'      => '0',
            'estado'        => 'A',
            'persona_id'        => '6',
        ]);
        Medidor::create([
            'codigo'        => 'MED7',
            'numero'        => '7',
            'marca'     => 'LAsi',
            'modelo'        => 'abc',
            'sector'        => 'pedregal',
            'imagen'        => 'sinimg.jpg',
            'latitud'       => '0',
            'longitud'      => '0',
            'estado'        => 'A',
            'persona_id'        => '7',
        ]);
        Medidor::create([
            'codigo'        => 'MED8',
            'numero'        => '8',
            'marca'     => 'LAsi',
            'modelo'        => 'abc',
            'sector'        => 'portete',
            'imagen'        => 'sinimg.jpg',
            'latitud'       => '0',
            'longitud'      => '0',
            'estado'        => 'A',
            'persona_id'        => '8',
        ]);
        Medidor::create([
            'codigo'        => 'MED9',
            'numero'        => '9',
            'marca'     => 'LAsi',
            'modelo'        => 'abc',
            'sector'        => 'portete',
            'imagen'        => 'sinimg.jpg',
            'latitud'       => '0',
            'longitud'      => '0',
            'estado'        => 'A',
            'persona_id'        => '9',
        ]);
        Medidor::create([
            'codigo'        => 'MED10',
            'numero'        => '10',
            'marca'     => 'LAsi',
            'modelo'        => 'abc',
            'sector'        => 'portete',
            'imagen'        => 'sinimg.jpg',
            'latitud'       => '0',
            'longitud'      => '0',
            'estado'        => 'A',
            'persona_id'        => '10',
        ]);
    }
}
