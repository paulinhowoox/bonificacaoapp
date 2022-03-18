@extends('layouts.app')

@section('title', $employee->full_name)

@section('breadcrumb')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Funcionários</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('manager.employees.index') }}">Funcionários</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $employee->full_name }}</li>
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
            <div class="card-body">
                <h5 class="card-title mb-0">Informações</h5>
            </div>
            <div class="box box-primary">
                <div class="box-body">
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Data:</b> <span class="pull-right">{{ $employee->created_at->format('d/m/Y - H:i:s') }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Nome:</b> <span class="pull-right">{{ $employee->full_name }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Saldo atual:</b> <span class="pull-right">R$ {{ number_format($employee->current_balance, 2, ',', '.') }}</span>
                        </li>
                    </ul>
                </div>
                <div class="border-top">
                    <div class="card-body">
                        <a href="javascript:history.back();" class="btn btn-info">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
