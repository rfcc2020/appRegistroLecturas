<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use App\User;
use App\sector;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate();

        return view('users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $sectores = explode(",", $user->sector);

        return view('users.show', compact('user','sectores'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::get();
        $sectores_usr = explode(",", $user->sector);
        $sectores = ['Portete','Pedregal','La Unión','Rayoloma'];

        return view('users.edit', compact('user', 'roles','sectores','sectores_usr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validaciones
        $validator = $request->validate([
        'name'=>'required|max:50',
        'email'=>'required|max:100',
        ]);

        $sectores = $request->get('sectores');
        $sectores_asig = '';
        if($sectores != null)
        foreach ($sectores as $sector) {
            $sectores_asig=$sectores_asig.$sector.',';
        }
        $user = User::find($id);
        $userUpdate = User::findOrFail($id);

        $userUpdate->name = $request->name;
        $userUpdate->email = $request->email;
        $userUpdate->sector = $sectores_asig;
        $userUpdate->save();
        $user->update($request->all());

        $user->roles()->sync($request->get('roles'));
        return redirect()->route('users.edit', $user->id)->with('info', 'Usuario guardado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return back()->with('info', 'Eliminado correctamente');
    }
}
