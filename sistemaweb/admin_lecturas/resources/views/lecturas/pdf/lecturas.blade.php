@extends('layouts.app')

@section('content')
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Detalle</th>
                <th>Observación</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Sector</th>
                <th>Codigo</th>
            </tr>                            
        </thead>
        <tbody>
            @foreach($requerimientos as $requerimiento)
            <tr>
                <td>{{ $requerimiento->id }}</td>
                <td>{{ $requerimiento->fecha }}</td>
                <td>{{ $requerimiento->detalle }}</td>
                <td>{{ $requerimiento->observacion }}</td>
                <td>{{ $requerimiento->nombre }}</td>
                <td>{{ $requerimiento->apellido }}</td>
                <td>{{ $requerimiento->sector }}</td>
                <td>{{ $requerimiento->codigo }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection