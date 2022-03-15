@if ($disabled)
    <h4 class="card-title text-center mt-3">Editando funcionário: {{ $employee->full_name }}</h4>
@endif

<div class="card-body">
    <div class="form-group row">
        <label for="full_name"
            class="col-sm-3 text-right control-label col-form-label">Nome<span>*</span></label>
        <div class="col-md-9">
            <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name"
                name="full_name" value="{{ $employee->full_name ?? old('full_name') }}">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="current_balance"
            class="col-sm-3 text-right control-label col-form-label">Saldo<span>*</span></label>
        <div class="col-md-9">
            <input type="text" class="form-control @error('current_balance') is-invalid @enderror" id="current_balance"
                name="current_balance" value="{{ $employee->current_balance ?? old('current_balance') }}">
            @error('title')
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
