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

  <div class="alert-container">
  <?php

$id = $_POST['id'];

$nom = htmlspecialchars($_POST['nom']);
$nomLen = strlen($nom);
$nomBool= false;
if (strlen($nom)<=4) {
  echo "<h3 class=\"error\">Le nom est trop court : $nomLen caractères(s)</h3>";
} else {
  $nomBool = true;
  echo "<h3 class=\"success\">Le nom est valide</h3>";
}

$year = htmlspecialchars($_POST['year']);
$yearBool= false;
if ($year<1950) {
  echo "<h3 class=\"error\">L'année est invalide";
} else {
  $yearBool = true;
  echo "<h3 class=\"success\">L'année est valide</h3>";
}

$grapes = htmlspecialchars($_POST['grapes']);
$grapesLen = strlen($grapes);
$grapesBool= false;
if (strlen($grapes)<=4) {
  echo "<h3 class=\"error\">Le cépage est trop court : $grapesLen caractères(s)</h3>";
} else {
  $grapesBool = true;
  echo "<h3 class=\"success\">Le cépage est valide</h3>";
}

$region = htmlspecialchars($_POST['region']);
$regionLen = strlen($region);
$regionBool= false;
if (strlen($region)<=4) {
  echo "<h3 class=\"error\">La région n'est pas valide</h3>";
} else {
  $regionBool = true;
  echo "<h3 class=\"success\">La région est valide</h3>";
}

$country = htmlspecialchars($_POST['country']);
$countryLen = strlen($country);
$countryBool= false;
if (strlen($country)<=3) {
  echo "<h3 class=\"error\">Le pays est trop court : $countryLen caractères(s)</h3>";
} else {
  $countryBool = true;
  echo "<h3 class=\"success\">Le pays est valide</h3>";
}

$description = htmlspecialchars($_POST['description']);
$descriptionLen = strlen($description);
$descriptionBool= false;
if (strlen($description)<=0) {
  echo "<h3 class=\"error\">La description est trop courte : $descriptionLen caractères(s)</h3>";
} else {
  $descriptionBool = true;
  echo "<h3 class=\"success\">La description est valide</h3>";
}



function string2url($chaine) { 
  $chaine = trim($chaine); 
  $chaine = strtr($chaine, 
  "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ", 
  "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn"); 
  $chaine = lcfirst(ucwords($chaine));
  $chaine = preg_replace('#([^.a-z0-9]+)#i', '', $chaine); 
          $chaine = preg_replace('#-{2,}#','',$chaine); 
          $chaine = preg_replace('#-$#','',$chaine); 
          $chaine = preg_replace('#^-#','',$chaine); 
  return $chaine; 
}

$fileBool = 0;
$uploaddir = 'assets/img/bottles/';
if(!file_exists($uploaddir))    
  mkdir($uploaddir);
$uploadfile = $uploaddir . basename(string2url($_FILES['picture']['name']));

if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile)) {
  echo "<h3 class=\"success\">L'image est valide</h3>";
  $fileBool = 1;
} else if ($_FILES['picture']['error']==4){
  echo "<h3 class=\"success\">Aucune image renseignée</h3>";
  $fileBool = 2;
} else if ($_FILES['picture']['error']==1){
  echo "<h3 class=\"error\">L'image est trop lourde</h3>";
} else {
  echo "<h3 class=\"error\">L'image n'a pas été téléchargée</h3>";
}

$req = new PDO('mysql:host=sql11.freemysqlhosting.net;dbname=sql11416774', 'sql11416774', 'pRSWkI6pSn');

if($nomBool && $yearBool && $grapesBool && $regionBool && $countryBool && $descriptionBool && $fileBool == 1) {
  echo "<h2 class=\"success\">Tous les champs sont valides</h2>";
  
  $sth = $req->prepare('UPDATE articles SET name = :nom, year = :annee, grapes = :grapes, country = :country, region = :region, description = :description, picture = :picture WHERE id = :id');
  
  $sth->execute(array(
    'nom' => strip_tags($nom),
    'annee' => strip_tags($year),
    'grapes' => strip_tags($grapes),
    'country' => strip_tags($country),
    'region' => strip_tags($region),
    'description' => strip_tags($description),
    'picture' => $uploadfile,
    'id' => $id
  ));

} elseif($nomBool && $yearBool && $grapesBool && $regionBool && $countryBool && $descriptionBool && $fileBool == 2) {
  echo "<h2 class=\"success\">Tous les champs sont valides</h2>";
  

  // $req = new PDO('mysql:host=sql11.freemysqlhosting.net;dbname=sql11416774', 'sql11416774', 'pRSWkI6pSn');
  $cmd = $req->prepare('UPDATE articles SET name = :nom, year = :annee, grapes = :grapes, country = :country, region = :region, description = :description WHERE id = :id');
  
  $cmd->execute(array(
    'nom' => strip_tags($nom),
    'annee' => strip_tags($year),
    'grapes' => strip_tags($grapes),
    'country' => strip_tags($country),
    'region' => strip_tags($region),
    'description' => strip_tags($description),
    'id' => $id
  ));

} else {
  echo "<h2 class=\"error\">Tous les champs ne sont pas valides</h2>";
}

?>
  </div>
  <button><a href="./aff_article.php">Retour à la liste</a></button>
  
  <?php } ?>
</main>

</body>
</html>