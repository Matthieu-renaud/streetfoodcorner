<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Cave</title>
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
  
<main>
<?php 
        if (!isset($_SESSION['id'])) {
          echo "  <div class='alert-container'>";
          echo "<h2 class=\"error\">Accès refusé, vous n'avez pas les droits</h2>";
          echo "<button><a href='./index.php'>Retour à l'accueil</a></button></div>";
        } else {

  ?>

  <div class="alert-container">
    <?php


    $id = htmlspecialchars($_POST['id']);
    $idLen = strlen($id);
    $idBool= false;
    if (strlen($id)<=4) {
      echo "<h3 class=\"error\">L'ID est trop court : $idLen caractères(s)</h3>";
    } else {
      $idBool = true;
      echo "<h3 class=\"success\">L'ID est valide</h3>";
    }

    $mdp = htmlspecialchars($_POST['mdp']);
    $mdpLen = strlen($mdp);
    $mdpBool= false;
    if (strlen($mdp)<=6) {
      echo "<h3 class=\"error\">Le mot de passe est trop court : $mdpLen caractères(s)</h3>";
    } else {
      $mdpBool = true;
      echo "<h3 class=\"success\">Le mot de passe est valide</h3>";
    }

    $confmdp = htmlspecialchars($_POST['confmdp']);
    $confmdpLen = strlen($confmdp);
    $confmdpBool= false;
    if ($confmdp!=$mdp) {
      echo "<h3 class=\"error\">Les mots de passe ne sont pas identiques</h3>";
    } else {
      $confmdpBool = true;
      echo "<h3 class=\"success\">Les mots de passe sont identiques</h3>";
    }






    if($idBool && $mdpBool && $confmdpBool ) {
      echo "<h2 class=\"success\">Tous les champs sont valides</h2>";
      $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);
      
      $req = new PDO('mysql:host=sql11.freemysqlhosting.net;dbname=sql11416774', 'sql11416774', 'pRSWkI6pSn');
      $sth = $req->prepare('INSERT INTO users (identifiant, mdp) VALUES(:id, :pwd)');
      
      $sth->execute(array(
        'id' => strip_tags($id),
        'pwd' => strip_tags($mdpHash)
      ));
      
    } else {
      echo "<h2 class=\"error\">Tous les champs ne sont pas valides</h2>";
    }

    ?>
  </div>
  <button><a href="./ajout_user.php">Retour au formulaire</a></button>
  
  <?php } ?>
</main>


</body>
</html>
