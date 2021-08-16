<?php
/* Connexion à une base MySQL avec l'invocation de pilote */
$dsn = 'mysql:dbname=streetfoodcorner;host=127.0.0.1';
$user = 'root';
$password = '';

$dbh = new PDO($dsn, $user, $password);

?>