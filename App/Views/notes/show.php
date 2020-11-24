<div class="row container">
  <h2><?php echo $data['title'] ?></h2>

  <p><?php echo $data['text'] ?></p>

  <?php if (isset($_SESSION['logged'])) { ?><a class="waves-effect waves-light btn orange" href="/notes/exclude/<?php echo $data['id'] ?>">Excluir</a><?php } ?>
  <?php if (isset($_SESSION['logged'])) { ?><a class="waves-effect waves-light btn red" href="/notes/edit/<?php echo $data['id'] ?>">Editar</a><?php } ?>
</div>