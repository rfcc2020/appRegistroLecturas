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
        ]);

		Persona::create([
            'cedula'        => '0300050697',
            'Nombre'        => 'Roberto',
            'Apellido'   	=> 'Andrade',
            'telefono'		=> '0981828905',
            'email'		=> 'rmandrade@gmail.com',
        ]);

        Persona::create([
            'cedula'        => '0104718218',
            'Nombre'        => 'Elisabeth',
            'Apellido'   	=> 'Arévalo',
            'telefono'		=> '0981828905',
            'email'		=> 'ekarevalo@gmail.com',
        ]);

        Persona::create([
            'cedula'        => '0101695914',
            'Nombre'        => 'Astudillo',
            'Apellido'   	=> 'Teodoro',
            'telefono'		=> '7000569',
            'email'		=> 'tastudillo@gmail.com',
        ]);

        Persona::create([
            'cedula'        => '0100998343',
            'Nombre'        => 'María Alegría',
            'Apellido'   	=> 'Banegas',
            'telefono'		=> '7000112',
            'email'		=> 'mabanegas@gmail.com',
        ]);

        Persona::create([
            'cedula'        => '0100939743',
            'Nombre'        => 'Ruben',
            'Apellido'   	=> 'Banegas',
            'telefono'		=> '7000113',
            'email'		=> 'rbanegas@gmail.com',
        ]);

		Persona::create([
            'cedula'        => '0101900199',
            'Nombre'        => 'Luis Edison',
            'Apellido'   	=> 'Cabrera Pesantez',
            'telefono'		=> '7000114',
            'email'		=> 'lecabrera@gmail.com',
        ]);

        Persona::create([
            'cedula'        => '1400555296',
            'Nombre'        => 'Edison Ramiro',
            'Apellido'   	=> 'Calle Andrade',
            'telefono'		=> '7000115',
            'email'		=> 'ercalle@gmail.com',
        ]);

        Persona::create([
            'cedula'        => '0100138726',
            'Nombre'        => 'RAFAEL GAVINO',
            'Apellido'      => 'CARPIO ESPINOZA',
            'telefono'      => '7000116',
            'email'     => 'gbcambisaca@gmail.com',
        ]);

        Persona::create([
            'cedula'        => '0102875796',
            'Nombre'        => 'RAUL',
            'Apellido'      => 'CEDILLO PALTA',
            'telefono'      => '7000116',
            'email'     => 'gbcambisaca@gmail.com',
        ]);

        Persona::create([
            'cedula'        => '0301686226',
            'Nombre'        => 'DANIEL SALVADOR',
            'Apellido'      => 'CORAIZACA NAULA',
            'telefono'      => '7000116',
            'email'     => 'gbcambisaca@gmail.com',
        ]);

        Persona::create([
            'cedula'        => '0104012059',
            'Nombre'        => 'LUIS FEDERICO',
            'Apellido'      => 'CULLQUICONDOR LAIME',
            'telefono'      => '7000116',
            'email'     => 'lcullqui@gmail.com',
        ]);

        Persona::create([
            'cedula'        => '0301781316',
            'Nombre'        => 'JORGE LEONARDO',
            'Apellido'      => 'CULLQUICONDOR SUMBA',
            'telefono'      => '7000116',
            'email'     => 'jcullqui@gmail.com',
        ]);

        Persona::create([
            'cedula'        => '0301332557',
            'Nombre'        => 'SEGUNDO MANUEL',
            'Apellido'      => 'CULLQUICONDOR SUMBA',
            'telefono'      => '7000116',
            'email'     => 'scullqui@gmail.com',
        ]);

        Persona::create([
            'cedula'        => '0103553186',
            'Nombre'        => 'GALO FABIAN',
            'Apellido'      => 'CUZCO COYAGO',
            'telefono'      => '7000116',
            'email'     => 'gcuzcocoyago@gmail.com',
        ]);

        Persona::create([
            'cedula'        => '0301282372',
            'Nombre'        => 'DIEGO LEONARDO',
            'Apellido'      => 'CUZCO CUZCO',
            'telefono'      => '7000116',
            'email'     => 'dcuzcoc@gmail.com',
        ]);

        Persona::create([
            'cedula'        => '0301261863',
            'Nombre'        => 'DORA ERMELINDA',
            'Apellido'      => 'CUZCO CUZCO',
            'telefono'      => '7000116',
            'email'     => 'dcuzcoc@gmail.com',
        ]);

        Persona::create([
            'cedula'        => '0301386330',
            'Nombre'        => 'JORGE ROLANDO',
            'Apellido'      => 'CUZCO CUZCO',
            'telefono'      => '7000116',
            'email'     => 'jcuzcoc@gmail.com',
        ]);

        Persona::create([
            'cedula'        => '0301423208',
            'Nombre'        => 'JOSÉ RAFAEL',
            'Apellido'      => 'CUZCO CUZCO',
            'telefono'      => '7000116',
            'email'     => 'jcuzcoc@gmail.com',
        ]);

        Persona::create([
            'cedula'        => '0301166815',
            'Nombre'        => 'LUIS GUSTAVO',
            'Apellido'      => 'CUZCO CUZCO',
            'telefono'      => '7000116',
            'email'     => 'lcuzcoc@gmail.com',
        ]);

    }
}
