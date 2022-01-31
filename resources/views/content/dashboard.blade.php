@extends('layouts/contentLayoutMaster')

@section('title', 'Painel')

@section('content')
<!-- Kick start -->
Filho da puta?
{{--<div class="card">--}}
{{--  <div class="card-header">--}}
{{--    <h4 class="card-title"></h4>--}}
{{--  </div>--}}
{{--  <div class="card-body">--}}
{{--    <div class="card-text">--}}
{{--      <p>--}}
{{--        Seja bem vindo ao DirectZap! Abaixo você consegue ver os seus links de distribuição.--}}
{{--      </p>--}}

{{--      @if($user->overflow())--}}
{{--        <div class="alert alert-danger" role="alert">--}}
{{--          <div class="alert-body">--}}
{{--            <strong>--}}
{{--              Você ultrapassou o seu limite de colaboradores de {{ $user->configuration->max_collaborators }}, as--}}
{{--              conversões não irão contar.--}}
{{--            </strong>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      @endif--}}

{{--      @if(!$user->active)--}}
{{--        <div class="alert alert-danger" role="alert">--}}
{{--          <div class="alert-body">--}}
{{--            <strong>Você não está ativado, as conversões não irão contar.</strong>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      @endif--}}

{{--      @if(!$user->hasCollaborators())--}}
{{--        <div class="alert alert-danger" role="alert">--}}
{{--          <div class="alert-body">--}}
{{--            <strong>Você não possui colaboradores, as conversões não irão contar.</strong>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      @endif--}}

{{--      <div class="alert alert-primary" role="alert">--}}
{{--        <div class="alert-body">--}}
{{--          <strong>Link direto:</strong>--}}
{{--          <a--}}
{{--            class="text-primary"--}}
{{--            href="{{ $user->configuration->generateUrl('direct') }}"--}}
{{--            target="_blank"--}}
{{--          >--}}
{{--            {{ $user->configuration->generateUrl('direct') }}--}}
{{--          </a>--}}
{{--        </div>--}}
{{--      </div>--}}

{{--      <div class="alert alert-primary" role="alert">--}}
{{--        <div class="alert-body">--}}
{{--          <strong>Facebook ads:</strong>--}}
{{--          <a--}}
{{--            class="text-primary"--}}
{{--            href="{{ $user->configuration->generateUrl('facebook')  }}"--}}
{{--            target="_blank"--}}
{{--          >--}}
{{--            {{ $user->configuration->generateUrl('facebook') }}--}}
{{--          </a>--}}
{{--        </div>--}}
{{--      </div>--}}
{{--    </div>--}}
{{--  </div>--}}
{{--</div>--}}

@endsection
