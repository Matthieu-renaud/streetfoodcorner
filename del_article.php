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
<?php 
        if (!isset($_SESSION['id'])) {
          echo "  <div class='alert-container'>";
          echo "<h2 class=\"error\">Accès refusé, vous n'avez pas les droits</h2>";
          echo "<button><a href='./index.php'>Retour à l'accueil</a></button></div>";
        } else {

  ?>

    <div class="alert-container delete-this">
    <section class="card-container">

      
      <div class="info">Vous avez sélectionné cette bouteille :</div>
      
      <br>

      <?php
      
      $id = htmlspecialchars($_GET['id']);

      $req = new PDO('mysql:host=sql11.freemysqlhosting.net;dbname=sql11416774', 'sql11416774', 'pRSWkI6pSn');
            
      $stmt = $req->prepare("SELECT name, articles.year, grapes, country, region, description, picture FROM articles WHERE id=:id");
      $stmt->execute(array(
        'id' => $id
      ));
    
      $resultat = $stmt->fetchAll();
    
      
      for ($i=0; $i < count($resultat); $i++) { 
        echo "<div class='card no-marging'>";
        echo "<div class='card-component'><div class='card-component-component'><h3 class='card-name'>{$resultat[$i]['name']}</h3>";
        echo "<h3 class='card-year'><em>{$resultat[$i]['year']}</em></h3>";
        echo "<h3 class='card-grapes'>{$resultat[$i]['grapes']}</h3>";
        echo "<h3 class='card-region'>{$resultat[$i]['region']}, {$resultat[$i]['country']}</h3>";
        echo "<h3 class='card-description'>{$resultat[$i]['description']}</h3></div>";
        echo "</div>";
        $picture = (!$resultat[$i]['picture']) ? 'vide' : $resultat[$i]['picture'];
        echo "<div class='card-component'><div class=\"card-picture\" style=\"background-image: url($picture)\"></div></div>";
        echo "</div>";
      }
      ?>


      <form action="./validation_del_article.php" method="post">
          <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
          <input type="submit" value="Supprimer">
      </form>

    </div>
    </div>
    <button><a href="./index.php">Retour à l'accueil</a></button>
    
    <?php } ?>
  </main>


</body>
</html>