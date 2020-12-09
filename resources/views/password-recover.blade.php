<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DirectZap</title>
  <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
        crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('app.css') }}">
</head>

<body>
<section class="container-fluid" id="background-azul"></section>

<section class="container" id="background-flutuante">
  <div class="d-flex justify-content-center">
    <div class="col-md-7">
      <div class="card login-card">
        <div class="card-header">Recuperar senha</div>

        <div class="card-body">
          @error('errors')
          <div class="alert alert-danger">
            {{ $message }}
          </div>
          @enderror

          <form method="POST" action="{{ route('api.recover') }}">
            @csrf

            <div class="form-group">
              <input type="email"
                     class="form-control"
                     id="email"
                     name="email"
                     placeholder="E-mail">
            </div>

            <button type="submit" class="btn btn-orange">
              Recuperar senha
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous">
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous">
</script>

</body>

</html>
