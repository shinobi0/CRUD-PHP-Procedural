<?php require_once "inc/connect.php"; 
 require_once "inc/header.php" 

?>


<div class="container">
    <h1 class="titreContact mb-5">Faites votre offre</h1>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-3"></div>

      <form class="col-md-6 mb-5" method="post" action="">
        <div class="form-group">
          <label for="exampleFormControlInput1">Votre email</label>
          <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="nom@example.com">
        </div>
        <div class="form-group">
          <label for="exampleFormControlSelect1">Objet</label>
          <select class="form-control" name="subject" id="exampleFormControlSelect1">
            <option>Demande de renseignement</option>
            <option>Offre de prix</option>
            <option>Autres</option>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Dites-nous tout :</label>
          <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="5"></textarea>
        </div>
        <div class="form-group">
          <input class="btn btn-primary" type="submit" value="Envoyer">
        </div>
      </form>

<div class="col-md-3"></div>

</div>
</div>

<?php 
$errors = '';
$myemail = 'salma.felouki@lepoles.com';
if(empty($_POST['subject'])  || empty($_POST['email']) || empty($_POST['message'])){
    $errors .= "\n Error: tous les champs sont requis";
}

if ( isset ($_POST['subject']) && ($_POST ['email']) && ($_POST ['message'])){

    $subject = $_POST['subject']; 
    $email_address = $_POST['email']; 
    $message = $_POST['message']; 
    if (!preg_match(
    "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", 
    $email_address)){
    $errors .= "\n Error: Adresse email invalide";
    }

    if(empty($errors)){
      $to = $myemail; 
      $email_subject = "Contact form submission: $subject";
      // $email_body = "You have received a new message. ".
      // " Here are the details:\n Name: $name \n Email: $email_address \n Message \n $message"; 
      $email_body = "You have received a new message. ".
      " Here are the details: \n Email: $email_address \n Message \n $message"; 
      
      $headers = "From: $myemail\n"; 
      $headers .= "Reply-To: $email_address";
      
      // mail($to,$email_subject,$email_body,$headers);
      mail($to,$email_subject, $email_body, $headers);
      //redirect to the 'thank you' page
      // header('Location: contact-form-thank-you.html');
    } 

}//fin du isset



require_once "inc/footer.php";
?>