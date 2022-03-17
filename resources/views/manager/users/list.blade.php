@extends('layouts.app')

@section('title', 'Administradores')

@section('breadcrumb')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Administradores</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Administradores</li>
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
            <div class="col-md-12"><a href="{{ route('manager.users.create') }}" class="btn btn-success">Novo Administrador</a></div>
            <hr>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                <strong>{{ session()->get('success') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <style>
                .dt-button.red {
                    background-color: #ec6d6d;
                    color: #ffffff;
                }
                .red:hover {
                    background-color: #fc8f8f !important;
                    color: #ffffff;
                }
                .dt-button.green {
                    background-color: green;
                    color: #ffffff;
                }
                .green:hover {
                    background-color: #51995a !important;
                    color: #ffffff;
                }
            </style>
            <table id="users_table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Regra</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if (!empty($user->getRoleNames()))
                                @foreach ($user->getRoleNames() as $role)
                                    <label class="badge badge-success">{{ $role }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td class="actions">
                            <a href="{{ route('manager.users.edit', $user->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                            <form class="form-delete" action="{{ route('manager.users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <a href="#" class="btn btn-danger btn-sm form-delete" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-toggle="modal" data-target="#delete-modal"><i class="fas fa-trash"></i></a>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Regra</th>
                        <th>Ação</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModal">Apagar item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja apagar o(a) Administrador(a) "<span class="item-name"></span>"?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="delete-button" data-controller="usercontroller">APAGAR</button>
            </div>
        </div>
    </div>
</div>
@endsection
