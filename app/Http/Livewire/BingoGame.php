<?php

namespace App\Http\Livewire;

use Auth;
use App\Models\User;
use Livewire\Component;
use App\Models\Admin\Bingo;
use App\Models\Admin\Winner;
use App\Models\Admin\BingoLog;
use App\Models\Admin\BingoUser;

class BingoGame extends Component
{
    public $code;
    public $bingo;
    public $winner, $winnerF;
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
    public $nombre_ganador = "", $id_bingo_unico, $id_nombre_ganador;
    public $ganador_final = "";
    public $winner_id;
    public $repe = false;
    public $contador;

    public $numberClicked;
    public $clave;

    protected $listeners = ['enviarAleatorio' ,'enviarNombre'];

    public function mount()
    {
        $this->numeros = [];
        $this->numberClicked = [];
        $this->code = request()->query('code', $this->code);

        $this->bingo = Bingo::where('code', $this->code)->first();
        $this->winner = Winner::where('bingo_id', $this->bingo->id)->first();
        if($this->winner):
            $this->winnerF = User::find($this->winner->user_id);
            $this->ganador_final = $this->winnerF->name.' '.$this->winnerF->lastname;
        endif;
        $this->nombre_bingo = $this->bingo->name;
        $this->id_bingo = $this->bingo->id;
        $this->bingolog = BingoLog::where('bingo_id', $this->id_bingo)->pluck('number')->toArray();
        $this->numeros_aleatorios_game = $this->bingolog;
        $this->contador = count($this->bingolog);
        $this->bingo_user = BingoUser::where('user_id', Auth::user()->id)->where('bingo_id', $this->id_bingo)->first();
        if($this->bingo_user):
            $this->numeros = $this->bingo_user->numbers;
        else:
            $this->numeros = array();
            $this->max_num = 25;
            srand(time());
            while (count($this->numeros) >=0 && count($this->numeros) < 5):
                $this->num_aleatorio = mt_rand(1,15);
                if(!in_array($this->num_aleatorio, $this->numeros)):
                    array_push($this->numeros, $this->num_aleatorio);
                endif;
            endwhile;
            while (count($this->numeros) >=5 && count($this->numeros) < 10):
                $this->num_aleatorio = mt_rand(16,30);
                if(!in_array($this->num_aleatorio, $this->numeros)):
                    array_push($this->numeros, $this->num_aleatorio);
                endif;
            endwhile;
            while (count($this->numeros) >=10 && count($this->numeros) < 15):
                $this->num_aleatorio = mt_rand(31,45);
                if(!in_array($this->num_aleatorio, $this->numeros)):
                    array_push($this->numeros, $this->num_aleatorio);
                endif;
            endwhile;
            while (count($this->numeros) >=15 && count($this->numeros) < 20):
                $this->num_aleatorio = rand(46,60);
                if(!in_array($this->num_aleatorio, $this->numeros)):
                    array_push($this->numeros, $this->num_aleatorio);
                endif;
            endwhile;
            while (count($this->numeros) >=20 && count($this->numeros) < 25):
                $this->num_aleatorio = rand(61,75);
                if(!in_array($this->num_aleatorio, $this->numeros)):
                    array_push($this->numeros, $this->num_aleatorio);
                endif;
            endwhile;
            $this->bingouser = new Bingouser();
            $this->bingouser->user_id = Auth::user()->id;
            $this->bingouser->bingo_id = $this->id_bingo;
            $this->bingouser->numbers = $this->numeros;
            $this->bingouser->save();
        endif;
    }

    public function SetClicked($numClicked)
    {
        if(($this->clave = array_search($numClicked, $this->numberClicked)) !== false):
            unset($this->numberClicked[$this->clave]);
        else:
            array_push($this->numberClicked, $numClicked); 
        endif;
    }

    public function validarNum($num)
    {
        $this->repe = false;
        if(in_array($num, $this->bingolog)):
            $this->repe = true;
        endif;
        return $this->repe;
    }

    public function generarNumero()
    {
        srand(time());
        $this->repe = false;
        
        while($this->repe == false):
            if($this->contador < 75):
                $this->num_aleatorio_new = mt_rand(1,75);
                if(!in_array($this->num_aleatorio_new, $this->bingolog)):
                    $this->repe = true;
                    $this->bingolog[] = $this->num_aleatorio_new;
                    BingoLog::create([
                        'bingo_id' => $this->id_bingo,
                        'number' => $this->num_aleatorio_new
                    ]);
                endif;
            else:
                $this->repe = true;
                $this->num_aleatorio_new = ':(';
            endif;
        endwhile;

        $this->contador ++;

        //$this->emit('aleatorio', $this->num_aleatorio_new);
        event(new \App\Events\SentNumber($this->num_aleatorio_new));
    }

    public function enviarAleatorio($num_aleatorio_new0)
    {
        $num_aleatorio_new0 = $num_aleatorio_new0['numero'];
        $this->bingolog[] = $num_aleatorio_new0;
        $this->numero_obtenido = $num_aleatorio_new0;
        $this->nombre_ganador = "";
    }

    public function enviarMiNombre($nombre_, $user_id_, $bingo_)
    {
        $this->nombre_ganador = $nombre_;
        $this->id_nombre_ganador = $user_id_;
        $this->id_bingo_unico = $bingo_;
        //$this->emit('nombrePosible', $this->nombre_ganador, $this->id_bingo_unico);
        event(new \App\Events\SentName($this->nombre_ganador, $this->id_nombre_ganador, $this->id_bingo_unico));
    }

    public function enviarNombre($data0)
    {
        $this->nombre_ganador = $data0['name'];
        $this->id_nombre_ganador = $data0['user_id'];
        $this->id_bingo_unico = $data0['bingo_id'];
    }

    public function enviarGanador()
    {
        $this->winner = Winner::where('bingo_id', $this->bingo->id)->first();
        if($this->winner):
            $this->winnerF = User::find($this->winner->user_id);
            $this->ganador_final = $this->winnerF->name.' '.$this->winnerF->lastname;
            event(new \App\Events\SentWinner($this->ganador_final, $this->winner->id));
        endif;
    }

    public function enviarGanadorFinal($data_w)
    {
        $this->ganador_final = $data_w['ganador_final_nombre'];
        $this->winner_id = $data_w['winner_id'];
    }

    public function render()
    {
        return view('livewire.bingo-game');
    }
}
