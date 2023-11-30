@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 120px;">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div style="display: flex; justify-content: center;">
                <img src="{{ asset('imagenes/Fondo Los Retales.jpg') }}" style="width: 170px; border-radius: 50%;">
            </div>

            <h1 style="text-align: center;">{{ __('Registro') }}</h1>
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Nombre') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email ') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>Este email ya ha sido registrado</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                            <div class="input-group">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Las contraseñas no coinciden</strong>
                                </span>
                                @enderror

                            </div>


                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">{{ __('Confirmar Contraseña') }}</label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>Las contraseñas no coinciden</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger">
                                {{ __('Registrarse') }}
                            </button>
                            <a href="{{ route('login') }}" class="btn btn-dark">Iniciar Sesion</a>
                        </div>

                </div>


                </form>
            </div>
        </div>
    </div>
</div>
</div>



@endsection