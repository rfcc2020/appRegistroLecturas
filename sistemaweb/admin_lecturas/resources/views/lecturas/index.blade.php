@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    lecturas
                                  
                    <a href="{{ route('lecturas.pdf') }}" class="btn btn-sm btn-primary pull-right">
                        Reporte en PDF
                    </a>    
                </div>

                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="10px">ID</th>
                                <th>Fecha</th>
                                <th>Nombre</th>
                                <th>Anterior</th>
                                <th>Actual</th>
                                <th>Consumo</th>
                                <th>Básico</th>
                                <th>Exceso</th>
                                <th colspan="3">&nbsp;</th>
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
                                @can('lecturas.show')
                                <td width="10px">
                                    <a href="{{ route('lecturas.show', $lectura->id) }}" 
                                    class="btn btn-sm btn-default">
                                        ver
                                    </a>
                                </td>
                                @endcan
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $lecturas->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection