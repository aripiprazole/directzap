@extends('layouts/contentLayoutMaster')

@section('title', "Editar usuário {$user->name}")

@section('content')
  <!-- Kick start -->
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Editar usuário {{ $target->name }}</h4>
    </div>
    <div class="card-body">
      <form id="edit-form" method="POST" action="{{ route('dashboard.users.update', ['user' => $target->id]) }}"
            enctype="multipart/form-data">
        @csrf

        @if(!is_null($message = session()->get('message')))
          <div class="alert alert-primary" role="alert">
            <div class="alert-body">
              {{ $message }}

              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
      @endif

      <!-- header media -->
        <div class="media">
          <a href="javascript:void(0);" class="mr-25">
            <img
              src="{{ $target->avatar }}"
              id="account-upload-img"
              class="rounded mr-50"
              alt="profile image"
              height="80"
              width="80"
            />
          </a>
          <!-- upload and reset button -->
          <div class="media-body mt-75 ml-1">
            <label for="account-upload" class="btn btn-sm btn-primary mb-75 mr-75">Fazer upload</label>
            <input type="file" id="account-upload" name="avatar" hidden accept="image/*"/>
            <p>Permitido JPG, GIF or PNG. Tamanho máximo de 800kB</p>
          </div>
          <!--/ upload and reset button -->
        </div>
        <!--/ header media -->

        <div class="form-group">
          <label for="name">Nome</label>
          <input required name="name" type="text" class="form-control" id="name" placeholder="Jhon"
                 value="{{ $user->name }}">
        </div>

        <div class="form-group">
          <label for="surname">Sobrenome</label>
          <input required name="surname" type="text" class="form-control" id="surname" placeholder="Jhon"
                 value="{{ $user->surname }}">
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input required name="email" type="email" class="form-control" id="email" placeholder="jhon.doe@example.com"
                 value="{{ $user->email }}">
        </div>

        <div class="form-group">
          <div class="d-flex justify-content-between">
            <label for="login-password">Senha</label>
          </div>

          <div class="input-group input-group-merge form-password-toggle">
            <input type="password" class="form-control form-control-merge" id="login-password" name="password"
                   tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                   aria-describedby="login-password"/>
            <div class="input-group-append">
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
          </div>
        </div>
      </form>

      <div class="d-flex g">
        <button form="edit-form" type="submit" class="btn btn-primary mr-1">
          <i data-feather="save"></i>
          Salvar alterações
        </button>

        <form method="POST"
              action="{{ route('dashboard.users.activate', ['user' => $target->id]) }}">
        @csrf

        <!--suppress HtmlFormInputWithoutLabel -->
          <input hidden name="user_id" type="number" value="{{ $target->id }}">

          <button
            @if($user->cannot('update', $target) || $target->active) disabled @endif
          type="submit"
            class="btn btn-warning mr-1">
            <i data-feather="power"></i>

            @if($target->active)
              Já ativo
            @else
              Ativar
            @endif
          </button>
        </form>

        <form method="POST"
              action="{{ route('dashboard.users.destroy', ['user' => $target->id]) }}">
          @csrf

          <button @if($user->cannot('delete', $target)) disabled @endif type="submit"
                  class="btn btn-danger mr-1">
            <i data-feather="trash"></i>
          </button>
        </form>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Editar informações de {{ $target->name }}</h4>
    </div>
    <div class="card-body">
      <form method="POST"
            action="{{ route('dashboard.configurations.update', ['configuration' => $target->configuration->id]) }}">
        @csrf

        <div class="form-group">
          <label for="pix">Pix</label>
          <input required name="pix" type="text" class="form-control" id="pix"
                 placeholder="Pix de  {{ $target->name }}"
                 value="{{ $user->configuration->pix }}">
        </div>

        <div class="form-group">
          <label for="code">Código</label>
          <input required name="code" type="text" class="form-control" id="code"
                 placeholder="Código de {{ $target->name }}"
                 value="{{ $user->configuration->code }}">
        </div>

        <div class="form-group">
          <label for="max-collaborators">Conversões por colaborador</label>
          <input required name="max-collaborators" type="text" class="form-control" id="max-collaborators"
                 placeholder="Max. colaboradores de {{ $target->name }}"
                 value="{{ $user->configuration->conv_per_user }}">
        </div>

        <div class="form-group">
          <label for="conv-per-user">Conversões por colaborador</label>
          <input required name="conv-per-user" type="text" class="form-control" id="conv-per-user"
                 placeholder="Conv. por colaborador de {{ $target->name }}"
                 value="{{ $user->configuration->conv_per_user }}">
        </div>

        <button type="submit" class="btn btn-primary mr-1">
          <i data-feather="save"></i>
          Salvar alterações
        </button>
      </form>
    </div>
  </div>

@endsection
