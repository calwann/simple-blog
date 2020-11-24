<div class="row container">
  <h2>Criar bloco de anotação</h2>

  <?php if (!empty($data['msg'])) {
    foreach ($data['msg'] as $msg) {
      echo $msg . "<BR>";
    }
  } ?>

  <form action="" method="POST" enctype="multipart/form-data">
    <div class="row">
      <div class="input-field col s12">
        <input id="title" type="text" class="validate" name="title" required>
        <label for="title">Título</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <textarea id="text" class="materialize-textarea" name="text"></textarea>
        <label for="text">Texto</label>
      </div>
    </div>

    <div class="row">
      <div class="file-field input-field col s12">
        <div class="waves-effect waves-light btn-small green lighten-1">
          <span>Enviar Imagem</span>
          <input type="file" name="foo" value="" />
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text">
        </div>
      </div>
    </div>

    <button type="submit" class="waves-effect waves-light btn" name="post" value="Upload File">cadastrar</button>
  </form>
</div>