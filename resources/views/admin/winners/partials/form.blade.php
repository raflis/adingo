<div class="form-group col-sm-12">
    {{ Form::label('bingo_id', 'Nombre de la sala:') }} <code>*</code>
    {{ Form::select('bingo_id', $bingos, null, ['class' => 'form-control']) }}
</div>

<div class="form-group col-sm-12">
    {{ Form::label('user_id', 'Nombre del usuario:') }} <code>*</code>
    {{ Form::select('user_id', $users, null, ['class' => 'form-control']) }}
</div>

@section('script')

@endsection