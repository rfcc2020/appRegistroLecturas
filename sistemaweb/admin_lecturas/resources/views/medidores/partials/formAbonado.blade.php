<div class="form-group">
	{{ Form::hidden('id', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('Cédula', 'Cédula') }}
	{{ Form::text('cedula', null, ['class' => 'form-control']) }}
	{{ Form::submit('Buscar', ['class' => 'btn btn-sm btn-primary']) }}
</div>