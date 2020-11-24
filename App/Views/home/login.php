<div class="row container">
  <h2>Fazer Login</h2>

  <?php if (!empty($data['msg'])) {
    foreach ($data['msg'] as $msg) { ?>
      <?php echo $msg ?>
  <?php }
  } ?>

  <?php if (!isset($_SESSION['logged'])) { ?>
    <form action="" method="POST">
      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" class="validate" name="email" required>
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" class="validate" name="passwd" required>
          <label for="password">Senha</label>
        </div>
      </div>
      <button class="waves-effect waves-light btn" name="login">Entrar</button>
    </form>
  <?php } ?>
</div>