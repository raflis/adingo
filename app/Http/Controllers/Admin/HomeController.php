<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Models\Admin\Home;
use Illuminate\Http\Request;
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
        $this->middleware('isadmin');
    }
    
    public function index()
    {
        //
    }

    public function ganador()
    {
        return view('admin.ganador');
    }

    public function bingo()
    {
        $numeros = array();
        $max_num = 25;
        srand(time());
        for ($x=1; $x <= $max_num; $x++):
            $num_aleatorio = rand(1,60);
            array_push($numeros, $num_aleatorio);
        endfor;
        //return count($numeros);
        return view('admin.bingo', compact('numeros'));
    }

    public function aleatorio(Request $request)
    {
        srand(time());
        $num_aleatorio = rand(1,60);
        return $num_aleatorio;
    }
}
