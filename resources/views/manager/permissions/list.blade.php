@extends('layouts.app')

@section('title', 'Permissões')

@section('breadcrumb')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Permissões</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Permissões</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title"></h5>
        <div class="table-responsive">
            <div class="col-md-12">
                <a href="{{ route('manager.permissions.create') }}" class="btn btn-success">Nova Permissão</a>
            </div>
            <br>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                <strong>{{ session()->get('success') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td class="actions">
                            <a href="{{ route('manager.permissions.edit', $permission->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                            <form class="form-delete" action="{{ route('manager.permissions.destroy', $permission->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <a href="#" class="btn btn-danger btn-sm form-delete" data-id="{{ $permission->id }}" data-name="{{ $permission->name }}" data-toggle="modal" data-target="#delete-modal"><i class="fas fa-trash"></i></a>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nome</th>
                        <th>Ação</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-modal" tabindex="-1" permission="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog" permission="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModal">Apagar item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja apagar a permissão "<span class="item-name"></span>"?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="delete-button" data-controller="permissioncontroller">APAGAR</button>
            </div>
        </div>
    </div>
</div>
@endsection
