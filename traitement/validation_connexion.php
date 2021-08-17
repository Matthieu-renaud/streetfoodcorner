<?php include('../parts/header.php'); ?>


  

<main>
  
  <?php
  $errors = [];

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
        $errors['user']="Erreur sur l'identifiant, l'email ou le mot de passe";
      }
    } else {
      $errors['user']="Erreur sur l'identifiant, l'email ou le mot de passe";
    }


    
  } else {
    $errors['user']="Erreur sur l'identifiant, l'email ou le mot de passe";
    if(!empty($errors)) {
      foreach ($errors as $error) {
        echo "<h3 class=\"error\">$error</h3>";
      }
    }
  }

  ?>
      
  <button><a href="../pages/index.php">Retour à l'accueil</a></button>

</main>

<?php include("../parts/footer.php"); ?>

