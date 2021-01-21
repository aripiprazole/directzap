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
      <h1 style="font-weight: 700; font-size: 20px;">Administração</h1>

      @error('errors')
      <div class="alert alert-danger">
        {{ $message }}
      </div>
      @enderror

      <form method="POST" action="{{ route('api.self.activate') }}">
        @csrf

        <div class="form-group">
          <label for="code">Codigo</label>

          <input type="text"
                 class="form-control"
                 id="code"
                 name="code"
                 placeholder="ck3hr7683298r362g68">
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-orange col-sm-12">
            Ativar sua conta!
          </button>
        </div>
      </form>
    </div>
  </div>
</section>

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
