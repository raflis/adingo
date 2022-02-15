@extends('admin.layout')

@section('content')
<section class="bingo">
    <img src="{{ asset('images/logo.png') }}" alt="" class="logo">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
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
                            <div class="number end_right" id="{{ $i }}">
                                <span>{{ $i }}</span>
                            </div>
                            @else
                            <div class="number" id="{{ $i }}">
                                <span>{{ $i }}</span>
                            </div>
                            @endif
                        @endfor
                        @for ($i = 46; $i <= 60; $i++)
                            @if ($i == 60)
                            <div class="number end_right last_row" id="{{ $i }}">
                                <span>{{ $i }}</span>
                            </div>
                            @else
                            <div class="number last_row" id="{{ $i }}">
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
                    <div class="image">
                        <img src="{{ asset('images/adingo_card0.png') }}" alt="">
                    </div>
                    <div class="numbers">
                        @foreach ($numeros as $num)
                            @if($loop->index == 4 || $loop->index == 9 || $loop->index == 14 || $loop->index == 19)
                            <div class="number end_right">
                                <span>{{ $num }}</span>
                            </div>
                            @elseif($loop->index == 12)
                            <div class="number">
                                <span><img class="a" src="{{ asset('images/a.png') }}" alt=""></span>
                            </div>
                            @elseif($loop->index == 24)
                            <div class="number last_row end_right">
                                <span>{{ $num }}</span>
                            </div>
                            @elseif($loop->index >= 20)
                            <div class="number last_row">
                                <span>{{ $num }}</span>
                            </div>
                            @else
                            <div class="number">
                                <span>{{ $num }}</span>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4 number_random_">
                <div class="number_random glow0">
                    <span class="num_obtain">
                        ?
                    </span>
                </div>
                <p class="balota">
                    BALOTA NO.1
                </p>
                <div class="premio">
                    <img src="{{ asset('images/premio.png') }}" alt="">
                    <div class="nombre text-center" id="nuevo_numero">
                        <span class="n_numero">Nuevo número</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 adingo_button_">
                <div class="adingo_button glow0">
                    <img src="{{ asset('images/adingo3.png') }}" alt="">
                </div>
                <div class="adingo_button_bottom">
                    <img src="{{ asset('images/arrow-top.png') }}" alt="">
                    <p>
                        Presione el botón cuando complete su tarjetón
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')

<script>
    $(function(){
        $('#nuevo_numero').on('click', function(e){
            $.ajax({
                type: "POST",
                url: '{{ route('aleatorio') }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                dataType: 'json',
                success: function success(response) {
                    console.log(response);
                    if(response){
                        $('#'+ response).addClass('active');
                        $('.num_obtain').html(response);
                        $('.n_numero').html('Nuevo número');
                    }
                },
                beforeSend: function beforeSend() {
                    //$('.btn-submit').attr('disabled', true);
                    $('.n_numero').html('Generando ...');
                },
                cache: false,
                contentType: false,
                processData: false,
                error: function error(_error3, e) {
                    console.log(_error3);
                    console.log(e);
                }
            });
            return false;
        })
    })
</script>

@endsection