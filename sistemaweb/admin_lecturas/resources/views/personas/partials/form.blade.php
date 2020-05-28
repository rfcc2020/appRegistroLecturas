<div class="form-group">
	{{ Form::label('Cédula', 'Cédula') }}
	{{ Form::text('cedula', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('Nombre', 'Nombre') }}
	{{ Form::text('nombre', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('Apellido', 'Apellido') }}
	{{ Form::text('apellido', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('Teléfono', 'Teléfono') }}
	{{ Form::text('telefono', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('Email', 'Email') }}
	{{ Form::email('email', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>