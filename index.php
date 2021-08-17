<?php include('./parts/header.php'); ?>

  <main>

    <section class="intro">

      <div>
        <div class="titre">STREET FOOD CORNER</div>
        <div class="texte">Bienvenue sur le site du Street Food Corner, vous pouvez naviguez pour regarder les produits que nous proposons.</div>
        <div class="bouton">Voir les produits</div>
      </div>
      
      <div class="img_intro"></div>

    </section>

    <section class="plats">
      
    </section>

    <section class="formule">
      
    </section>

    <section class="card-container">

      <?php
      
      include('./parts/db_connect.php');
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