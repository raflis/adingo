@extends('admin.layout')

@section('content')
<section class="login">
    <img src="{{ asset('images/logo.png') }}" alt="" class="logo">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="main col-sm-12 col-md-5">
                
                <div class="formu">
                    <div class="image">
                        <img class="adingo" src="{{ asset('images/adingo.png') }}" alt="">
                    </div>
                    <div class="alert_msg">
                        @include('admin.includes.alert')
                    </div>
                    {!! Form::open(['route' => 'login.post', 'autocomplete' => 'off']) !!}

                    <div class="form-group">
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Nombres']) }}
                    </div>
                    
                    <div class="form-group">
                        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder'=>'Ingresa un email']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::text('company', null, ['class' => 'form-control', 'placeholder'=>'Empresa']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::password('password', ['class' => 'form-control', 'placeholder'=>'Ingresa un contraseña']) }}
                    </div>

                    {!! Form::submit('Iniciar sesión',['class'=>'btn btn-primary btn-login mt-2 col-12 py-2']) !!}

                    {!! Form::close() !!}
                </div>
                <div class="terminos">
                    <img src="{{ asset('images/lapiz.png') }}" alt="">
                    <p class="terminos">
                        *Aplican términos y condiciones
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection