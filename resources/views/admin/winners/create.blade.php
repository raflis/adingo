@extends('admin.master')

@section('content')

<div class="layoutContent">
    <div class="container-fluid">
        <div class="row layout-header">
            <div class="col-sm-12 header-content">
                <h1>
                    <i class="fas fa-trophy fa-xs text-white2"></i> Ganador
                </h1>
                <span class="subtitle">
                    Crear, editar y eliminar.
                </span>
            </div>
        </div>
        <div class="row layout-body">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header">
                        <span>
                            Crear ganador
                        </span>
                    </div>
                    {!! Form::open(['route' => 'winners.store']) !!}
                    <div class="card-body row">
                        <div class="col-sm-12">
                            @include('admin.includes.alert')
                        </div>
                        @include('admin.winners.partials.form')
                    </div>
                </div>
            </div>
            <div class="col-sm-12 my-4">
                <span class="d-block mb-3 font-semibold"><code>*</code> Campos Obligatorios</span>
                {!! Form::submit('Guardar cambios',['class'=>'btn btn-success py-2 px-3']) !!}
                <a class="btn btn-danger py-2 px-3" href="{{ route('winners.index') }}">Atrás</a>
                {!! Form::close() !!}
            </div>
        </div>
        @include('admin.includes.footer')
    </div>
</div>

@endsection