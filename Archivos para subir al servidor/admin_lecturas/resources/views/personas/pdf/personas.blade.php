@extends('layouts.app')

@section('content')
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Apellido</th>
            </tr>                            
        </thead>
        <tbody>
            @foreach($personas as $persona)
            <tr>
                <td>{{ $persona->id }}</td>
                <td>{{ $persona->cedula }}</td>
                <td>{{ $persona->nombre }}</td>
                <td>{{ $persona->apellido }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection