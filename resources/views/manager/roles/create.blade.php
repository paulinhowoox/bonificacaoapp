@extends('layouts.app')

@section('title', 'Cadastrar Regra')

@section('breadcrumb')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Regras</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('manager.roles.index') }}">Regras</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cadastrar Regra</li>
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
            <form class="form-horizontal" action="{{ route('manager.roles.store') }}" method="POST">
                @csrf

                @include('manager.roles._partials.form', ['disabled' => false])
            </form>
        </div>
    </div>
@endsection
