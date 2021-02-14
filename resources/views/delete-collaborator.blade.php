<!DOCTYPE html>
<html lang="en">
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

<div class="modal bgModal" tabindex="-1" role="dialog">
  <div id="deleteModal" class="modal">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Remover Colaborador</h4>

          <a type="button"
             class="close"
             href="{{ route('dashboard') }}"
             aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </a>
        </div>

        <div class="modal-body">
          @error('errors')
          <div class="alert alert-danger">
            {{ $message }}
          </div>
          @enderror

          <p>Deseja remover esse colaborador?</p>

          <form method="POST"
                action="{{ route('api.collaborators.destroy', ['collaborator' => $collaborator->id]) }}"
                id="form-delete-user">
            @csrf
          </form>
        </div>

        <div class="modal-footer">
          <button type="submit" form="form-delete-user" class="btn btn-danger col-sm-12">
            Remover
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

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

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>

<script src="{{ asset('app.js') }}">
</script>

<script>
  loadModal();
</script>

</body>
</html>
