@extends('layouts/fullLayoutMaster')

@section('title', 'Login')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
@endsection

@section('content')
<div class="auth-wrapper auth-v1 px-2">
  <div class="auth-inner py-2">
    <!-- Login v1 -->
    <div class="card mb-0">
      <div class="card-body">
        <a href="javascript:void(0);" class="brand-logo">
          <img src="{{asset('images/logo/logo.png')}}" class="direct-zap-logo" alt="Logo">
        </a>

        <h4 class="card-title mb-1">Bem vindo ao {{ config('app.name') }}! 👋</h4>
        <p class="card-text mb-2">Por favor faça login antes de continuar.</p>

        <form class="auth-login-form mt-2" method="POST" action="{{ route('login') }}">
          @csrf
          <div class="form-group">
            <label for="login-email" class="form-label">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="login-email" name="email" placeholder="john@example.com" aria-describedby="login-email" tabindex="1" autofocus value="{{ old('email') }}" />
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group">
            <div class="d-flex justify-content-between">
              <label for="login-password">Senha</label>
              @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}">
                <small>Esqueceu a senha?</small>
              </a>
              @endif
            </div>

            <div class="input-group input-group-merge form-password-toggle">
              <input type="password" class="form-control form-control-merge" id="login-password" name="password" tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="login-password" />
              <div class="input-group-append">
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input" type="checkbox" id="remember-me" name="remember-me" tabindex="3" {{ old('remember-me') ? 'checked' : '' }} />
              <label class="custom-control-label" for="remember-me"> Lembrar senha </label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" tabindex="4">Entrar</button>
        </form>

        <p class="text-center mt-2">
          <span>Novo aqui?</span>
          @if (Route::has('register'))
          <a href="{{ route('register') }}">
            <span>Criar uma conta</span>
          </a>
          @endif
        </p>
      </div>
    </div>
    <!-- /Login v1 -->
  </div>
</div>
@endsection
