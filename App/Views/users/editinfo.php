<div class="row container">
  <h1>Alterar informações</h1>

  <?php if (!empty($data['msg'])) {
    foreach ($data['msg'] as $msg) {
      echo $msg . "<BR>";
    }
  } ?>

  <form action="" method="POST">
    <div class="row">
      <div class="input-field col s12">
        <input id="name" type="text" class="validate" name="name" value="<?php echo $_SESSION['userName'] ?>" required>
        <label class="active" for="title">Título</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input id="email" type="email" class="validate" name="email" value="<?php echo $_SESSION['userEmail'] ?>" required>
        <label class="active" for="email">Email</label>
      </div>
    </div>
    <button class="waves-effect waves-light btn" name="update">alterar</button>
  </form>
</div>