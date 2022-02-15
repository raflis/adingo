@extends('admin.layout')

@section('content')
<section class="ganador">
    <img src="{{ asset('images/logo.png') }}" alt="" class="logo">
    <img src="{{ asset('images/adingo.png') }}" alt="" class="adingo0">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="main col-sm-12 col-md-10">
                
                <div class="text">
                    <div class="image">
                        <img class="adingo" src="{{ asset('images/copa.png') }}" alt="">
                    </div>
                    <p>FELICIDADES AL GANADOR</p>
                    <div class="nombre text-center">
                        <span>{{ Auth::user()->name.' '.Auth::user()->lastname }}</span>
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