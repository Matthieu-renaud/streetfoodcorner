<?php include('../parts/header.php'); ?>


<main>

  <form action="../traitement/validation_ajout_user.php" method="post">
    <h1>Inscription</h1>
    <div class="form-container">
      <label for="id">ID</label>
      <input class="input" type="text" name="id" id="id">
    </div>
    <div class="form-container">
      <label for="mdp">Mot de passe</label>
      <input class="input" type="password" name="mdp" id="mdp">
    </div>
    <div class="form-container">
      <label for="confmdp">Confirmez votre mot de passe</label>
      <input class="input" type="password" name="confmdp" id="confmdp">
    </div>
    <div class="form-container">
      <label for="email">Email</label>
      <input class="input" type="email" name="email" id="email">
    </div>
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <input class="btn" type="submit" value="Valider">
  </form>

</main>

</body>

</html>