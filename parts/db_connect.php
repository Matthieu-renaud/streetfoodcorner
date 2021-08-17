<?php
/* Connexion à une base MySQL avec l'invocation de pilote */
$dsn = 'mysql:dbname=streetfoodcorner;host=127.0.0.1';
$user = 'root';
$password = '';

try {
  $req = new PDO($dsn, $user, $password);
  $req->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  print "Erreur !: " . $e->getMessage() . "<br/>";
  die();
}

?>
