<div class="row container">
  <h1>Cadastrar novo usuário</h1>

  <?php if (!empty($data['msg'])) {
    foreach ($data['msg'] as $msg) {
      echo $msg . "<BR>";
    }
  } ?>

  <form action="" method="POST">
    <div class="row">
      <div class="input-field col s12">
        <input id="name" type="text" class="validate" name="name" required>
        <label for="name">Nome Completo</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input id="email" type="email" class="validate" name="email" required>
        <label for="email">Email</label>
      </div>
    </div>
    <div class="input-field col s12">
      <input id="passwd" type="password" class="validate" name="passwd" required>
      <label for="passwd">Senha</label>
    </div>
    <button class="waves-effect waves-light btn" name="post">cadastrar</button>
  </form>
</div>