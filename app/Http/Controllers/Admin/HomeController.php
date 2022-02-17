<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Validator;
use App\Models\User;
use App\Models\Admin\Home;
use App\Models\Admin\Bingo;
use App\Models\Admin\Winner;
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

    public function ganadorPost(Request $request)
    {
        $rules=[
            'bingo_id' => 'required',
            'user_id' => 'required',
        ];

        $validator=Validator::make($request->all(), $rules);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            if(Winner::where('bingo_id', $request->bingo_id)->where('user_id', $request->user_id)->first()):
                return back()->with('message','Ya existe un ganador para este juego.')->with('typealert','danger')->withInput();
            endif;
            $winner = Winner::create($request->all());
            if($winner):
                return redirect()->route('ganador.index', $winner->id);
            else:
                return back()->with('message','Se ha producido un error en el sistema')->with('typealert','danger')->withInput();
            endif;
        endif;
    }

    public function ganador($id)
    {
        $winner = Winner::find($id);
        return view('admin.ganador', compact('winner'));
    }

    public function bingo(Request $request)
    {
        return view('admin.bingo');
    }

    public function bingo_user($user_id, $bingo_id)
    {
        $user = User::find($user_id);
        $bingo = Bingo::find($bingo_id);
        $bingolog = BingoLog::where('bingo_id', $bingo_id)->pluck('number')->toArray();
        $bingo_user = BingoUser::where('user_id', $user_id)->where('bingo_id', $bingo_id)->first();
        $numeros = $bingo_user->numbers;
        return view('admin.bingo-user', compact('user', 'bingo', 'numeros', 'bingolog'));
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
