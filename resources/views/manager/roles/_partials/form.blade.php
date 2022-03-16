@if ($disabled)
    <h4 class="card-title text-center mt-3">Editando regra: {{ $role->name }}</h4>
@endif

<div class="card-body">
    <div class="form-group row">
        <label for="name"
            class="col-sm-3 text-right control-label col-form-label">Nome<span>*</span></label>
        <div class="col-md-9">
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                name="name" value="{{ $role->name ?? old('name') }}" required>
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    @if ($disabled)
        <div class="form-group row">
            <label for="name"
                class="col-sm-3 text-right control-label col-form-label">Adicionar Permissões<span>*</span></label>
            <div class="col-md-9">
                @foreach ($permissions as $permission)
                    {{ Form::checkbox('permissions[]', $permission->id, in_array($permission->id, $rolePermissions) ? true : false) }}
                    {{ Form::label($permission->name) }}<br>
                @endforeach
            </div>
        </div>
    @else
        <div class="form-group row">
            <label for="name"
                class="col-sm-3 text-right control-label col-form-label">Adicionar Permissões<span>*</span></label>
            <div class="col-md-9">
                @foreach ($permissions as $permission)
                    {{ Form::checkbox('permissions[]', $permission->id) }}
                    {{ Form::label($permission->name) }}<br>
                @endforeach
            </div>
        </div>
    @endif
    <div class="border-top">
        <div class="card-body">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="javascript:history.back();" class="btn btn-info">Voltar</a>
        </div>
    </div>
</div>
