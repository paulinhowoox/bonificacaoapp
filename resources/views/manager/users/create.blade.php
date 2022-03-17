@extends('layouts.app')

@section('title', 'Cadastrar Administrador')

@section('breadcrumb')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Administradores</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('manager.users.index') }}">Administradores</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cadastrar Administrador</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="col-12">
        <div class="card">
            <form class="form-horizontal" action="{{ route('manager.users.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                @include('manager.users._partials.form', ['disabled' => false])
            </form>
        </div>
    </div>
@endsection
