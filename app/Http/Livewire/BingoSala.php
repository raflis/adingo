<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Admin\Bingo;

class BingoSala extends Component
{
    public $nombre;
    public $respuesta;
    public $code;

    public function mount()
    {
        $this->nombre = "";
        $this->respuesta = "";
        $this->code = "";
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'nombre' => 'required',
        ],
        [
            'nombre.required' => 'Ingrese el código de la sala de juego'
        ]);
    }

    public function buscarsala()
    {
        $this->validate([
            'nombre' => 'required',
        ],
        [
            'nombre.required' => 'Ingrese el código de la sala de juego'
        ]);

        $bingo = Bingo::where('code', $this->nombre)->first();
        if($bingo):
            $this->respuesta = 'si';
            $this->code = $bingo->code;
        else:
            $this->respuesta = 'no';
        endif;
        $this->emit('salaBuscada', $this->respuesta, $this->code);
    }
    
    public function render()
    {
        return view('livewire.bingo-sala');
    }
}
