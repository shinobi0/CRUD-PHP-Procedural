<?php require_once "inc/connect.php"; 
 require_once "inc/header.php" ;
 

 /* Tout d'abord on vérifie que la valeur existe avec la fonction isset. C'est si 
 et seulement si la valeur existe, c'est à dire que les champs du formulaire ont été rempli et le bouton submit actionné que l'on entre dans la condition. On met dans les parenthèses toutes les données récupérées dans le formulaire au travers du "name" des inputs. Si les valeurs existent TOUTES on entre dans les accolades pour faire le traitement */
if ( isset ($_POST ['marque']) && ($_POST ['kilometrage']) && ($_POST ['tarif']) && ($_FILES['photo']['name']) && ($_FILES['fiche']['name'])){
 
             $marque = htmlspecialchars($_POST ['marque']) ; //On stocke les données récupérées dans des variables (ça n'est pas une obligation, ça fonctionnerait en utilisant directement $_POST ['name'])
             $kilometrage = htmlspecialchars($_POST ['kilometrage']);
             $tarif = htmlspecialchars($_POST ['tarif']);
             $photo = 'assets/img/'.date("mdYHis").$_FILES['photo']['name']; 
             copy($_FILES['photo']['tmp_name'], $photo);
             $fiche = 'assets/img/' .$_FILES['fiche']['name']; 
             copy($_FILES['fiche']['tmp_name'], $fiche);
 
             // 5 types possibles 
             // $_FILES['image']['name'] Nomif
             // $_FILES ['image']['type'] Type
             // $_FILES ['image']['size'] Taille
             // $_FILES ['image']['tmp_name'] Emplacement temporaire
             // $_FILES ['image']['error'] Erreur si oui/non l'image a été réceptionné
             
             //On prépare la requête grâce à la méthode "prepare". Dans les parenthèses on met le début de la requete SQL sans préciser les valeurs à insérer
             $requete = $bdd->prepare('INSERT INTO voiture (marque, kilometrage, tarif, photo, fiche) VALUE (?,?,?,?,?)') 
 
             //Permet de capturer l'erreur et de l'afficher.
             or die (print_r($bdd->errorInfo()));
 
             // c'est avec la méthode execute que l'on précise qu'elles sont les valeurs à insérer dans la base de données
             $requete->execute(array ($marque, $kilometrage, $tarif, $photo, $fiche));
             //On finit par un header location pour faire une redirection après l'action et éviter ainsi de renvoyer plusieurs fois les données en BDD
             header('location:index.php');
         }
?>


<h1 class="text-center mt-5 mb-5" id="formulaire" >Vendez votre voiture</h1>
    <div class="container">
      <div class="row">
        <div class="col-md-3"></div>




<!-- Pour pouvoir envoyer des données en POST il faut renseigner la method avec la valeur "post", la page sur laquelle se passe l'action (à savoir le traitement PHP), et l'enctype qui doit être sur "multipart/form-data" pour pouvoir télécharger des fichiers -->
    <form class="col-md-6" method="post" action="" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="marque">Marque</label>
                  <!-- Pour la récupération des données, on utilise la valeur du name qu'on mettra dans $_POST pour ce champs par exemple ça sera $_POST['name']-->
                  <input type="text" name="marque" class="form-control" id="marque" placeholder="Marque du véhicule">
                </div>
                <div class="form-group">
                  <label for="kilometrage">Kilométrage</label>
                  <input type="text" name="kilometrage" class="form-control" id="kilometrage" placeholder="kilométrage du véhicule">
                </div>
                 <div class="form-group">
                  <label for="tarif">Prix</label>
                  <input type="text" class="form-control" name="tarif" id="age" placeholder="prix du véhicule">
                </div> 
                <div class="form-group">
                  <label for="photo">Photo</label>
                   <input type="file" class="form-control" name="photo" id="photo">
                </div>
                <div class="form-group">
                  <label for="fiche">Fiche détaillée</label>
                   <input type="file" class="form-control" name="fiche" id="fiche">
                </div>
                <div class="form-group">
                  <!-- Il faut aussi mettre un bouton ou input de type "submit" -->
                  <input class="btn btn-primary" type="submit" value="Envoyer">
                </div>
          </form>
        <div class="col-md-3"></div>
      </div>
    </div>


<?php 
require_once "inc/footer.php";
?>