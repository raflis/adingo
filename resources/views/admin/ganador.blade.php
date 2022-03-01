@extends('admin.layout')

@section('content')
<section class="ganador">
    <img src="{{ asset('images/logo.png') }}" alt="" class="logo">
    <img src="{{ asset('images/adingo.png') }}" alt="" class="adingo0">
    <div class="regresar-sala">
        <a href="{{ route('sala') }}" data-toggle="tooltip" data-placement="bottom" title="Regresar a la sala">
            <i class="fas fa-arrow-alt-circle-left"></i>
        </a>
    </div>
    <div class="logout">
        <a href="{{ route('login.logout') }}" data-toggle="tooltip" data-placement="bottom" title="Cerrar sesión">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="main col-sm-12 col-md-10">
                
                <div class="text">
                    <div class="image">
                        <img class="adingo" src="{{ asset('images/copa.png') }}" alt="">
                    </div>
                    <p>
                        FELICIDADES, GANASTE EL ADINGO <br>
                        <span>"{{ $winner->bingo->name }}"</span>
                    </p>
                    <div class="nombre text-center">
                        <span>{{ $winner->user->name.' '.$winner->user->lastname }}</span>
                    </div>
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