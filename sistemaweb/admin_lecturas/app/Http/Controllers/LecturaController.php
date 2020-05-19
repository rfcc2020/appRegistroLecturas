<?php

namespace App\Http\Controllers;

use App\Lectura;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class LecturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lecturas = Lectura::
            Join('medidors', 'medidors.id', '=', 'lecturas.medidor_id')
            ->Join('personas', 'personas.id', '=', 'medidors.persona_id')
            ->select('lecturas.*' ,'personas.nombre','personas.apellido','medidors.sector','medidors.codigo')
            ->paginate();
        //return $medidores;
        return view('lecturas.index', compact('lecturas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lectura  $lectura
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $lectura = Lectura::find($id);
        return view('lecturas.show', compact('lectura'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lectura  $lectura
     * @return \Illuminate\Http\Response
     */
    public function edit(Lectura $lectura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lectura  $lectura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lectura $lectura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lectura  $lectura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lectura $lectura)
    {
        //
    }
    public function pdf()
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        $lecturas = Lectura::
            Join('medidors', 'medidors.id', '=', 'lecturas.medidor_id')
            ->Join('personas', 'personas.id', '=', 'medidors.persona_id')
            ->select('lecturas.*' ,'personas.nombre','personas.apellido','medidors.sector','medidors.codigo')->get();
        $pdf = PDF::loadView('lecturas.pdf.lecturas', compact('lecturas'));

        return $pdf->download('listado.pdf');
    }
}
