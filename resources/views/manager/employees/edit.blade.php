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
        <form class="form-horizontal" action="{{ route('manager.employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')

            @include('manager.employees._partials.form', ['disabled' => true])
        </form>
    </div>
</div>
@endsection
