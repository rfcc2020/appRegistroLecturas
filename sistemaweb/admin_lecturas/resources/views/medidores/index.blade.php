@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Medidores
                    @can('medidores.create')
                    <a href="{{ route('medidores.create') }}" 
                    class="btn btn-sm btn-primary pull-right">
                        Crear
                    </a>
                    @endcan
                </div>

                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="10px">ID</th>
                                <th>Código</th>
                                <th>Numero</th>
                                <th>Abonado</th>
                                <th>Sector</th>
                                <th colspan="3">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($medidores as $medidor)
                            <tr>
                                <td>{{ $medidor->id }}</td>
                                <td>{{ $medidor->codigo }}</td>
                                <td>{{ $medidor->numero }}</td>
                                <td>{{ $medidor->nombre }}  {{ $medidor->apellido }}</td>
                                <td>{{ $medidor->sector }}</td>
                                @can('medidores.show')
                                <td width="10px">
                                    <a href="{{ route('medidores.show', $medidor->id) }}" 
                                    class="btn btn-sm btn-default">
                                        ver
                                    </a>
                                </td>
                                @endcan
                                @can('medidores.edit')
                                <td width="10px">
                                    <a href="{{ route('medidores.edit', $medidor->id) }}" 
                                    class="btn btn-sm btn-default">
                                        editar
                                    </a>
                                </td>
                                @endcan
                                @can('medidores.destroy')
                                <td width="10px">
                                    {!! Form::open(['route' => ['medidores.destroy', $medidor->id], 
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
                    {{ $medidores->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection