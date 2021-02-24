@extends('layouts.fullLayoutMaster')

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
          <p class="card-text mb-2">Por favor se ative antes de continuar.</p>

          @if(!is_null($message = session()->get('error')))
            <div class="alert alert-danger" role="alert">
              <div class="alert-body">
                {{ $message }}

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          @endif

          <form class="auth-login-form mt-2" method="POST" action="{{ route('dashboard.activate') }}">
            @csrf

            <div class="form-group">
              <label for="login-code" class="form-label">Código</label>
              <input type="text" class="form-control" id="login-code" name="code" placeholder="Code: f3r32a"
                     aria-describedby="login-code" tabindex="1" autofocus/>
            </div>

            <button type="submit" class="btn btn-primary btn-block" tabindex="4">Ativar</button>
          </form>
        </div>
      </div>
      <!-- /Login v1 -->
    </div>
  </div>
@endsection
