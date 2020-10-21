<?php 

require_once "inc/connect.php"; 
require_once "inc/header.php" ;



if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') { //on vérifie que action existe et qu'il est égal à "deconnexion"
  unset($_SESSION['pseudo']); //on détruit la session avec la fonction unset
  header('location:authentification.php');//on redirige ensuite vers la page de connexion
  exit();
}


//Identifiant : titi
//Mot de passe :tata 

if(!empty($_POST['pseudo']) && !empty($_POST['password'])){

	$pseudo = htmlspecialchars($_POST['pseudo']);
	$password = sha1($_POST['password']); // Mot de passe hashé en sha1 : 90795a0ffaa8b88c0e250546d8439bc9c31e5a5e
	$error = 1;//On initialise error à 1 pour pouvoir afficher un message d'erreur en cas d'erreur à la connexion (mauvais password ou pseudo)

	$query = $bdd->prepare('SELECT * FROM users WHERE pseudo=?');// requête qui permet de récupérer l'entrée correspondant au pseudo saisi par l'internaute
	$query->execute(array($pseudo));

	while($admin=$query->fetch()){

		if($password == $admin['mdp'] && $pseudo == $admin['pseudo']){// comparaison entre le pseudo et mdp récupéré dans le formulaire et ceux stockés en base de données
			$error = 0;// on passe l'error à 0 car tout s'est bien passé
			$_SESSION['pseudo']=$pseudo; // on stock le pseudo dans la variable $_SESSION
			//var_dump($_SESSION['pseudo']);
			header('location:admin.php');// on redirige vers la page admin

		}
	}

	if($error==1){
		header('location:authentification.php?error=1');//Puisque nous ne sommes pas rentrée dans le 1ère condition c'est qu'il y a une erreur donc on envoie en GET une variable error qui servira à afficher un message d'erreur.
	} 
}


 ?>


<h1 class="titreConnexion">Identifiez-vous</h1>

<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
			<div class="col-md-6">
				<?php 
				if (isset($_GET['error']) && ($_GET['error']== 1 )){
					echo '<div class="alert alert-danger" role="alert">
							Nous n\'avons pas pu vous identifier !
							</div>';
				} 
				?>
				<form class="formConnexion" method="POST" action="">
				  <div class="form-group">
				    <label for="pseudo">identifiant</label>
				    <input type="text" class="form-control" name="pseudo" id="pseudo" aria-describedby="emailHelp" required>
				  </div>
				  <div class="form-group">
				    <label for="password">Password</label>
				    <input type="password" class="form-control" id="password" name="password" required>
				  </div>
				  <button type="submit" class="btn btn-primary">Connexion</button>
				</form>
			</div>
		<div class="col-md-3"></div>
	</div>
</div>

 <?php 
require_once "inc/footer.php";
?>