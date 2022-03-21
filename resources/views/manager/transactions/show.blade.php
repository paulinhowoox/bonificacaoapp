@extends('layouts.app')

@section('title', $transaction->employee->full_name)

@section('breadcrumb')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Movimentações</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('manager.transactions.index') }}">Movimentações</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $transaction->employee->full_name }}</li>
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
                            <b>Data:</b> <span class="pull-right">{{ $transaction->created_at->format('d/m/Y - H:i:s') }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Nome:</b> <span class="pull-right">{{ $transaction->employee->full_name }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Valor:</b> <span class="pull-right">R$ {{ number_format($transaction->amount, 2, ',', '.') }}</span>
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
