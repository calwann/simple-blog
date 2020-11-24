<div class="row container">
  <h1>Trocar senha</h1>

  <?php if (!empty($data['msg'])) {
    foreach ($data['msg'] as $msg) {
      echo $msg . "<BR>";
    }
  } ?>

  <form action="" method="POST">
    <div class="row">
      <div class="input-field col s12">
        <input id="passwd" type="password" class="validate" name="passwd" required>
        <label for="passwd">Senha</label>
      </div>
    </div>
    <button class="waves-effect waves-light btn" name="update">trocar</button>
  </form>
</div>