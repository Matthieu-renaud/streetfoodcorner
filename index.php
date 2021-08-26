<?php include('./parts/header.php');
include('./parts/db_connect.php'); ?>

  <main>

    <section class="intro">

      <div class="intro-container">
        <div class="titre">STREET FOOD CORNER</div>
        <div class="texte">Bienvenue sur le site du Street Food Corner, vous pouvez naviguez pour regarder les produits que nous proposons.</div>
        <div class="btn"><a href="./carte.php">Voir les produits</a></div>
      </div>
      
      <div class="intro-img"></div>

    </section>

    <section class="plats">

    <?php
      
      $stmt = $req->prepare("SELECT a.id_article, a.name, i.filename, i.id_image FROM articles AS a INNER JOIN articles_images AS ai ON a.id_article = ai.id_article INNER JOIN images AS i ON ai.id_image = i.id_image INNER JOIN category AS c ON a.id_cat = c.id_cat WHERE a.active = '1' AND a.hors_formule = '1' AND c.name = 'plats' ORDER BY a.id_article");
      $stmt->execute();
      
      $resultat = $stmt->fetchAll();

      
      if(!count($resultat)) {
        echo "Aucun resultat";
      } else {
        for ($i=0; $i < count($resultat); $i++) { 
          echo "<div class='plat-card' style=\"background-image: linear-gradient(0deg, rgba(0,0,0,0.65) 0%, rgba(0,0,0,0) 100%), url(./assets/img/{$resultat[$i]['filename']}\">";
          echo "<div class='card-id_".$i."'><h3 class='plat-name'>{$resultat[$i]['name']}</h3>";
          // echo "<h3 class='card-prix'><em>{$resultat[$i]['prix']}€</em></h3>";
          // echo "<h3 class='card-description'>{$resultat[$i]['description']}</h3></div>";
          // if(isset($_SESSION['id'])) {
          // echo "<div class='card-component-component'><div class=\"modif\"><button id=\"modif{.$i}\"><a href=\"./edit_article.php?id={$resultat[$i]['id_article']}\"><i class=\"fas fa-edit\"></i></a></button></div>";
          // echo "<div class=\"suppr\"><button id=\"suppr{.$i}\"><a href=\"./del_article.php?id={$resultat[$i]['id_article']}\"><i class=\"fas fa-trash-alt\"></i></a></button></div></div>";
          // }
          echo "</div></div>";
        }
    }
      

      ?>
      
    </section>

    <section class="formule">


      
    </section>

    <section class="card-container">

      <?php
      
      $stmt = $req->prepare("SELECT articles.id_article, articles.name, articles.description, articles.prix, images.filename FROM articles INNER JOIN images WHERE articles.id_image = images.id_image AND articles.active = '1' AND articles.hors_formule = '1' ORDER BY articles.id_cat");
      $stmt->execute();
      
      $resultat = $stmt->fetchAll();

      
      if(!count($resultat)) {
        echo "Aucun resultat";
      } else {
        for ($i=0; $i < count($resultat); $i++) { 
          echo "<div class='card'>";
          echo "<div class='card-component'><div class='card-component-component'><h3 class='card-name'>{$resultat[$i]['name']}</h3>";
          echo "<h3 class='card-prix'><em>{$resultat[$i]['prix']}€</em></h3>";
          echo "<h3 class='card-description'>{$resultat[$i]['description']}</h3></div>";
          if(isset($_SESSION['id'])) {
          echo "<div class='card-component-component'><div class=\"modif\"><button id=\"modif{.$i}\"><a href=\"./edit_article.php?id={$resultat[$i]['id_article']}\"><i class=\"fas fa-edit\"></i></a></button></div>";
          echo "<div class=\"suppr\"><button id=\"suppr{.$i}\"><a href=\"./del_article.php?id={$resultat[$i]['id_article']}\"><i class=\"fas fa-trash-alt\"></i></a></button></div></div>";
          }
          echo "</div>";
          echo "<div class='card-component'><div class=\"card-picture\" style=\"background-image: url(./assets/img/{$resultat[$i]['filename']}\"></div></div>";
          echo "</div>";
        }
    }
      

      ?>

    </section>


  </main>

<?php

include('./parts/footer.php');

?>