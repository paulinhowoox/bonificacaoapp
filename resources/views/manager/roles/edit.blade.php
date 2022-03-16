@extends('layouts.app')

@section('title', $role->name)

@section('breadcrumb')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Roles</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('manager.roles.index') }}">Roles</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $role->name }}</li>
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
            <form class="form-horizontal" action="{{ route('manager.roles.update', $role->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('manager.roles._partials.form', ['disabled' => true])
            </form>
        </div>
    </div>
@endsection
