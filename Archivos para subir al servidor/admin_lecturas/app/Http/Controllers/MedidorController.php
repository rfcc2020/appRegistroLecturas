<?php

namespace App\Http\Controllers;

use App\Medidor;
use App\Persona;
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
        //validaciones
         $request->validate([
            'codigo'=>'required|unique:medidors|max:10',
            'numero'=>'required|unique:medidors|max:3',
            'sector'=>'required|max:20'
        ]);
        $medidorNuevo = new Medidor;

        //manejo de imágenes
        if($request->hasFile('imagen'))
        {
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
        $abonado = Persona::find($medidor->persona_id);
        return view('medidores.show', compact('medidor','abonado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medidor  $medidor
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        
        $medidor = Medidor::find($id);
        if(strlen($request->cedula) == 0)
        {
            $abonado = Persona::find($medidor->persona_id);
        }
        else
        {
            $personas = Persona::where('cedula','=',$request->cedula)->get();
            if(count($personas)>0)
            $abonado = $personas[0];
        else
            $abonado=null;
        }
        if($abonado != null)
            $medidor->persona_id=$abonado->id;
        //return $abonado;
        return view('medidores.edit', compact('medidor','abonado'));
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
        //validaciones
         $request->validate([
            'codigo'=>'required|max:10',
            'numero'=>'required|max:3',
            'sector'=>'required|max:20'
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
}
