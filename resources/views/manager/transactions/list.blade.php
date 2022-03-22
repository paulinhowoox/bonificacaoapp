@extends('layouts.app')

@section('title', 'Movimentações')

@section('breadcrumb')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Movimentações</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Movimentações</li>
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
            <div class="col-md-12"><a href="{{ route('manager.transactions.create') }}" class="btn btn-success">Nova Movimentação</a></div>
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
            <div id="table-transaction-filter" class="col-md-12 mb-5">
                <div class="row">
                    <div class="col-md-12">
                        <label for="fromDate" class="col-form-label">Pesquisar por data: </label>
                        <div class="input-group input-daterange">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">De: </span>
                            </div>
                            <input type="text" class="form-control input-sm date-range-filter" id="fromDate" name="fromDate" data-date-format="dd/mm/yyyy" autocomplete="off">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2">Até: </span>
                            </div>
                            <input type="text" class="form-control input-sm date-range-filter" id="toDate" name="toDate" data-date-format="dd/mm/yyyy" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="employee-full_name" class="col-form-label">Nome: </label>
                        <select id="employee-full_name" class="form-control select2 employee-full_name">
                            <option></option>
                            @foreach($employeeName as $name)
                                <option value="{{ $name }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="type" class="col-form-label">Tipo: </label>
                        <select id="type" class="form-control select2 type">
                            <option></option>
                            @foreach($transactionType as $type)
                                <option value="{{ $type }}">{{ ucwords($type) }}</option>
                            @endforeach
                        </select>
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
                .entrada {
                    background-color: #83c38b !important;
                    color: #ffffff;
                }
                .saida {
                    background-color: #ff8080 !important;
                    color: #ffffff;
                }
            </style>
            <div id="export-transaction-table"></div>
            <table id="transaction_table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Valor</th>
                        <th>Funcionário</th>
                        <th>Observação</th>
                        <th>Data de Criação</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr class="@if($transaction->transaction_type == 'entrada') entrada @else saida @endif">
                            <td>{{ $transaction->id }}</td>
                            <td>{{ ucwords($transaction->transaction_type) }}</td>
                            <td>R$ {{ number_format($transaction->amount, 2, ',', '.') }}</td>
                            <td>{{ $transaction->employee->full_name }}</td>
                            <td>{{ $transaction->description }}</td>
                            <td>{{ $transaction->created_at->format('d/m/Y') }}</td>
                            <td class="actions">
                                {{--<a href="{{ route('manager.transactions.edit', $transaction->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>--}}
                                <a href="{{ route('manager.transactions.show', $transaction->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                {{--<form class="form-delete" action="{{ route('manager.transactions.destroy', $transaction->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <a href="#" class="btn btn-danger btn-sm form-delete" data-id="{{ $transaction->id }}" data-name="{{ $transaction->transaction_type }}" data-toggle="modal" data-target="#delete-modal"><i class="fas fa-trash"></i></a>
                                </form>--}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Valor</th>
                        <th>Funcionário</th>
                        <th>Observação</th>
                        <th>Data de Criação</th>
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
                <p>Tem certeza que deseja apagar a movimentação "<span class="item-name"></span>"?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="delete-button" data-controller="transactioncontroller">APAGAR</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            let fromDate = $('#fromDate').datepicker("getDate");
            let toDate = $('#toDate').datepicker("getDate");
            let d = data[5].split("/");
            let startDate = new Date(d[1] + "/" + d[0] + "/" + d[2]);

            if (fromDate == null && toDate == null) { return true; }
            if (fromDate == null && startDate <= toDate) { return true;}
            if (toDate == null && startDate >= fromDate) {return true;}
            if (startDate <= toDate && startDate >= fromDate) { return true};
            return false;
        }
    );
    $("#fromDate").datepicker(options_date_picker, {
        onSelect: function () {
            tableTransaction.draw();
        }
    });
    $("#toDate").datepicker(options_date_picker, {
        onSelect: function () {
            tableTransaction.draw();
        }
    });
    // Event listener to the two range filtering inputs to redraw on input
    $('#fromDate, #toDate').change(function () {
        tableTransaction.draw();
    });

    let tableTransaction = $('#transaction_table').DataTable({
        responsive: true,
        order: [[0, 'desc']],
        dom: '<"top">lr<"table-transaction-filter-container"><"clear">rt<"bottom">Bfr<"export-transaction-table">tip',
        lengthChange: false,
        initComplete: function(settings){
            var api = new $.fn.dataTable.Api(settings);
            $('.table-transaction-filter-container', api.table().container()).append(
                $('#table-transaction-filter').detach().show()
            );
            $('#table-transaction-filter .employee-full_name').on('change', function () {
                tableTransaction.column(3).search(this.value).draw();
            });
            $('#table-transaction-filter .type').on('change', function () {
                tableTransaction.column(1).search(this.value).draw();
            });
        },
        "language": {
            "url": pt_br_link
        },
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Exportar Excel',
                title: 'Relatório de Movimentações',
                className: 'green',
                exportOptions: {
                    columns: [0, 1, 2, 3],
                    orthogonal: 'export'
                }
            },
            {
                extend: 'pdfHtml5',
                className: 'red',
                text: 'Exportar PDF',
                title: 'Relatório de Movimentações',
                exportOptions: {
                    columns: [0, 1, 2, 3],
                    orthogonal: 'export'
                }
            }
        ]
    });
</script>
@endsection
