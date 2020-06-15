<div class="form-group">
	{{ Form::label('Fecha', 'Fecha') }}
	{{ Form::date('fecha', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('Detalle', 'Detalle') }}
	{{ Form::text('detalle', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('Observacion', 'Observacion') }}
	{{ Form::text('observacion', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('Imagen', 'Imagen') }}
	{{ Form::file('imagen', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('idmedidor', 'Id de medidor') }}
	{{ Form::text('medidor_id', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('Estado', 'Estado') }}
	{{ Form::checkbox('estado', 'A', true, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>