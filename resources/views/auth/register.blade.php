@extends('layouts/fullLayoutMaster')

@section('title', 'Register Page')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
@endsection

@section('content')
  <div class="auth-wrapper auth-v1 px-2">
    <div class="auth-inner py-2">
      <!-- Register v1 -->
      <div class="card mb-0">
        <div class="card-body">
          <a href="javascript:void(0);" class="brand-logo">
            <img src="{{asset('images/logo/logo.png')}}" class="direct-zap-logo"  alt="Logo">
          </a>

          <h4 class="card-title mb-1">A aventura começa aqui 🚀</h4>
          <p class="card-text mb-2">Registre-se no {{ config('app.name') }}!</p>

          <form class="auth-register-form mt-2" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
              <label for="register-name" class="form-label">Nome</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="register-username"
                     name="name" placeholder="Doe" aria-describedby="register-name" tabindex="1" autofocus
                     value="{{ old('name') }}"/>
              @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="register-surname" class="form-label">Sobrenome</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="register-username"
                     name="surname" placeholder="Jhon" aria-describedby="register-surname" tabindex="1" autofocus
                     value="{{ old('name') }}"/>
              @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="register-email" class="form-label">Email</label>
              <input type="text" class="form-control @error('email') is-invalid @enderror" id="register-email"
                     name="email" placeholder="john@example.com" aria-describedby="register-email" tabindex="2"
                     value="{{ old('email') }}"/>
              @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="register-password" class="form-label">Senha</label>

              <div class="input-group input-group-merge form-password-toggle @error('password') is-invalid @enderror">
                <input type="password" class="form-control form-control-merge @error('password') is-invalid @enderror"
                       id="register-password" name="password"
                       placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                       aria-describedby="register-password" tabindex="3"/>
                <div class="input-group-append">
                  <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                </div>
              </div>
              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="register-password-confirm" class="form-label">Confirmar senha</label>

              <div class="input-group input-group-merge form-password-toggle">
                <input type="password" class="form-control form-control-merge" id="register-password-confirm"
                       name="password_confirmation"
                       placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                       aria-describedby="register-password" tabindex="3"/>
                <div class="input-group-append">
                  <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block" tabindex="5">Registrar</button>
          </form>

          <p class="text-center mt-2">
            <span>Já possui uma conta?</span>
            @if (Route::has('login'))
              <a href="{{ route('login') }}">
                <span>Faça login</span>
              </a>
            @endif
          </p>
        </div>
      </div>
      <!-- /Register v1 -->
    </div>
  </div>
@endsection
