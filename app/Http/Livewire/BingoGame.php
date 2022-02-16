<?php

namespace App\Http\Livewire;

use Auth;
use Livewire\Component;
use App\Models\Admin\Bingo;
use App\Models\Admin\BingoLog;
use App\Models\Admin\BingoUser;

class BingoGame extends Component
{
    public $code;
    public $bingo;
    public $numeros;
    public $bingolog;
    public $id_bingo;
    public $bingo_user;
    public $max_num;
    public $x;
    public $num_aleatorio;
    public $numeros_aleatorios_game;
    public $num_aleatorio_new;
    public $num_aleatorio_new2;
    public $num_aleatorio_new0;
    public $numero_obtenido = "??";
    public $nombre_bingo;

    protected $listeners = ['enviarAleatorio'];

    public function mount()
    {
        $this->numeros = [];
        $this->code = request()->query('code', $this->code);

        $this->bingo = Bingo::where('code', $this->code)->first();
        $this->nombre_bingo = $this->bingo->name;
        $this->id_bingo = $this->bingo->id;
        $this->bingolog = BingoLog::where('bingo_id', $this->id_bingo)->pluck('number')->toArray();
        $this->numeros_aleatorios_game = $this->bingolog;
        $this->bingo_user = BingoUser::where('user_id', Auth::user()->id)->where('bingo_id', $this->id_bingo)->first();
        if($this->bingo_user):
            $this->numeros = $this->bingo_user->numbers;
        else:
            $this->numeros = array();
            $this->max_num = 25;
            srand(time());
            for ($this->x = 1; $this->x <= $this->max_num; $this->x++):
                $this->num_aleatorio = rand(1,60);
                array_push($this->numeros, $this->num_aleatorio);
            endfor;
            $this->bingouser = new Bingouser();
            $this->bingouser->user_id = Auth::user()->id;
            $this->bingouser->bingo_id = $this->id_bingo;
            $this->bingouser->numbers = $this->numeros;
            $this->bingouser->save();
        endif;
    }

    public function generarNumero()
    {
        srand(time());
        $this->num_aleatorio_new = rand(1,60);
        $this->bingolog[] = $this->num_aleatorio_new;
        BingoLog::create([
            'bingo_id' => $this->id_bingo,
            'number' => $this->num_aleatorio_new
        ]);
        $this->emit('aleatorio', $this->num_aleatorio_new);

        event(new \App\Events\SentNumber($this->num_aleatorio_new));
    }

    public function enviarAleatorio($num_aleatorio_new0)
    {
        $num_aleatorio_new0 = $num_aleatorio_new0['numero'];
        $this->bingolog[] = $num_aleatorio_new0;
        $this->numero_obtenido = $num_aleatorio_new0;
    }

    public function render()
    {
        return view('livewire.bingo-game');
    }
}
