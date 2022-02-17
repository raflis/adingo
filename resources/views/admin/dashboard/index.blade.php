@extends('admin.master')

@section('content')

<div class="layoutContent">
    <div class="container-fluid profile">
        <div class="row show-header">
            <div class="col-sm-12">
                <h1 class="pt-3">
                     <span class="dashboard">Administrador de contenidos</span>
                </h1>
            </div>
        </div>
        <div class="row mt-3 dashboard">
            <div class="col-sm-12 col-md-4 mb-4">
                <div class="card shadow card border-start-lg border-start-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small font-semibold text-primary mb-1">
                                    Bingos creados
                                </div>
                                <div class="hx">
                                    {{ $bingos }}
                                </div>
                            </div>
                            <div class="ml-2">
                                <i class="fas fa-gamepad text-gray2 fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 mb-4">
                <div class="card shadow card border-start-lg border-start-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small font-semibold text-primary mb-1">
                                    Ganadores
                                </div>
                                <div class="hx">
                                    {{ $ganadores }}
                                </div>
                            </div>
                            <div class="ml-2">
                                <i class="fas fa-trophy text-warning fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 mb-4">
                <div class="card shadow card border-start-lg border-start-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small font-semibold text-primary mb-1">
                                    Usuarios en la plataforma
                                </div>
                                <div class="hx">
                                    {{ $usuarios }}
                                </div>
                            </div>
                            <div class="ml-2">
                                <i class="fas fa-user-shield text-gray2 fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection