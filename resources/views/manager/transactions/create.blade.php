@extends('layouts.app')

@section('title', 'Cadastrar Movimentação')

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
                            <li class="breadcrumb-item active" aria-current="page">Cadastrar Movimentação</li>
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
            <form class="form-horizontal" action="{{ route('manager.transactions.store') }}" method="POST">
                @csrf

                @include('manager.transactions._partials.form', ['disabled' => false])
            </form>
        </div>
    </div>
@endsection
