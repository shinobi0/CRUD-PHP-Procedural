<?php 

require_once "inc/connect.php"; 
require_once "inc/header.php";

?>


<main>

    <section>
        <div class="header"></div>
    </section>

    <section>
      <h1 class="titreHome">Vous recherchez un véhicule ? </h1>
      <h2 class="sousTitreHome">Faites votre choix, nous avons ce qu'il vous faut ! </h2>
    </section>


    <div class="container m-auto ">
      <div class="row">
          <?php
          // On fait la requête qui va permettre d'afficher la totalité de ce que contient la table 'voiture' que l'on stocke ensuite dans une variable
          $query = $bdd->query('SELECT * FROM voiture');// Lecture de la base de données
          //On parcours le tableau indéxé retourné par la méthode fetch grace à la boucle while
          while ($voiture = $query->fetch(PDO::FETCH_ASSOC)) { 
          

    //On affiche dans un echo le contenu du champs récupéré grâce à son indice
              echo ' <div class="card-deck col-md-4 mb-4">
                      <div class="card" style="width: 18rem;">
                        <img src="'. $voiture['photo'].'" class="card-img-top" alt="...">
                          <div class="card-body">
                            <h5 class="card-title ">Marque : ' . $voiture['marque'].'</h5>
                            <p class="card-text "> Kilométrage : '.$voiture['kilometrage'].' Km</p>
                            <p class="card-text ">Prix : '.$voiture['tarif'].' €</p>
                            <div class="text-center"><a href="details-vehicule.php?id_vehicule='.$voiture['id_voiture'].'" class="btn btn-primary">Découvrir</a></div>
                          </div>
                      </div>
                    </div> ';
              }   
            ?>
      </div>
    </div>

</main>

<?php 
require_once "inc/footer.php";
?>