<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Cave - Connexion</title>
  <link rel="stylesheet" href="./style.css">
  <link rel="shortcut icon" href="./assets/img/favicon.png" type="image/x-icon">
</head>
<body>

<?php session_start(); ?>
<header>
    <nav>
      <ul class="group_menus">
        <li class="menus"><a href="./index.php">MyCave</a></li>
      </ul>
      <ul class="group_menus">
        <li class="menus"><a href="./aff_article.php">Vins</a></li>
        <?php 
        if (isset($_SESSION['id']))
        echo '<li class="menus"><a href="./ajout_article.php">Ajout</a></li>';
      ?>
      </ul>
      <ul class="group_menus">
      <?php 
        if (isset($_SESSION['id'])) {
        echo '<li class="menus btn_deco"><a href="./deconnexion.php">Déconnexion</a></li>';
        } else {
        echo '<li class="menus btn_co"><a href="./connexion.php">Connexion</a></li>';
        }
      ?>
      </ul>
    </nav>
</header>

  <form action="./validation_connexion.php" method="post">
    <h1>Connexion</h1>
    <div class="form-container">
      <label for="id">ID</label>
      <input class="input" type="id" name="id" id="id">
    </div>
    <div class="form-container">
      <label for="mdp">Mot de passe</label>
      <input class="input" type="password" name="mdp" id="mdp">
    </div>
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <input class="btn" type="submit" value="Valider">
  </form>

</body>
</html>