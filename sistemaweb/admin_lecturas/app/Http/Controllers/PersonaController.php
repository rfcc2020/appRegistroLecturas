<?php

namespace App\Http\Controllers;

use App\Persona;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $personas = Persona::paginate();

        return view('personas.index', compact('personas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('personas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //validaciones
        $validator = $request->validate([
        'cedula'=>'required|unique:personas|max:10',
        'nombre'=>'required|max:100',
        'apellido'=>'required|max:100'
        ]);
        
        $personaNueva = new Persona;
        $personaNueva->cedula = $request->cedula;
        $personaNueva->nombre = $request->nombre;
        $personaNueva->apellido = $request->apellido;
        $personaNueva->telefono = $request->telefono;
        $personaNueva->email = $request->email;
        $personaNueva->save();
        return back()->with('info','Datos de abonado agregados correctamente');          
         
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $persona = Persona::find($id);

        return view('personas.show', compact('persona'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $persona = Persona::find($id);

        return view('personas.edit', compact('persona'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //validaciones
        $validator = $request->validate([
        'cedula'=>'required|max:10',
        'nombre'=>'required|max:100',
        'apellido'=>'required|max:100'
        ]);

        $personaUpdate = Persona::findOrFail($id);
        $personaUpdate->cedula = $request->cedula;
        $personaUpdate->nombre = $request->nombre;
        $personaUpdate->apellido = $request->apellido;
        $personaUpdate->telefono = $request->telefono;
        $personaUpdate->email = $request->email;
        $personaUpdate->save();
        return back()->with('info','Datos de abonado actualizados correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Persona::find($id)->delete();

        return back()->with('info', 'Eliminado correctamente');
    }

    public function pdf()
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        $personas = Persona::all(); 

        $pdf = PDF::loadView('personas.pdf.personas', compact('personas'));

        return $pdf->download('listado.pdf');
    }
}
