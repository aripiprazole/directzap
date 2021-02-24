@extends('layouts/fullLayoutMaster')

@section('title', 'Forgot Password')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
@endsection

@section('content')
<div class="auth-wrapper auth-v1 px-2">
  <div class="auth-inner py-2">
    <!-- Forgot Password v1 -->
    <div class="card mb-0">
      <div class="card-body">
        <a href="javascript:void(0);" class="brand-logo">
          <img src="{{asset('images/logo/logo.png')}}" class="direct-zap-logo" alt="Logo">
        </a>

        <h4 class="card-title mb-1">Esqueceu sua senha? 🔒</h4>
        <p class="card-text mb-2">Coloque seu email e enviaremos um passo-a-passo de como recuperá-la.</p>

        <form class="auth-forgot-password-form mt-2" method="POST" action="{{ route('password.email') }}">
          @csrf
          <div class="form-group">
            <label for="forgot-password-email" class="form-label">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="forgot-password-email" name="email" value="{{ old('email') }}" placeholder="john@example.com" aria-describedby="forgot-password-email" tabindex="1" autofocus />
             @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary btn-block" tabindex="2">Enviar email</button>
        </form>

        <p class="text-center mt-2">
          @if (Route::has('login'))
          <a href="{{ route('login') }}"> <i data-feather="chevron-left"></i> Voltar ao login </a>
          @endif
        </p>
      </div>
    </div>
    <!-- /Forgot Password v1 -->
  </div>
</div>
@endsection
