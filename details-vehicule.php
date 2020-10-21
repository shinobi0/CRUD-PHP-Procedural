<?php 
require_once "inc/connect.php"; 
require_once "inc/header.php";
?>



<div class="container">
        <h1 class="titreProfil">Votre véhicule en détails</h1>
</div>

<?php

if (isset($_GET['id_vehicule'])) {
    $idVehicule = htmlspecialchars($_GET['id_vehicule']);
    $query = $bdd->prepare("SELECT * FROM voiture WHERE id_voiture = ?");
    $query->execute(array($idVehicule));
    // var_dump($idVehicule);


?>

<div class="container">
  <div class="row mx-auto">
        <?php
            $voitureDetails = $query->fetch(PDO::FETCH_ASSOC);
                // var_dump($vtcDetail);
                echo'
                <div class="card mb-3 m-auto">
                    <img src="'. $voitureDetails['photo'].'" class="card-img-top" alt="photo">
                        <div class="card-body">
                            <h5 class="card-title">Notre véhicule en détails</h5>
                            <p class="card-text">Marque du véhicule : '. $voitureDetails['marque'].'</p>
                            <p class="card-text">Kilométrage : '.  $voitureDetails['kilometrage'].' km</p>
                            <p class="card-text">Prix de vente : '. $voitureDetails['tarif'].' €</p>
                            <div class="d-flex justify-content-around">
                                <a class="btn btn-primary " href="contact.php">Faire une offre</a>
                                <a class="btn btn-primary " href="download.php?id_vehicule='.$voitureDetails['id_voiture'].'">Télécharger la fiche détailée</a>
                            </div>
                        </div>
                </div>';
        }
        ?>
    </div>
</div>
    

<?php 
require_once "inc/footer.php";
?>


