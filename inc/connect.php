<?php


 try{
     $bdd = new PDO('mysql:host=localhost;dbname=vehicules;charset=utf8','root',''); 
 }
 catch(Exception $e){  // exception va attraper l'erreur qui se serait produit dans le try et la mettre dans la variable $e
     die('erreur : ' .$e->getMessage()); // die permet d'afficher le message d'erreur stocké
 }

session_start(); //Permet de lancer la création de la session
