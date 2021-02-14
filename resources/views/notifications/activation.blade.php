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

  .code {
    font-weight: bold;
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
        <div>Olá, parabéns por adquirir o DirectZap. Segue abaixo como criar e ativar sua conta.</div>
        <br/>

        <div>Como criar sua conta:</div>
        <div>- Entre no link <a href="https://directzap.com.br/membros">https://directzap.com.br/membros</a></div>
        <div>- Clique no botão: Criar Conta</div>
        <div>- Complete o formulário e clique em: Criar Conta</div>
        <br/>

        <div>Como ativar seu acesso:</div>
        <div>- No link <a href="https://directzap.com.br/membros">https://directzap.com.br/membros</a> complete com seu email e senha de cadastro</div>
        <div>- Coloque o seguinte código: <font size="3"><b>{{ $code->code }}</b></font> e clique em ativar</div>

        <div>Parabéns agora você já pode usar o DirectZap. Espero que goste.</div>

        <div>Qualquer dúvida entrar em contato por email: suporte@directzap.com.br ou no WhatsApp: <a href="https://api.whatsapp.com/send?phone=5511993625697&text=Oi%20Bruno%2C%20tenho%20algumas%20d%C3%BAvidas%20sobre%20o%20DirectZap">(11) 9 9362-5697</a></div>
      </div>
    </section>
  </div>
</div>

