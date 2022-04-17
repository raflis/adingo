<?php

namespace App\Http\Controllers\Admin;

use Hash;
use Excel;
use Validator;
use App\Models\User;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
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

    public function excel_export(Request $request)
    {
        $name = $request->get('name');
        $lastname = $request->get('lastname');
        $company = $request->get('company');

        return Excel::download(new UsersExport($name, $lastname, $company),'usuarios-adingo.xlsx');
    }

    public function excel_import(Request $request)
    {
        $rules=[
            'file_excel' => 'required|mimes:xlsx,xls',
        ];

        $messages=[
            'file_excel.required' => 'Seleccione un archivo a importar',
            'file_excel.mimes' => 'El archivo subido no es válido',
        ];

        $validator=Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            $file_excel = $request->file('file_excel');
            if(Excel::import(new UsersImport, $file_excel)):
                return redirect()->route('users.index')->with('message','Importación exitosa.')->with('typealert','success');
            else:
                return redirect()->route('users.index')->with('message','Importación fallida.')->with('typealert','danger');
            endif;
        endif;
    }

    public function index(Request $request)
    {
        $name = $request->get('name');
        $lastname = $request->get('lastname');
        $company = $request->get('company');

        $users = User::orderBy('id','Asc')
                        ->company($company)
                        ->name($name)
                        ->lastname($lastname)
                        ->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'lastname' => 'required',
            'email' => 'required|unique:users,email',
            'company' => 'required',
        ];

        $messages=[
            'name.required' => 'Ingrese un nombre',
            'lastname.required' => 'Ingrese un apellido',
            'company.required' => 'Ingrese empresa',
            'email.required' => 'Ingrese email',
            'email.unique' => 'Ya existe un usuario registrado con ese email',
        ];

        $validator=Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            $request->merge(['role' => 1]);
            $request->merge(['password' => Hash::make('adingo')]);
            $user = User::create($request->all());
            return redirect()->route('users.index')->with('message','Creado con éxito.')->with('typealert','success');
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
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
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
            'lastname' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'company' => 'required',
        ];

        $messages=[
            'name.required' => 'Ingrese un nombre',
            'lastname.required' => 'Ingrese un apellido',
            'company.required' => 'Ingrese empresa',
            'email.required' => 'Ingrese email',
            'email.unique' => 'Ya existe un usuario registrado con ese email',
        ];

        $validator=Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            $user = User::find($id);
            $user->fill($request->all())->save();
            return redirect()->route('users.index')->with('message','Actualizado con éxito.')->with('typealert','success');
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
        $user = User::find($id)->delete();
        return back()->with('message', 'Eliminado correctamente')->with('typealert','success');
    }
}
