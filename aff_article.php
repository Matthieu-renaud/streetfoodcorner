<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Cave - Les Vins</title>
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

  <div class="info info-bottle">
      <h2>Liste des bouteilles</h2>
    </div>

<section class="card-container">
      <?php

      $req = new PDO('mysql:host=sql11.freemysqlhosting.net;dbname=sql11416774', 'sql11416774', 'pRSWkI6pSn');
      
      $stmt = $req->prepare("SELECT articles.id, articles.name, articles.year, articles.grapes, articles.country, articles.region, articles.description, articles.picture FROM articles
      ORDER BY id");
      $stmt->execute();
      
      $resultat = $stmt->fetchAll();

      for ($i=0; $i < count($resultat); $i++) { 
        echo "<div class='card'>";
        echo "<div class='card-component'><div class='card-component-component'><h3 class='card-name'>{$resultat[$i]['name']}</h3>";
        echo "<h3 class='card-year'><em>{$resultat[$i]['year']}</em></h3>";
        echo "<h3 class='card-grapes'>{$resultat[$i]['grapes']}</h3>";
        echo "<h3 class='card-region'>{$resultat[$i]['region']}, {$resultat[$i]['country']}</h3>";
        echo "<h3 class='card-description'>{$resultat[$i]['description']}</h3></div>";
        if(isset($_SESSION['id'])) {
        echo "<div class='card-component-component'><div class=\"modif\"><button id=\"modif{.$i}\"><a href=\"./edit_article.php?id={$resultat[$i]['id']}\">Modifier</a></button></div>";
        echo "<div class=\"suppr\"><button id=\"suppr{.$i}\"><a href=\"./del_article.php?id={$resultat[$i]['id']}\">Supprimer</a></button></div></div>";
        }
        echo "</div>";
        $picture = (!$resultat[$i]['picture']) ? 'vide' : $resultat[$i]['picture'];
        echo "<div class='card-component'><div class=\"card-picture\" style=\"background-image: url($picture)\"></div></div>";
        echo "</div>";
      }
      
      ?>

</section>

</main>

</body>
</html>