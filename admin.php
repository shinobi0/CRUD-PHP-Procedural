<?php 
require_once "inc/connect.php"; 

if(!isset($_SESSION['pseudo'])){ //On vérifie que la session 'pseudo' n'existe PAS.
  header('location:authentification.php'); //si elle n'existe pas on redirige vers authentification.php
}

if (!empty($_GET['id_voitureSupp'])) { 
  $idVoiture = htmlspecialchars($_GET['id_voitureSupp']);
  $query = $bdd->prepare('DELETE FROM voiture WHERE id_voiture = ?');
  $query->execute(array($idVoiture));
  
}

if (!empty($_GET['id_voitureModif'])) { 
  $idVoitureModif = htmlspecialchars($_GET['id_voitureModif']);
  $query = $bdd->prepare('SELECT * FROM voiture WHERE id_voiture = ?');
  $query->execute(array($idVoitureModif));

  if (!empty($_POST)){
    $marque = $_POST ['marque']; 
    $kilometrage = $_POST ['kilometrage'];
    $tarif = $_POST ['tarif'];
    $photo = 'assets/img/' .$_FILES['photo']['name']; 
    copy($_FILES['photo']['tmp_name'], $photo);
    $fiche = 'assets/img/' .$_FILES['fiche']['name']; 
    copy($_FILES['fiche']['tmp_name'], $fiche);
    // var_dump($_POST);
    
    $requeteUp = $bdd->prepare('UPDATE voiture SET marque=?, kilometrage=?, tarif=?, photo=?, fiche=? WHERE id_voiture =?') 
    or die (print_r($bdd->errorInfo()));
    $requeteUp->execute(array ($marque, $kilometrage, $tarif, $photo, $fiche, $idVoitureModif));
    header('location:admin.php');
    exit;
    
  }
?>
<h2 class="text-center" id="formulaire" style="margin: 30px;" >Formulaire de modification</h2>
          <div class="container">
            <div class="row">
              <div class="col-md-3"></div>

          <?php $voitureUp = $query->fetch(PDO::FETCH_ASSOC) ?>
              <form class="col-md-6" method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="name">Marque</label>
                      <input type="text" name="marque" class="form-control" id="marque" placeholder="Votre nom" value="<?= $voitureUp['marque']?>">
                    </div>
                    <div class="form-group">
                      <label for="kilometrage">Kilométrage</label>
                      <input type="text" name="kilometrage" class="form-control" id="kilometrage" placeholder="Kilométrage" value="<?= $voitureUp['kilometrage']?>">
                    </div>
                    <div class="form-group">
                      <label for="tarif">Tarif</label>
                      <input type="text" class="form-control" name="tarif" id="tarif" placeholder="Prix de vente" value="<?=$voitureUp['tarif']?>">
                    </div> 
                    <div class="form-group">
                      <label for="photo">Photo</label>
                      <input type="file" class="form-control" name="photo" id="photo" value="">

                      <?php if(isset($voitureUp['photo'])){
            echo '<div>Photo actuelle de la voiture</div>';
            echo '<div><img src="'.$voitureUp['photo'] .'" style="width: 90px"></div>';
            // on affiche la photo actuelle dans le chemin est dans le champ "photo" de la bdd donc dans $produit.
            echo '<input type="hidden" name="photo_actuelle" value="'.$voitureUp['photo'].'">';
            //on crée ce champ caché pour remettre le chemin de la photo actuelle dans le formulaire, donc dans $_POST à l'indice "photo_actuelle". Ainsi on ré-insère ce chemin en BDD lors de la modification.
            }   ?>         
			

                    </div>
                    <div class="form-group">
                      <label for="fiche">Fiche détaillée</label>
                      <input type="file" class="form-control" name="fiche" id="fiche">
                      <?php if(isset($voitureUp['fiche'])){
                        echo '<div>Fiche actuelle de la voiture</div>';
                        echo '<div><img src="'.$voitureUp['fiche'] .'" style="width: 90px"></div>';
                        // on affiche la photo actuelle dans le chemin et dans le champ "photo" de la bdd donc dans $produit.
                        echo '<input type="hidden" name="fiche_actuelle" value="'.$voitureUp['fiche'].'">';
                        //on crée ce champ caché pour remettre le chemin de la photo actuelle dans le formulaire, donc dans $_POST à l'indice "photo_actuelle". Ainsi on ré-insère ce chemin en BDD lors de la modification.
                        }   ?>
                    </div>
                    <div class="form-group">
                      <input class="btn btn-primary" type="submit" value="Modifier">
                    </div>
              </form>
        <div class="col-md-3"></div>
    </div>
</div>
<?php }

require_once "inc/header.php"; 

?>


<div class="container">
      <h1 class="text-center titreContact">Liste des véhicules enregistrés</h1>
</div>

<a href="authentification.php?action=deconnexion">Déconnexion</a><!-- Envoie de paramêtre en GET pour traitement dans la page authentification.php  -->

<div class="container">
  <div class="row mx-auto">

      <?php
      $query = $bdd->query('SELECT * FROM voiture');// Lecture de la BDD
      while ($annonce = $query->fetch(PDO::FETCH_ASSOC)) { ?>
        <div class="card col-md-4 m-3 " style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title"> Marque : <?= $annonce['marque'] ?></h5>
              <h6 class="card-subtitle mb-2"> kilométrage : <?= $annonce['kilometrage']?> km</h6>
              <h6 class="card-subtitle mb-2"> prix : <?= $annonce['tarif']?> €</h6>
              <button type="button" class="btn btn-danger"><a href="admin.php?id_voitureSupp=<?= $annonce['id_voiture'] ?>" class="text-white">Supprimer</a></button>
              <button type="button" class="btn btn-primary"><a href="admin.php?id_voitureModif=<?= $annonce['id_voiture'] ?>" class="text-white">Modifier</a></button>
            </div>
        </div>
      <?php   
      }
      ?>
  </div>
</div>

<?php

require_once "inc/footer.php"; 

?>




 



