@if ($disabled)
    <h4 class="card-title text-center mt-3">Editando movimentação do funcionário: {{ $transaction->employee->full_name }}</h4>
@endif

<div class="card-body">
    <div class="form-group row">
        <label for="amount"
            class="col-sm-3 text-right control-label col-form-label">Valor<span>*</span></label>
        <div class="col-md-9">
            <input type="text" class="form-control @error('amount') is-invalid @enderror" id="amount"
                name="amount" value="{{ $transaction->amount ?? old('amount') }}">
                <small class="text-danger">utilize "." ao inves de "," para separar os valores, ex.: 23.39; 23500.15</small>
            @error('amount')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="description"
            class="col-sm-3 text-right control-label col-form-label">Descrição<span>*</span></label>
        <div class="col-md-9">
            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                name="description" value="{{ $transaction->description ?? old('description') }}">
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="employee_id" class="col-sm-3 text-right control-label col-form-label">Funcionários<span>*</span></label>
        <div class="col-md-9">
            <select name="employee_id" id="employee_id" class="form-control @error('employee_id') is-invalid @enderror select2">
                <option disabled selected>Escolha um funcionário</option>
                @if ($disabled)
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $transaction->employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->full_name }}</option>
                    @endforeach
                @else
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->full_name }}</option>
                    @endforeach
                @endif
            </select>
            @error('employee_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="transaction_type" class="col-sm-3 text-right control-label col-form-label">Tipo de Movimentação<span>*</span></label>
        <div class="col-md-9">
            <select name="transaction_type" id="transaction_type" class="form-control @error('transaction_type') is-invalid @enderror select2">
                <option disabled selected>Escolha o tipo</option>
                <option value="entrada">Entrada</option>
                <option value="saida">Saída</option>
            </select>
            @error('transaction_type')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="border-top">
        <div class="card-body">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="javascript:history.back();" class="btn btn-info">Voltar</a>
        </div>
    </div>
</div>
