<style>
  @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Roboto', sans-serif;
  }

  p, a {
    font-size: 18px;
  }

  section {
    padding: 16px;
    display: flex;
    flex-direction: column;
  }
</style>

<div style="display: block; height: 100%; background: #f9f9f9">
  <div style="margin: 0 auto; display: block">
    <section style="background: #d9882b;
                width: 100%;
                min-height: 120px;
                color: #f9f9f9;
                display: flex;">
      <div style="height: min-content; margin: auto">
        <h1>
          Olá, {{ $user->name }}
        </h1>

        <p>
          Esse email foi enviado para mudança da sua senha.
        </p>
      </div>
    </section>

    <section style="display: flex; width: 100%; padding: 18px">
      <div style="margin: auto">
        <p>
          Esse link expirará em {{ config('auth.passwords.users.expire') }} minutos. (OBS: se o botão não funcionar, copie
          e cole o link: <a href="{{ $url }}" rel="noopener noreferrer">{{ $url }}</a>)
        </p>

        <div style="display: flex; justify-content: center; margin: 24px">
          <a href="{{ $url }}" rel="noopener noreferrer" style="
          display: block;
          padding: 18px;
          background: #d9882b;
          color: #f9f9f9;
          text-decoration: none;
          border-radius: 12px;">
            Mudar senha
          </a>
        </div>

        <div>
          <p>
            Se você não requisitou isso, apenas ignore.
          </p>
        </div>
      </div>
    </section>
  </div>
</div>
