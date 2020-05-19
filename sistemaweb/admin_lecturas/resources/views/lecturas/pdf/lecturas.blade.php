@extends('layouts.app')

@section('content')
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Anterior</th>
                <th>Actual</th>
                <th>Consumo</th>
                <th>Básico</th>
                <th>Exceso</th>
            </tr>                            
        </thead>
        <tbody>
            @foreach($lecturas as $lectura)
            <tr>              
            <td>{{ $lectura->id }}</td>
            <td>{{ $lectura->fecha }}</td>
            <td>{{ $lectura->nombre }} {{ $lectura->apellido }}</td>
            <td>{{ $lectura->anterior }}</td>
            <td>{{ $lectura->actual }}</td>
            <td>{{ $lectura->consumo }}</td>
            <td>{{ $lectura->basico }}</td>
            <td>{{ $lectura->exceso }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection