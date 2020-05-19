<?php

use Illuminate\Database\Seeder;
use App\Persona;

class PersonaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Persona::create([
            'cedula'        => '0301633285',
            'Nombre'        => 'Robinson',
            'Apellido'   	=> 'Cuzco',
            'telefono'		=> '2850544',
            'email'		=> 'ingrcuzco@gmail.com',
            'estado'		=> 'A',
        ]);

		Persona::create([
            'cedula'        => '0300050697',
            'Nombre'        => 'Roberto',
            'Apellido'   	=> 'Andrade',
            'telefono'		=> '0981828905',
            'email'		=> 'rmandrade@gmail.com',
            'estado'		=> 'A',
        ]);

        Persona::create([
            'cedula'        => '0104718218',
            'Nombre'        => 'Elisabeth',
            'Apellido'   	=> 'Arévalo',
            'telefono'		=> '0981828905',
            'email'		=> 'ekarevalo@gmail.com',
            'estado'		=> 'A',
        ]);

        Persona::create([
            'cedula'        => '0101695914',
            'Nombre'        => 'Astudillo',
            'Apellido'   	=> 'Teodoro',
            'telefono'		=> '7000569',
            'email'		=> 'tastudillo@gmail.com',
            'estado'		=> 'A',
        ]);

        Persona::create([
            'cedula'        => '0100998343',
            'Nombre'        => 'María Alegría',
            'Apellido'   	=> 'Banegas',
            'telefono'		=> '7000112',
            'email'		=> 'mabanegas@gmail.com',
            'estado'		=> 'A',
        ]);

        Persona::create([
            'cedula'        => '0100939743',
            'Nombre'        => 'Ruben',
            'Apellido'   	=> 'Banegas',
            'telefono'		=> '7000113',
            'email'		=> 'rbanegas@gmail.com',
            'estado'		=> 'A',
        ]);

		Persona::create([
            'cedula'        => '0101900199',
            'Nombre'        => 'Luis Edison',
            'Apellido'   	=> 'Cabrera Pesantez',
            'telefono'		=> '7000114',
            'email'		=> 'lecabrera@gmail.com',
            'estado'		=> 'A',
        ]);

        Persona::create([
            'cedula'        => '1400555296',
            'Nombre'        => 'Edison Ramiro',
            'Apellido'   	=> 'Calle Andrade',
            'telefono'		=> '7000115',
            'email'		=> 'ercalle@gmail.com',
            'estado'		=> 'A',
        ]);

        Persona::create([
            'cedula'        => '0100138726',
            'Nombre'        => 'RAFAEL GAVINO',
            'Apellido'      => 'CARPIO ESPINOZA',
            'telefono'      => '7000116',
            'email'     => 'gbcambisaca@gmail.com',
            'estado'        => 'A',
        ]);

        Persona::create([
            'cedula'        => '0100138726',
            'Nombre'        => 'RAUL',
            'Apellido'      => 'CEDILLO PALTA',
            'telefono'      => '7000116',
            'email'     => 'gbcambisaca@gmail.com',
            'estado'        => 'A',
        ]);

        Persona::create([
            'cedula'        => '0301686226',
            'Nombre'        => 'DANIEL SALVADOR',
            'Apellido'      => 'CORAIZACA NAULA',
            'telefono'      => '7000116',
            'email'     => 'gbcambisaca@gmail.com',
            'estado'        => 'A',
        ]);

    }
}
