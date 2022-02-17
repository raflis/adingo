<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Models\User;
use App\Models\Admin\Bingo;
use App\Models\Admin\Winner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class WinnerController extends Controller
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
        $winners = Winner::orderBy('id','Desc')->paginate();
        return view('admin.winners.index', compact('winners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bingos = Bingo::orderBy('name', 'Asc')->pluck('name', 'id');
        $users = User::select('id', DB::raw("concat(name, ' ', lastname) as full_name"))->orderBy('name', 'Asc')->pluck('full_name', 'id');
        return view('admin.winners.create', compact('bingos', 'users'));
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
            'bingo_id' => 'required',
            'user_id' => 'required',
        ];

        $messages=[
            'bingo_id.required' => 'Seleccione una sala de bingo',
            'user_id.required' => 'Seleccione un usuario',
        ];

        $validator=Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            $winner = Winner::create($request->all());
            return redirect()->route('winners.index')->with('message','Creado con éxito.')->with('typealert','success');
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
        $bingos = Bingo::orderBy('name', 'Asc')->pluck('name', 'id');
        $users = User::select('id', DB::raw("concat(name, ' ', lastname) as full_name"))->orderBy('name', 'Asc')->pluck('full_name', 'id');
        $winner = Winner::find($id);
        return view('admin.winners.edit', compact('winner', 'bingos', 'users'));
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
            'bingo_id' => 'required',
            'user_id' => 'required',
        ];

        $messages=[
            'bingo_id.required' => 'Seleccione una sala de bingo',
            'user_id.required' => 'Seleccione un usuario',
        ];

        $validator=Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            $winner = Winner::find($id);
            $winner->fill($request->all())->save();
            return redirect()->route('winners.index')->with('message','Actualizado con éxito.')->with('typealert','success');
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
        $winner = Winner::find($id)->delete();
        return back()->with('message', 'Eliminado correctamente')->with('typealert','success');
    }
}
