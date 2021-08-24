<?php include('./parts/header.php'); ?>


  <form action="./traitement/validation_connexion.php" method="post">
    <h1>Connexion</h1>
    <div class="form-container">
      <label for="id">ID</label>
      <input class="input" type="id" name="id" id="id">
    </div>
    <div class="form-container">
      <label for="email">Email</label>
      <input class="input" type="email" name="email" email="id">
    </div>
    <div class="form-container">
      <label for="mdp">Mot de passe</label>
      <input class="input" type="password" name="mdp" id="mdp">
    </div>
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <input class="btn" type="submit" value="Valider">
  </form>

  
  <?php include('./parts/footer.php'); ?>