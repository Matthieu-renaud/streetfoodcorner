<?php include('../parts/header.php'); ?>


<main>
  

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

    $email = htmlspecialchars($_POST['email']);
    $emailBool= false;
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
      echo "<h3 class=\"success\">L'email est valide</h3>";
      $emailBool = true;
    } else {
      echo "<h3 class=\"error\">L'email est invalide</h3>";
    }





    if($idBool && $mdpBool && $confmdpBool && $emailBool ) {
      echo "<h2 class=\"success\">Tous les champs sont valides</h2>";
      $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);
      
      include('../parts/db_connect.php');
      $sth = $req->prepare('INSERT INTO users (identifiant, mdp, email) VALUES(:id, :pwd, :email)');
      
      $sth->execute(array(
        'id' => strip_tags($id),
        'pwd' => strip_tags($mdpHash),
        'email' => strip_tags($email)
      ));
      
    } else {
      echo "<h2 class=\"error\">Tous les champs ne sont pas valides</h2>";
    }

    ?>
  </div>
  <button><a href="../pages/ajout_user.php">Retour au formulaire</a></button>
  
</main>


</body>
</html>
