<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
        crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('app.css') }}">
</head>

<body>

<section class="container-fluid mb-3" id="background-azul">
  <div class="d-flex align-items-end flex-column" id="logoutMobile">
    <a href="{{ route('api.logout') }}">Sair</a>
  </div>
</section>

<section class="container" id="background-flutuante">
  <div class="card principal-row">
    <div class="card-header">
      <div class="row">
        <div class="col-md-6">
          Bem vindo, {{ $user->name }}!
        </div>

        <div class="col-md-6">
          <div class="d-flex align-items-end flex-column" id="logout">
            <a href="{{  route('api.logout')  }}">
              Sair

              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-box-arrow-right" fill="currentColor"
                   xmlns="http://www.w3.org/2000/svg">

                <path fill-rule="evenodd"
                      d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>

                <path fill-rule="evenodd"
                      d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <p>Link para colocar no Facebook Ads:
            <a target="__blank"
               style="text-decoration: none; font-weight: bold;"
               href="{{ $link_facebook_ads }}">
              {{ $link_facebook_ads }}
            </a>
          </p>
        </div>

        <div class="col-md-12">
          <p>Link para parceria (Direto acesso ao DirectZap):
            <a target="__blank"
               style="text-decoration: none; font-weight: bold;"
               href="{{ $link_direct }}">
              {{ $link_direct }}
            </a>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12" style="display: flex; gap: 12px">
          @if($user->is_disabled)
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#colabModal" disabled>
              Adicionar colaborador
            </button>
          @else
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#colabModal">
              Adicionar colaborador
            </button>
          @endif

          <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#PixelModal">
            Adicionar Pixel
          </button>

          <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#LinCodModal">
            Config Código
          </button>

          <div class="d-flex align-items-end flex-column" style="margin-left: auto">
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#configModal">
              Config
            </button>
          </div>
        </div>
      </div>

      <div class="table-responsive" style="width: 100%">
        <table class="table mt-3 text-center">
          <thead class="thead-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Colaborador</th>
            <th scope="col">Conversões totais</th>
            <th colspan="2">Opções</th>
          </tr>
          </thead>

          <tbody>

          @foreach($collaborators as $collaborator)
            <tr>
              <td>{{ $collaborator->id }}</td>
              <td>{{ $collaborator->name }}</td>
              <td>{{ $collaborator->counter }}</td>
              <td>
                <a class="btn btn-dark"
                   href="{{ route('edit-collaborator', ['collaborator' => $collaborator->id]) }}">
                  Editar
                </a>

                <a class="btn btn-danger"
                   href="{{ route('delete-collaborator', ['collaborator' => $collaborator->id]) }}"
                   data-id="{{ $collaborator->id }}">
                  Remover
                </a>
              </td>
            </tr>
          @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>
</section>


<div class="modal fade" id="colabModal" tabindex="-1" aria-labelledby="colabModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="colabModal">Colaborador</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="POST" action="{{ route('api.collaborators.store') }}">
          @csrf

          <div class="form-group">
            <label for="name">Nome</label>

            <input type="text"
                   class="form-control"
                   id="name"
                   name="name"
                   placeholder="Nome e Sobrenome">
          </div>

          <div class="form-group">
            <label for="message">Mensagem</label>

            <input type="text"
                   class="form-control"
                   id="message"
                   name="message"
                   placeholder="ex: Olá, John!">
          </div>

          <div class="form-group">
            <label for="phone">Telefone</label>

            <input type="text"
                   class="form-control"
                   id="phone"
                   name="phone"
                   placeholder="ex: 21911112222">
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-orange col-sm-12">
              Adicionar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="configModal" tabindex="-1" aria-labelledby="configModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="configModal">
          Configurações
        </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="POST" action="{{ route('api.configs.store') }}">
          @csrf

          <div class="form-group">
            <p class="p-1">
              Olá, insira no campo abaixo o número de vezes que um colaborador será solicitado
              antes de passar a vez para outro colaborador.
            </p>

            <input type="text"
                   class="form-control"
                   id="times"
                   name="times"
                   placeholder="Ex: 1"
                   required>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-orange col-sm-12">
              Salvar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="PixelModal" tabindex="-1" aria-labelledby="PixelModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="configModal">
          Adicionar Pixel
        </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="post" action="{{ route('api.pixels.store') }}">
          @csrf

          <div class="form-group">
            <p class="p-1">Insira abaixo seu Pixel</p>

            <input type="text"
                   class="form-control"
                   id="pixel"
                   name="pixel"
                   placeholder="Ex: 1282707308773467"
                   required>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-orange col-sm-12">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="LinCodModal" tabindex="-1" aria-labelledby="LinCodModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="configModal">Adicionar Código</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="POST" action="{{ route('api.codes.store') }}">
          @csrf

          <div class="form-group">
            <p class="p-1">Insira um código de até 5 digitos</p>

            <input type="text"
                   class="form-control"
                   id="code"
                   name="code"
                   value="{{ $code ?? '' }}"
                   placeholder="Ex: dr89f"
                   maxlength="5"
                   minlength="4"
                   required>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-orange col-sm-12">
              Salvar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js">
</script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous">
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous">
</script>

<script src="{{ asset('app.js') }}">
</script>

</body>

</html>
