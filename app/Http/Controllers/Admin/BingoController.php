<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Models\Admin\Bingo;
use App\Http\Controllers\Controller;

class BingoController extends Controller
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
        $bingos = Bingo::orderBy('id','Asc')->paginate();
        return view('admin.bingo.index', compact('bingos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bingo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'name' => 'required',
        ];

        $messages=[
            'name.required' => 'Ingrese un nombre',
        ];

        $validator=Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            $key = '';
            $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
            $max = strlen($pattern) - 1;
            for($i = 0; $i < 6; $i++):
                $key .= $pattern[mt_rand(0, $max)];
            endfor;
            $code = \Carbon\Carbon::parse(now())->format('H').$key.\Carbon\Carbon::parse(now())->format('is');
            $request->merge(['code' => $code]);
            $bingo = Bingo::create($request->all());
            return redirect()->route('bingo.index')->with('message','Creado con éxito.')->with('typealert','success');
        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bingo = Bingo::find($id);
        return view('admin.bingo.edit', compact('bingo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules=[
            'name' => 'required',
        ];

        $messages=[
            'name.required' => 'Ingrese un nombre',
        ];

        $validator=Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            $bingo = Bingo::find($id);
            $bingo->fill($request->all())->save();
            return redirect()->route('bingo.index')->with('message','Actualizado con éxito.')->with('typealert','success');
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bingo = Bingo::find($id)->delete();
        return back()->with('message', 'Eliminado correctamente')->with('typealert','success');
    }
}
