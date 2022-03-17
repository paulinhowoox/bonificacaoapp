@if ($disabled)
    <h4 class="card-title text-center mt-3">Editando administrador: {{ $user->name }}</h4>
@endif

<div class="card-body">
    <div class="form-group row">
        <label for="name"
            class="col-sm-3 text-right control-label col-form-label">Nome<span>*</span></label>
        <div class="col-md-9">
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                name="name" value="{{ $user->name ?? old('name') }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="email"
            class="col-sm-3 text-right control-label col-form-label">E-mail<span>*</span></label>
        <div class="col-md-9">
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                name="email" value="{{ $user->email ?? old('email') }}">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="roles"
            class="col-sm-3 text-right control-label col-form-label">Tipo de Acesso<span>*</span></label>
        <div class="col-md-9">
            @if ($disabled)
                {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control']) !!}
            @else
                {!! Form::select('roles', $roles, [], ['class' => 'form-control']) !!}
            @endif
            <small class="text-danger">Tenha muito cuidado ao dar acesso de administrador</small>
            @error('roles')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="email"
            class="col-sm-3 text-right control-label col-form-label">Senha<span>*</span></label>
        <div class="col-md-9">
            <input id="password" type="password"
                class="form-control @error('password') is-invalid @enderror" name="password"
                autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="email"
            class="col-sm-3 text-right control-label col-form-label">Confirmar Senha<span>*</span></label>
        <div class="col-md-9">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
        </div>
    </div>

    <div class="border-top">
        <div class="card-body">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="javascript:history.back();" class="btn btn-info">Voltar</a>
        </div>
    </div>
</div>
