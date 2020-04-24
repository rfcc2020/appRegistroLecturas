@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Abonado</div>

                <div class="panel-body">                                        
                    <p><strong>Cédula</strong>      {{ $persona->cedula }}</p>
                    <p><strong>Nombre</strong>      {{ $persona->nombre }}</p>
                    <p><strong>Apellido</strong>    {{ $persona->apellido }}</p>
                    <p><strong>Teléfono</strong>    {{ $persona->telefono }}</p>
                    <p><strong>Email</strong>      {{ $persona->email }}</p>
                    <p><strong>Estado</strong>  {{ $persona->estado }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection