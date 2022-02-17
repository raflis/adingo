<div>

    <div class="form-group">
        <input type="text" class="form-control" id="nombre" name="nombre" wire:model="nombre" placeholder="Ingrese código de la sala">
    </div>
    @if($respuesta == 'no')
        <small class="btn btn-danger font-bold d-block">La sala no existe</small>
    @endif
    @if($respuesta == 'ganador')
        <small class="btn btn-warning font-bold d-block">Ya existe un ganador registrado para la sala buscada</small>
    @endif
    @error('nombre') <small class="text-white">{{ $message }}</small> @enderror
    <button class="btn btn-primary btn-login mt-2 col-12 py-2" wire:click="buscarsala">
        Buscar sala
    </button>

    <script>
        window.livewire.on('salaBuscada', (mensaje, code) => {
            if(mensaje == 'si'){
                $('.btn-login').html('Redireccionando a la sala de juego ...');
                setTimeout("location.href='" + base + "/admin/bingo-online?code=" + code + "'", 2000);
            }else if(mensaje =="ganador"){
                $('.btn-login').html('Redireccionando a la vista del ganador ...');
                setTimeout("location.href='" + base + "/admin/ganador/" + code + "'", 2000);
            }
        });
    </script>

</div>
