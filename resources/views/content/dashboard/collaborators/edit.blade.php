@extends('layouts/contentLayoutMaster')

@section('title', "Editar colaborador {$collaborator->name}")

@section('content')
  <!-- Kick start -->
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Editar colaborador {{ $collaborator->name }}</h4>
    </div>
    <div class="card-body">
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

      <form id="edit-form" method="POST"
            action="{{ route('dashboard.collaborators.update', ['collaborator' => $collaborator->id]) }}">
        @csrf

        <div class="form-group">
          <label for="name">Nome</label>
          <input required name="name" type="text" class="form-control" id="name" placeholder="Jhon"
                 value="{{ $collaborator->name }}">
        </div>

        <div class="form-group">
          <label for="phone">Telefone</label>
          <input required name="phone" type="text" class="form-control" id="phone" placeholder="995535321"
                 value="{{ $collaborator->phone }}">
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input required name="email" type="email" class="form-control" id="email" placeholder="jhon.doe@example.com"
                 value="{{ $collaborator->email }}">
        </div>

        <div class="form-group">
          <label for="message">Mensagem</label>
          <input required name="message" type="text" class="form-control" id="message"
                 placeholder="Olá Jhon, vi seu anúncio..."
                 value="{{ $collaborator->message }}">
        </div>
      </form>

        <div class="d-flex g">
          <button form="edit-form" type="submit" class="btn btn-primary mr-1">
            <i data-feather="save"></i>
            Salvar alterações
          </button>

          <form method="POST"
                action="{{ route('dashboard.collaborators.clear', ['collaborator' => $collaborator->id]) }}">
            @csrf

            <button @if($user->cannot('update', $collaborator)) disabled @endif type="submit"
                    class="btn btn-warning mr-1">
              <i data-feather="x-circle"></i>

              Limpar conversões
            </button>
          </form>

          <form method="POST"
                action="{{ route('dashboard.collaborators.destroy', ['collaborator' => $collaborator->id]) }}">
            @csrf

            <button @if($user->cannot('delete', $collaborator)) disabled @endif type="submit"
                    class="btn btn-danger mr-1">
              <i data-feather="trash"></i>
            </button>
          </form>
        </div>
    </div>
  </div>
@endsection
