@extends('admin.master')

@section('content')

<div class="layoutContent">
    <div class="container-fluid">
        <div class="row layout-header">
            <div class="col-sm-12 header-content">
                <h1>
                    <i class="fas fa-user-shield fa-xs text-white2"></i> Usuarios
                </h1>
                <span class="subtitle">
                    Crear, editar y eliminar usuarios.
                </span>
            </div>
        </div>
        <div class="row layout-body">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header">
                        <span>
                            Usuarios
                        </span>
                        <div class="d-flex align-items-center header_items">
                            <div class="crear_descargar">
                                <a class="btn btn-success" href="{{ route('users.create') }}">
                                    <span class="icon">
                                        <i class="fas fa-plus px-2 py-1"></i>
                                    </span>
                                    <span class="text px-2 py-1">
                                        Crear
                                    </span>
                                </a>
                                <a class="btn btn-success btn-descargar" href="{{ route('users.excel.export', ['name' => request('name'), 'lastname' => request('lastname'), 'company' => request('company')]) }}">
                                    <span class="icon">
                                        <i class="fas fa-download px-2 py-1"></i>
                                    </span>
                                    <span class="text px-2 py-1">
                                        Descargar
                                    </span>
                                </a>
                            </div>
                            <div class="importar">
                                <form action="{{ route('users.excel.import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="choose-file" class="custom-file-upload" id="choose-file-label">Seleccionar Excel</label>
                                        <input name="file_excel" type="file" id="choose-file" accept=".xlsx, .xls" style="display: none;">
                                    </div>
                                    <button class="btn btn-info btn-importar" type="submit">
                                        <span class="icon">
                                            <i class="fas fa-upload px-2 py-1"></i>
                                        </span>
                                        <span class="text px-2 py-1">
                                            Importar
                                        </span>
                                    </button>
                                </form>
                                <a class="btn btn-success btn-descargar" href="{{ asset('excel/template.xlsx') }}">
                                    <span class="icon">
                                        <i class="fas fa-file-excel px-2 py-1"></i>
                                    </span>
                                    <span class="text px-2 py-1">
                                        Plantilla
                                    </span>
                                </a>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <div class="buscar-descarga">
                            <form class="row" action="{{ route('users.index') }}" method="GET" style="width:100%">
                                <div class="form-group col-md-3 mb-0">
                                    <label class="labelspan pr-1">Nombres:</label>
                                    <input type="text" class="form-control" name="name" placeholder="Nombres" value="{{ request('name') }}">
                                </div>
                                <div class="form-group col-md-3 mb-0">
                                    <label class="labelspan pr-1">Apellidos:</label>
                                    <input type="text" class="form-control" name="lastname" placeholder="Apellido" value="{{ request('lastname') }}">
                                </div>
                                <div class="form-group col-md-3 mb-0">
                                    <label class="labelspan pr-1">Empresa:</label>
                                    <input type="text" class="form-control" name="company" placeholder="Empresa" value="{{ request('company') }}">
                                </div>
                                <div class="form-group col-md-3 mb-0">
                                    <label class="labelspan pr-1"></label>
                                    <button type="submit" class="btn btn-primary btn-buscar">
                                        Buscar &nbsp;&nbsp;<i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="px-3">
                        @include('admin.includes.alert')
                    </div>
                </div>
                <div class="tablaTotal">
                    <table class="table tableD">
                        <thead>
                            <tr>
                                <th>N??</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Email</th>
                                <th>Empresa</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $users->firstItem() + $loop->index }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->lastname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->company }}</td>
                                <td>
                                    <div style="display: inline-flex">
                                        <a class="btn btn-primary text-white btn-sm mr-1" href="{{ route('users.edit', $user->id) }}">
                                            <i class="far fa-edit pr-1"></i> Editar
                                        </a>
                                        @if(!$user->role == 0)
                                        <a class="btn btn-danger btn-sm btn-eliminar" href="" ideliminar="{{ $user->id }}"><i class="far fa-trash-alt pr-1"></i> Eliminar</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="paginacionTotal d-flex justify-content-end">
                    {{ $users->withQueryString()->render() }}
                </div>
            </div>
        </div>
        @include('admin.includes.footer')
    </div>
</div>

<div class="modal fade" id="deleting" tabindex="-1" role="dialog" aria-labelledby="deletingLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body text-center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <i class="fas fa-exclamation-circle fa-5x text-warning mb-3"></i>
            <p class="mb-0 font-bold first">??Est??s seguro?</p>
            <p class="mb-0 font-light second">El registro seleccionado ser?? eliminado y no podr?? recuperarse.</p>
        </div>
        <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            {!! Form::open(['route' => ['users.destroy', ''], 'method' => 'DELETE', 'id' => 'form-eliminar']) !!}
                <button class="btn btn-danger">
                    S??, eliminar
                </button>                           
            {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>
@endsection

@section('script')

<script>
$('document').ready(function(){
    $('.btn-eliminar').click(function(e){
        e.preventDefault();
        var id = $(this).attr('ideliminar');
        var base = '{{ route('users.destroy', '') }}';
        var url = base + '/' +id;
        $('#form-eliminar').attr('action', url);
        $('#deleting').modal('show');
    });

    $('#choose-file').change(function () {
		var i = $(this).prev('label').clone();
		var file = $('#choose-file')[0].files[0].name;
		$(this).prev('label').text(file);
	});
})
</script>

@endsection