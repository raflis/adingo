@extends('admin.layout')

@section('content')
<section class="bingo">
    <img src="{{ asset('images/logo.png') }}" alt="" class="logo">
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
    @livewire('bingo-game')
</section>

@endsection