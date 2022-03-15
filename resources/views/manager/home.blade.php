@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Dashboard') }}</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <h1>Painel Administrativo</h1>
            <p>Olá <strong>{{ auth()->user()->name }}</strong></p>
        </div>
    </div>
@endsection
