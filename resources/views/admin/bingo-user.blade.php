@extends('admin.layout')

@section('content')
<section class="bingo">
    <img src="{{ asset('images/logo.png') }}" alt="" class="logo">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12 text-center">
                <span class="titulo_bingo">
                    {{ $bingo->name }}
                </span>
            </div>
            <div class="col-md-4 text-center pt-5">
                <img class="adingo11" src="{{ asset('images/adingo.png') }}" alt="">
            </div>
            <div class="col-md-8">
                <div class="tit">
                    <img src="{{ asset('images/instructivo.png') }}" alt="">
                </div>
                <div class="content">
                    <img class="adobe-v" src="{{ asset('images/adobe-v.png') }}" alt="">
                    <img class="line1" src="{{ asset('images/line1.png') }}" alt="">
                    <div class="numbers">
                        @for ($i = 1; $i <= 45; $i++)
                            @if ($i == 15 || $i == 30 || $i == 45)
                            <div class="number end_right @if(in_array($i, $bingolog)) active @endif" id="{{ $i }}">
                                <span>{{ $i }}</span>
                            </div>
                            @else
                            <div class="number @if(in_array($i, $bingolog)) active @endif" id="{{ $i }}">
                                <span>{{ $i }}</span>
                            </div>
                            @endif
                        @endfor
                        @for ($i = 46; $i <= 60; $i++)
                            @if ($i == 60)
                            <div class="number end_right last_row @if(in_array($i, $bingolog)) active @endif" id="{{ $i }}">
                                <span>{{ $i }}</span>
                            </div>
                            @else
                            <div class="number last_row @if(in_array($i, $bingolog)) active @endif" id="{{ $i }}">
                                <span>{{ $i }}</span>
                            </div>
                            @endif
                        @endfor
                    </div>
                </div>
                <p>
                    *Nota: Las balotas resaltadas son las que ya han salido.
                </p>
            </div>
            <div class="col-md-4 d-flex justify-content-end">
                <div class="cartilla">
                    <div class="numbers">
                        <div class="number number_tit">
                            <span>A</span>
                        </div>
                        <div class="number number_tit">
                            <span>D</span>
                        </div>
                        <div class="number number_tit">
                            <span>O</span>
                        </div>
                        <div class="number number_tit">
                            <span>B</span>
                        </div>
                        <div class="number number_tit end_right">
                            <span>E</span>
                        </div>
                        @foreach ($numeros as $num)
                            @if($loop->index == 4 || $loop->index == 9 || $loop->index == 14 || $loop->index == 19)
                            <div class="number end_right @if(in_array($num, $bingolog)) active @endif">
                                <span>{{ $num }}</span>
                            </div>
                            @elseif($loop->index == 12)
                            <div class="number">
                                <span><img class="a" src="{{ asset('images/a.png') }}" alt=""></span>
                            </div>
                            @elseif($loop->index == 24)
                            <div class="number last_row end_right @if(in_array($num, $bingolog)) active @endif">
                                <span>{{ $num }}</span>
                            </div>
                            @elseif($loop->index >= 20)
                            <div class="number last_row @if(in_array($num, $bingolog)) active @endif">
                                <span>{{ $num }}</span>
                            </div>
                            @else
                            <div class="number @if(in_array($num, $bingolog)) active @endif">
                                <span>{{ $num }}</span>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4 ganador_user_">
                @if (Session::has('message'))
                <div class="alert alert-{{ Session::get('typealert') }} alert-dismissible fade show mb-4" role="alert">
                    {{ Session::get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    @if ($errors->any())
                        <ul class="mt-1 mb-0 pl-3">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                @endif
                <div class="ganador_user">
                    <p>
                        El usuario <span>{{ $user->name }} {{ $user->lastname }}</span>
                    </p>
                    <div class="text-center">
                        <button class="btn-ganador glowred" iduser="{{ $user->id }}" idbingo="{{ $bingo->id }}">¿Es el ganador?</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="ganador_user" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body text-center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <i class="fas fa-trophy fa-5x text-warning mb-3"></i>
            <p class="mb-0 font-bold first">¿Estás seguro?</p>
            <p class="mb-0 font-light second">Se registrará al usuario como <strong>ganador</strong> del juego.</p>
        </div>
        <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            {!! Form::open(['route' => 'ganador']) !!}
            {{ Form::hidden('bingo_id', $bingo->id) }}
            {{ Form::hidden('user_id', $user->id) }}
                <button class="btn btn-success">
                    Sí, registrar
                </button>                           
            {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>

@endsection

@section('script')

<script>
    $('document').ready(function(){
        $('.btn-ganador').click(function(e){
            e.preventDefault();
            $('#ganador_user').modal('show');
        });
    })
</script>

@endsection