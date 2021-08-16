<?php

include('/parts/header.php');
session_start();

?>

  <main>

    <div class="info">Bonjour 
    <?php
      if(isset($_SESSION['id']))
      echo $_SESSION['id'];
    ?>
    <br>Bienvenue sur MyCave,<br> Un site créé par un expert en œnologie afin de réferencer uniquement la crème de la crème du vin.</div>

    <br><br>

    <div class="info info-bottle">
      <h2>Dernière bouteille ajoutée</h2>
    </div>

    <section class="card-container">

      <?php
      
      $req = new PDO('mysql:host=sql11.freemysqlhosting.net;dbname=sql11416774', 'sql11416774', 'pRSWkI6pSn');
      
      $stmt = $req->prepare("SELECT articles.id, articles.name, articles.year, articles.grapes, articles.country, articles.region, articles.description, articles.picture FROM articles ORDER BY date_creation DESC LIMIT 1");
      $stmt->execute();
      
      $resultat = $stmt->fetchAll();
      
      for ($i=0; $i < count($resultat); $i++) { 
        echo "<div class='card'>";
        echo "<div class='card-component'><div class='card-component-component'><h3 class='card-name'>{$resultat[$i]['name']}</h3>";
        echo "<h3 class='card-year'><em>{$resultat[$i]['year']}</em></h3>";
        echo "<h3 class='card-grapes'>{$resultat[$i]['grapes']}</h3>";
        echo "<h3 class='card-region'>{$resultat[$i]['region']}, {$resultat[$i]['country']}</h3>";
        echo "<h3 class='card-description'>{$resultat[$i]['description']}</h3></div>";
        if(isset($_SESSION['id'])) {
        echo "<div class='card-component-component'><div class=\"modif\"><button id=\"modif{.$i}\"><a href=\"./edit_article.php?id={$resultat[$i]['id']}\">Modifier</a></button></div>";
        echo "<div class=\"suppr\"><button id=\"suppr{.$i}\"><a href=\"./del_article.php?id={$resultat[$i]['id']}\">Supprimer</a></button></div></div>";
        }
        echo "</div>";
        $picture = (!$resultat[$i]['picture']) ? 'vide' : $resultat[$i]['picture'];
        echo "<div class='card-component'><div class=\"card-picture\" style=\"background-image: url($picture)\"></div></div>";
        echo "</div>";
      }
      

      ?>

    </section>


  </main>

<?php

include('/parts/footer.php');

?>