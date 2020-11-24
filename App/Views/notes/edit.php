<div class="row container">
  <h2>Editar bloco de anotação</h2>

  <?php if (!empty($data['msg'])) {
    foreach ($data['msg'] as $msg) {
      echo $msg . "<BR>";
    }
  } ?>

  <form action="" method="POST">
    <div class="row">
      <div class="input-field col s12">
        <input id="title" type="text" class="validate" name="title" value="<?php echo $data['notes']['title'] ?>" required>
        <label class="active" for="title">Título</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <textarea id="text" class="materialize-textarea" name="text"><?php echo $data['notes']['text'] ?></textarea>
        <label class="active" for="text">Texto</label>
      </div>
    </div>
    <button class="waves-effect waves-light btn orange" name="update">editar</button>
  </form>
</div>