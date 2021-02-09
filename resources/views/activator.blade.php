<div style="padding: 1em; background: #f1f1f1; border-radius: 12px">
  <h1 style="font-weight: 700; font-size: 20px;">Administração</h1>

  @error('errors')
  <div class="alert alert-danger">
    {{ $message }}
  </div>
  @enderror

  <form method="POST" action="{{ route('api.activate') }}">
    @csrf

    <div class="form-group">
      <label for="email">Email</label>

      <input type="text"
             class="form-control"
             id="email"
             name="email"
             placeholder="alberto@gmail.com">
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-orange col-sm-12">
        Ativar conta!
      </button>
    </div>
  </form>
</div>
