<?php include('../parts/header.php'); ?>


  

<main>
  
  <?php

  $errors[] = array();

  $id = htmlspecialchars(strip_tags($_POST['id']));
  $email = htmlspecialchars(strip_tags($_POST['email']));
  $mdp = htmlspecialchars($_POST['mdp']);

  if(strlen($id)>4 && strlen($mdp)>6) {
      
    include('../parts/db_connect.php');
    $sth = $req->prepare('SELECT mdp, email FROM users WHERE identifiant=:id');
    
    $sth->execute(array(
      'id' => $id
    ));

    $result = $sth->fetchAll();

    if (!empty($result)){
    if (password_verify($mdp,$result[0]['mdp']) && $email == $result[0]['email']) {
      if(!isset($_SESSION)) 
      { 
        session_start();
      }
      $_SESSION['id'] = $id;
      echo "<h2 class=\"success\">Bonjour ".$_SESSION['id']."</h2>";
    } else {
      $errors[0]=1;
    }
  } else {
    $errors[0]=1;
  }


    
  } else {
    $errors[0]=1;
    // foreach ($errors[$i] as $key => $value) {
    //   if ($key==1 && $value==1) {
    //     echo "<h2 class=\"error\">Erreur sur l'identifiant ou le mot de passe</h2>";
    //   }
    // }
    if ($errors[0]) {
      echo "<h2 class=\"error\">Erreur sur l'identifiant, le mot de passe ou l'email</h2>";
    }
  }

  ?>
      
  <button><a href="../pages/index.php">Retour à l'accueil</a></button>

</main>

</body>
</html>