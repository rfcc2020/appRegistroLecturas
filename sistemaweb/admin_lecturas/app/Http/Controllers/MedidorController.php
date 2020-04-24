<?php

namespace App\Http\Controllers;

use App\Medidor;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MedidorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$medidores = Medidor::paginate();

        //return view('medidores.index', compact('medidores'));
        $medidores = Medidor::
            LeftJoin('personas', 'personas.id', '=', 'medidors.persona_id')
            ->select('medidors.*' ,'personas.nombre','personas.apellido')
            ->paginate();
        //return $medidores;
        return view('medidores.index', compact('medidores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('medidores.create');
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
        $name=$request->imagen;
         $request->validate([
            'codigo'=>'required',
            'numero'=>'required',
            'sector'=>'required'
        ]);
        $medidorNuevo = new Medidor;
        if($request->hasFile('imagen'))
        {
           //$path = $request->imagen->store('public');
            $file = $request->file('imagen');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images',$name);
            $medidorNuevo->imagen = $name;
        }
        $medidorNuevo->codigo = $request->codigo;
        $medidorNuevo->numero = $request->numero;
        $medidorNuevo->sector = $request->sector;
        $medidorNuevo->marca = $request->marca;
        $medidorNuevo->modelo = $request->modelo;
        $medidorNuevo->persona_id = $request->persona_id;
        $medidorNuevo->estado = $request->estado;
        $medidorNuevo->latitud = $request->latitud;
        $medidorNuevo->longitud = $request->longitud;
        $medidorNuevo->save();
        return back()->with('info','Medidor agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medidor  $medidor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $medidor = Medidor::find($id);
        //return $medidor;
        return view('medidores.show', compact('medidor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medidor  $medidor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $medidor = Medidor::find($id);

        return view('medidores.edit', compact('medidor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medidor  $medidor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'codigo'=>'required',
            'numero'=>'required',
            'sector'=>'required'
        ]);
        $medidorUpdate = Medidor::findOrFail($id);
        if($request->hasFile('imagen'))
        {
           //$path = $request->imagen->store('public');
            $file = $request->file('imagen');
            $original = $file->getClientOriginalName();
            if($original != $medidorUpdate->imagen)
            {
                $name = time().$file->getClientOriginalName();
                $file->move(public_path().'/images',$name);
                $medidorUpdate->imagen = $name;
            }
            
        }        
        $medidorUpdate->codigo = $request->codigo;
        $medidorUpdate->numero = $request->numero;      
        $medidorUpdate->sector = $request->sector;   
        $medidorUpdate->marca = $request->marca;
        $medidorUpdate->modelo = $request->modelo;
        $medidorUpdate->persona_id = $request->persona_id;
        $medidorUpdate->estado = $request->estado;
        $medidorUpdate->latitud = $request->latitud;
        $medidorUpdate->longitud = $request->longitud;
        $medidorUpdate->save();
        return back()->with('info','Medidor actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medidor  $medidor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $medidor = Medidor::find($id)->delete();

        return back()->with('info', 'Eliminado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medidor  $medidor
     * @return \Illuminate\Http\Response
     */
    public function Asign($id)
    {
        //
        $medidores = Medidor::paginate();
// Medidor::where('estado', 1);
        $persona_id = $id;
        return view('medidores.asign', compact('medidores'),compact('persona_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medidor  $medidor
     * @return \Illuminate\Http\Response
     */
    public function asignar($id, $idp)
    {
        //
        $medidorUpdate = Medidor::findOrFail($id);
        $medidorUpdate->persona_id = $idp;
        $medidorUpdate->estado = 0;
        $medidorUpdate->save();
        return back()->with('info','Medidor Asignado');
    }

}
