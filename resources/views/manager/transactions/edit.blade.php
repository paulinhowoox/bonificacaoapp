@extends('layouts.app')

@section('title', $transaction->transaction_type)

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
                        <li class="breadcrumb-item active" aria-current="page">{{ $transaction->title }}</li>
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
        <form class="form-horizontal" action="{{ route('manager.transactions.update', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT')

            @include('manager.transactions._partials.form', ['disabled' => true])
        </form>
    </div>
</div>
@endsection
