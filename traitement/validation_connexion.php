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

  $id = htmlspecialchars(strip_tags($_POST['id']));
  $mdp = htmlspecialchars($_POST['mdp']);

  if(strlen($id)>4 && strlen($mdp)>6) {
        
    $req = new PDO('mysql:host=sql11.freemysqlhosting.net;dbname=sql11416774', 'sql11416774', 'pRSWkI6pSn');
    $sth = $req->prepare('SELECT mdp FROM users WHERE identifiant=:id');
    
    $sth->execute(array(
      'id' => $id
    ));

    $result = $sth->fetchAll();

    if (!empty($result)){
    if (password_verify($mdp,$result[0]['mdp'])) {
      if(!isset($_SESSION)) 
      { 
        session_start();
      }
      $_SESSION['id'] = $id;
      echo "<h2 class=\"success\">Bonjour ".$_SESSION['id']."</h2>";
    } else {
      echo "<h2 class=\"error\">Erreur sur l'identifiant ou le mot de passe</h2>";
    }
  } else {
    echo "<h2 class=\"error\">Erreur sur l'identifiant ou le mot de passe</h2>";
  }


    
  } else {
    echo "<h2 class=\"error\">Erreur sur l'identifiant ou le mot de passe</h2>";
  }

  ?>
      
  <button><a href="./index.php">Retour à l'accueil</a></button>

</main>

</body>
</html>