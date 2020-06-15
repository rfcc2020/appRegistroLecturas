@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Abonados
                    @can('personas.create')
                    <a href="{{ route('personas.create') }}" 
                    class="btn btn-sm btn-primary pull-right">
                        Crear
                    </a>
                    @endcan                
                    <a href="{{ route('personas.pdf') }}" class="btn btn-sm btn-primary pull-right">
                        Reporte en PDF
                    </a>    
                </div>

                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="10px">ID</th>
                                <th>Cédula</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th colspan="3">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($personas as $persona)
                            <tr>
                                <td>{{ $persona->id }}</td>
                                <td>{{ $persona->cedula }}</td>
                                <td>{{ $persona->nombre }}</td>
                                <td>{{ $persona->apellido }}</td>
                                @can('personas.show')
                                <td width="10px">
                                    <a href="{{ route('personas.show', $persona->id) }}" 
                                    class="btn btn-sm btn-default">
                                        ver
                                    </a>
                                </td>
                                @endcan
                                @can('personas.edit')
                                <td width="10px">
                                    <a href="{{ route('personas.edit', $persona->id) }}" 
                                    class="btn btn-sm btn-default">
                                        editar
                                    </a>
                                </td>
                                @endcan
                                @can('personas.destroy')
                                <td width="10px">
                                    {!! Form::open(['route' => ['personas.destroy', $persona->id], 
                                    'method' => 'DELETE']) !!}
                                        <button class="btn btn-sm btn-danger">
                                            Eliminar
                                        </button>
                                    {!! Form::close() !!}
                                </td>
                                @endcan
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $personas->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection