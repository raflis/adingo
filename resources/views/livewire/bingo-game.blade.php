<div>

    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12 text-center titulo_bingo_">
                <span class="titulo_bingo">
                    {{ $nombre_bingo }}
                </span>
            </div>
            <div class="col-md-4 text-center">
                <img class="adingo11" src="{{ asset('images/adingo.png') }}" alt="">
            </div>
            <div class="col-md-8">
                <div class="tit">
                    <img src="{{ asset('images/instructivo.png') }}" alt="">
                </div>
                <div class="content">
                    <div class="name">
                        <div class="number_name">
                            <span>A</span>
                        </div>
                        <div class="number_name">
                            <span>D</span>
                        </div>
                        <div class="number_name">
                            <span>O</span>
                        </div>
                        <div class="number_name">
                            <span>B</span>
                        </div>
                        <div class="number_name">
                            <span>E</span>
                        </div>
                    </div>
                    <img class="line1" src="{{ asset('images/line1.png') }}" alt="">
                    <div class="numbers">
                        @for ($i = 1; $i <= 60; $i++)
                            @if ($i == 15 || $i == 30 || $i == 45 || $i == 60)
                            <div class="number end_right @if(in_array($i, $bingolog)) active @endif" id="{{ $i }}">
                                <span>{{ $i }}</span>
                            </div>
                            @else
                            <div class="number @if(in_array($i, $bingolog)) active @endif" id="{{ $i }}">
                                <span>{{ $i }}</span>
                            </div>
                            @endif
                        @endfor
                        @for ($i = 61; $i <= 75; $i++)
                            @if ($i == 75)
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
                    *Nota: Las bolas resaltadas son las que ya han salido.
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
                    </div>
                    <div class="numbers_v">
                        @foreach ($numeros as $num)
                        @if($loop->index == 20 || $loop->index == 21 || $loop->index == 22 || $loop->index == 23)
                        <div class="number_v end_right @if(in_array($num, $numberClicked)) active @endif" wire:click="SetClicked({{ $num }})">
                            <span>{{ $num }}</span>
                        </div>
                        @elseif($loop->index == 12)
                        <div class="number_v">
                            <span><img class="a" src="{{ asset('images/a.png') }}" alt=""></span>
                        </div>
                        @elseif($loop->index == 24)
                        <div class="number_v last_row end_right @if(in_array($num, $numberClicked)) active @endif" wire:click="SetClicked({{ $num }})">
                            <span>{{ $num }}</span>
                        </div>
                        @elseif($loop->index == 4 || $loop->index == 9 || $loop->index == 14 || $loop->index == 19)
                        <div class="number_v last_row @if(in_array($num, $numberClicked)) active @endif" wire:click="SetClicked({{ $num }})">
                            <span>{{ $num }}</span>
                        </div>
                        @else
                        <div class="number_v @if(in_array($num, $numberClicked)) active @endif" wire:click="SetClicked({{ $num }})">
                            <span>{{ $num }}</span>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4 number_random_">
                @if($nombre_ganador != "")
                <div class="alert alert-warning alert-dismissible fade show mb-4" id="posibleGanadorNotificador" role="alert">
                    <p class="tit"><strong>Posible Ganador</strong></p>
                    <p class="name">{{ $nombre_ganador }}</p>
                    @if(Auth::user()->role == 0)
                    <a class="badge badge-dark" href="{{ route('bingo.user', [$id_nombre_ganador, $id_bingo_unico]) }}" target="_blank">Ver cartilla</a>
                    @endif
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="number_random glow0_blue">
                    <span class="num_obtain">
                        {{ $numero_obtenido }}
                    </span>
                </div>
                <p class="balota">
                    BOLA N°
                </p>
                @if(Auth::user()->role == 0)
                <div class="premio">
                    <div class="nombre text-center" id="nuevo_numero">
                        <button class="n_numero" 
                        wire:click="generarNumero"
                        wire:loading.attr="hidden"
                        wire:offline.attr="disabled"
                        >
                            Nuevo número
                        </button>
                    </div>
                    <div class="nombre text-center generando" disabled wire:loading wire:target="generarNumero">
                        <button class="n_numero">
                            Generando ...
                        </button>
                    </div>
                    <div class="nombre text-center">
                        <button class="mostrar_ganador" wire:click="enviarGanador" wire:loading.attr="disabled" wire:offline.attr="disabled">
                            Mostrar ganador
                        </button>
                    </div>
                    
                </div>
                @endif
            </div>
            @if($ganador_final == "")
            <div class="col-md-4 adingo_button_">
                <div class="adingo_button glow0" 
                wire:click="enviarMiNombre('{{ Auth::user()->name.' '.Auth::user()->lastname }}', {{ Auth::user()->id }}, {{ $id_bingo }})"
                wire:loading.attr="disabled"
                wire:offline.attr="disabled"
                >
                    <img src="{{ asset('images/adingo3.png') }}" alt="">
                </div>
                <div class="adingo_button_bottom">
                    <img src="{{ asset('images/arrow-top.png') }}" alt="">
                    <p>
                        Presione el botón cuando complete su tarjetón
                    </p>
                </div>
            </div>
            @else
            <div class="col-md-4 ganador_user_">
                <div class="ganador_user">
                    <p>
                        El ganador es el usuario <span>{{ $ganador_final}}</span>
                    </p>
                </div>
            </div>
            @endif
        </div>
    </div>

    <script>
        window.livewire.on('aleatorioxx', (num_aleatorio_new) => {
            //$('.num_obtain').html(num_aleatorio_new);
        });
    </script>

    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('f1297f7c3d20bb442ecc', {
            cluster: 'us2'
        });

        var channel0 = pusher.subscribe('bingo-channel');
        channel0.bind('bingo-event', function(data_) {
            var datax = JSON.stringify(data_);
            window.livewire.emit('enviarAleatorio', data_);
            //console.log(datax);
            $('.num_obtain').html(datax['numero']);
        });

        var channel1 = pusher.subscribe('name-channel');
        channel1.bind('name-event', function(data_name) {
            window.livewire.emit('enviarNombre', data_name);
            console.log(data_name);
        });

        var channel2 = pusher.subscribe('winner-channel');
        channel2.bind('winner-event', function(data_winner) {
            window.livewire.emit('enviarGanadorFinal', data_winner);
            console.log(data_winner);
            alert('Se ha registrado un ganador');
            window.location.href = '/admin/ganador/' + data_winner['winner_id'];
        });
    </script>

</div>
