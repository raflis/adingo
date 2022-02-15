<div class="form-group col-sm-12">
    {{ Form::label('name', 'Nombre:') }} <code>*</code>
    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese nombre']) }}
</div>

<div class="form-group col-sm-12">
  {{ Form::label('lastname', 'Apellido:') }} <code>*</code>
  {{ Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Ingrese apellido']) }}
</div>

<div class="form-group col-sm-12">
  {{ Form::label('email', 'Email:') }} <code>*</code>
  {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Ingrese email']) }}
</div>

<div class="form-group col-sm-12">
  {{ Form::label('company', 'Empresa:') }} <code>*</code>
  {{ Form::text('company', null, ['class' => 'form-control', 'placeholder' => 'Ingrese empresa']) }}
</div>