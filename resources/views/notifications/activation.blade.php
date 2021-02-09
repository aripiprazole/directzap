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
        <h1>Olá, comprador</h1>

        <p>
          Esse email foi enviado para finalizar o seu cadastro no
          directzap.
        </p>
      </div>
    </section>

    <section style="display: flex; width: 100%; padding: 18px">
      <div style="margin: auto">
        <p>
          Por favor coloque esse código, assim que você entrar no directzap.
        </p>

        <div>
          <p>{{ $code->code }}</p>
        </div>
      </div>
    </section>
  </div>
</div>
