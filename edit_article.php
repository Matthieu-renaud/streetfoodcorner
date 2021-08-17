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


  
  $id = htmlspecialchars($_GET['id']);

  $req = new PDO('mysql:host=sql11.freemysqlhosting.net;dbname=sql11416774', 'sql11416774', 'pRSWkI6pSn');
        
  $stmt = $req->prepare("SELECT name, articles.year, grapes, country, region, description, picture FROM articles WHERE id=:id");
  $stmt->execute(array(
    'id' => $id
  ));

  $res = $stmt->fetchAll();

  ?>

    <form action="./validation_edit_article.php" method="post" enctype="multipart/form-data">
      <h1>Ajout d'article</h1>
      <div class="form-container">
        <label for="nom">Nom</label>
        <input class="input" type="text" name="nom" id="nom" value="<?php echo $res[0]['name']; ?>">
      </div>

      <div class="form-container">
        <label for="year" id="year-label">Année</label>
        <input class="input" type="number" name="year" id="year" min="1950" max="<?php echo date('Y') ?>" value="<?php echo $res[0]['year']; ?>">
      </div>

      <div class="form-container">
        <label for="grapes">Cépages</label>
        <input class="input" type="text" name="grapes" id="grapes" value="<?php echo $res[0]['grapes']; ?>">
      </div>

      <div class="form-container">
        <label for="region">Région</label>
        <input class="input" type="text" name="region" id="region" value="<?php echo $res[0]['region']; ?>">
      </div>
      
      <div class="form-container">
        <label for="country">Pays</label>
        <input class="input" type="text" name="country" id="country" value="<?php echo $res[0]['country']; ?>">
      </div>
      
      <div class="form-container">
        <label id="textarea_label" for="description">Description</label>
        <textarea name="description" id="description"><?php echo $res[0]['description']; ?></textarea>
      </div>
      
      <div class="form-container">
        <label for="picture" id="picture-label">Image</label>
        <input class="file" id="picture" name="picture" type="file" accept="image/png, image/jpeg" >
      </div>
      <input type="hidden" name="MAX_FILE_SIZE" value="30000" />

      <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
      <input type="submit" value="Valider">
    </form>

  <?php } ?>
</main>
  
</body>
</html>