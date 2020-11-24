<div class="row container">
  <?php if (!empty($data['msg'])) {
    foreach ($data['msg'] as $msg) { ?>
      <?php echo $msg ?>
  <?php }
  } ?>

  <?php
  $pagination = new App\Pagination(
    $data['notes'],
    isset($_GET['page']) ? $_GET['page'] : 1,
    3
  );
  ?>

  <?php if (empty($pagination->result())) { ?>
    <h3>Nenhum registro encontrado</h3>
  <?php } ?>

  <?php foreach ($pagination->result() as $notes) { ?>

    <h2><a href="/notes/show/<?php echo $notes['id'] ?>"><?php echo $notes['title'] ?></a></h2>

    <?php if (!empty($notes['image'])) { ?>
      <img src="<?php echo URL_BASE ?>assets/uploads/<?php echo $notes['image'] ?>" width="700" alt="Imagem <?php echo $notes['title'] ?>">
    <?php } ?>

    <p><?php echo $notes['text'] ?></p>

    <?php if (isset($_SESSION['logged'])) { ?><a class="waves-effect waves-light btn orange" href="/notes/edit/<?php echo $notes['id'] ?>">Editar</a><?php } ?>
    <?php if (isset($_SESSION['logged'])) { ?><a class="waves-effect waves-light btn red" href="/notes/exclude/<?php echo $notes['id'] ?>">Excluir</a><?php } ?>
  <?php } ?>

  <?php $pagination->navigator() ?>
</div>