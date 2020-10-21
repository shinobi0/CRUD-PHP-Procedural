<?php
require_once "inc/connect.php"; 


if (isset($_GET['id_vehicule'])) {

$idVehicule = htmlspecialchars($_GET['id_vehicule']);// on ne fait pas confiance aux données
$query = $bdd->prepare("SELECT * FROM voiture WHERE id_voiture = ?");
$query->execute(array($idVehicule));

$fiche = $query->fetch(PDO::FETCH_ASSOC);
$ficheDownload = $fiche['fiche'];

// header ('Content-Type: application/octet-stream');
header ('Content-Type: application/pdf');
header('Content-transfer-Encoding: Binary');
// header('Content-Disposition: attachment; filename="'.$ficheDownload.' " ');
header("Content-Disposition: attachment; filename=\"" . basename($ficheDownload) . "\"");

readfile($ficheDownload);

}