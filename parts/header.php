<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Street Food Corner</title>
</head>
<body>
<?php
if(!isset($_SESSION['id'])) {
  session_start();
}
?>
<header>
  <nav>
    <ul class="group_menus">
      <li>
        <a href="../pages/index.php">
          <div class="logo" style="background-image : url(../assets/img/logo.png)"></div>
        </a>
      </li>
    </ul>
    <ul class="group_menus">
    <?php 
      if (isset($_SESSION['id'])) {
      echo '<li class="menus btn_deco"><a href="../pages/deconnexion.php">Déconnexion</a></li>';
      } else {
      echo '<li class="menus btn_co"><a href="../pages/connexion.php">Connexion</a></li>';
      }
    ?>
    </ul>
  </nav>
</header>