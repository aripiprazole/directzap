@extends('layouts/contentLayoutMaster')

@section('title', 'Colaboradores')

@section('content')
  <!-- Kick start -->
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Colaboradores</h4>
    </div>
    <div class="card-body d-flex flex-column">
      @if($user->overflow())
        <div class="alert alert-danger" role="alert">
          <div class="alert-body">
            <strong>
              Você ultrapassou o seu limite de colaboradores de {{ $user->configuration->max_collaborators }}, as
              conversões não irão contar.
            </strong>
          </div>
        </div>
      @endif

      @if(!$user->active)
        <div class="alert alert-danger" role="alert">
          <div class="alert-body">
            <strong>Você não está ativado, as conversões não irão contar.</strong>
          </div>
        </div>
      @endif

      @if(!is_null($message = session()->get('message')))
        <div class="alert alert-primary" role="alert">
          <div class="alert-body">
            {{ $message }}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      @elseif($collaborators->isEmpty())
        <div class="alert alert-primary" role="alert">
          <div class="alert-body">
            Você não possui colaboradores! Para criar um novo colaborador,
            <a
              class="text-primary"
              href="{{ route('dashboard.collaborators.create') }}"
            >
              clique aqui.
            </a>
          </div>
        </div>
        @endif

        @if($collaborators->isNotEmpty())
          <div class="table-responsive">
            <table class="table">
              <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Conversões totais</th>
                <th scope="col">Status</th>
                <th scope="col">Ações</th>
              </tr>
              </thead>
              <tbody>
              @foreach($collaborators as $collaborator)
                <tr>
                  <th scope="row">{{ $collaborator->id }}</th>
                  <td>{{ $collaborator->name }}</td>
                  <td>{{ $collaborator->total_count }}</td>
                  <td>
                    @if(!$collaborator->user->active)
                      <div class="badge badge-danger">
                        Expirado
                      </div>
                    @elseif($collaborator->active)
                      <div class="badge badge-success">
                        Ativado
                      </div>
                    @else
                      <div class="badge badge-warning">
                        Desativado
                      </div>
                    @endif
                  </td>
                  <td>
                    <div class="dropdown">
                      <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"
                              aria-haspopup="true" aria-expanded="false">
                        <i data-feather="more-vertical"></i>
                      </button>

                      <div class="dropdown-menu">
                        <form class="dropdown-item" method="POST"
                              action="{{ route('dashboard.collaborators.pause', ['collaborator' => $collaborator->id]) }}">
                          @csrf

                          <button class="btn" href="#" @unless($collaborator->user->active) disabled @endunless>
                            @if($collaborator->active)
                              <i data-feather="pause"></i> Desativar
                            @else
                              <i data-feather="play"></i> Ativar
                            @endif
                          </button>
                        </form>
                        <div class="dropdown-item">
                          <a class="btn"
                             href="{{ route('dashboard.collaborators.edit', ['collaborator' => $collaborator->id])  }}">
                            <i data-feather="edit"></i> Editar
                          </a>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>

          <div class="m-auto">
            {{ $collaborators->links('vendor.pagination.bootstrap-4') }}
          </div>
        @endif
    </div>
  </div>

@endsection
