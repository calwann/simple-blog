<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

  <title>PHP MVC</title>
</head>

<body>
  <!--<img src="../assets/images/architectureMVC.png" alt="">-->

  <ul id="dropdown1" class="dropdown-content">
    <li><a href="/users/new">Cadastrar Usuário</a></li>
    <li><a href="/users/editinfo">Alterar informações</a></li>
    <li><a href="/users/editpasswd">Trocar senha</a></li>
    <li><a href="/home/logout">Sair</a></li>
  </ul>
  <nav class="blue">
    <div class="nav-wrapper container">
      <a href="/" class="brand-logo">NOTAS</a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="/">Home</a></li>
        <li><?php if (isset($_SESSION['logged'])) { ?><a href="/notes/new">Criar Bloco</a><?php } ?></li>
        <?php if (!isset($_SESSION['logged'])) { ?>
          <li><a href="/home/login">Entre</a></li>
        <?php } else { ?>
          <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Olá <?php echo $_SESSION['userName'] ?><i class="material-icons right">arrow_drop_down</i></a></li>
        <?php } ?>
        <li><a class="nav-search-trigger" href="#!"><i class="material-icons">search</i></a></li>
      </ul>
    </div>
  </nav>

  <ul class="sidenav" id="mobile-demo">
    <li><a href="/">Home</a></li>
    <li><?php if (isset($_SESSION['logged'])) { ?><a href="/notes/new">Criar Bloco</a><?php } ?></li>
    <li><?php if (isset($_SESSION['logged'])) { ?><a href="/users/new">Cadastrar Usuário</a><?php } ?></li>
    <?php if (!isset($_SESSION['logged'])) { ?>
      <li><a href="/home/login">Entre</a></li>
    <?php } else { ?>
      <li><a href="/users/editinfo">Alterar informações</a></li>
      <li><a href="/users/editpasswd">Trocar senha</a></li>
      <li><a href="/home/logout">Sair</a></li>
    <?php } ?>
    <li><a class="nav-search-trigger" href="#!"><i class="material-icons">search</i></a></li>
  </ul>

  <nav id="nav-search" class="blue-grey lighten-4 scale-transition scale-out">
    <div class="nav-wrapper container">
      <form method="POST" action="home/search">
        <div class="input-field">
          <input id="search" type="search" name="search" required>
          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
          <i class="material-icons">close</i>
        </div>
      </form>
    </div>
  </nav>

  <?php require_once '../App/Views/' . $view . '.php' ?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.sidenav').sidenav();
      $('.dropdown-trigger').dropdown();
    });
    $('.nav-search-trigger').click(function() {
      if ($('#nav-search').hasClass('scale-out')) {
        $('#nav-search').removeClass('scale-out');
      } else {
        $('#nav-search').addClass('scale-out');
      }
    })
  </script>

</body>


</html>