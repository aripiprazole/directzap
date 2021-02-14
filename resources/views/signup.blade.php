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
        <div class="card-header">Acessar o Sistema</div>

        <div class="card-body">
          @error('errors')
          <div class="alert alert-danger">
            {{ $message }}
          </div>
          @enderror

          <form method="POST" action="{{ route('api.signup') }}">
            @csrf

            <div class="form-group">
              <input type="text"
                     class="form-control"
                     id="name"
                     name="name"
                     placeholder="Nome">
            </div>

            <div class="form-group">
              <input type="text"
                     class="form-control"
                     id="surname"
                     name="surname"
                     placeholder="Sobrenome">
            </div>

            <div class="form-group">
              <input type="email"
                     class="form-control"
                     id="email"
                     name="email"
                     placeholder="E-mail">
            </div>

            <div class="form-group">
              <input type="password"
                     class="form-control"
                     id="password"
                     name="password"
                     placeholder="Senha">
            </div>

            <button type="submit" class="btn btn-orange">Criar conta</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

</body>

<script type="text/javascript">
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/6028aaec9c4f165d47c311fc/1eufdnb4p';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
  })();
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous">
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous">
</script>

</html>
