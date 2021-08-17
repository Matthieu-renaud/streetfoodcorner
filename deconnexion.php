<?php
include('../parts/header.php');
$_SESSION = array();
session_destroy();
?>

<main>

<div class="success">Vous êtes déconnecté.</div>




  <button><a href="./index.php">Retour à l'accueil</a></button>

</main>


</body>
</html>