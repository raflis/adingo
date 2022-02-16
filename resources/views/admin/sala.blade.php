@extends('admin.layout')

@section('content')
<section class="login">
    <img src="{{ asset('images/logo.png') }}" alt="" class="logo">
    <div class="logout">
        <a href="{{ route('login.logout') }}" data-toggle="tooltip" data-placement="bottom" title="Cerrar sesión">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </div>
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
                    
                    @livewire('bingo-sala')

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