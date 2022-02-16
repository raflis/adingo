<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Validator;
use App\Models\Admin\Home;
use App\Models\Admin\Bingo;
use Illuminate\Http\Request;
use App\Models\Admin\BingoLog;
use App\Models\Admin\BingoUser;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('isadmin');
    }
    
    public function index()
    {
        //
    }

    public function sala()
    {
        return view('admin.sala');
    }

    public function ganador()
    {
        return view('admin.ganador');
    }

    public function bingo(Request $request)
    {
        return view('admin.bingo');
    }

    public function bingox($code)
    {
        $bingo = Bingo::where('code', $code)->first();
        $id = $bingo->id;
        $bingolog = BingoLog::where('bingo_id', $id)->pluck('number')->toArray();
        $bingo_user = BingoUser::where('user_id', Auth::user()->id)->where('bingo_id', $id)->first();
        if($bingo_user):
            $numeros = $bingo_user->numbers;
        else:
            $numeros = array();
            $max_num = 25;
            srand(time());
            for ($x=1; $x <= $max_num; $x++):
                $num_aleatorio = rand(1,60);
                array_push($numeros, $num_aleatorio);
            endfor;
            $bingouser = new Bingouser();
            $bingouser->user_id = Auth::user()->id;
            $bingouser->bingo_id = $id;
            $bingouser->numbers = $numeros;
            $bingouser->save();
        endif;
        return view('admin.bingo', compact('bingo', 'numeros', 'bingolog'));
    }
}
