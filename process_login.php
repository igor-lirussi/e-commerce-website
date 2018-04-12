<?php

  include 'functions.php';
  include 'connection.php';


  sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
  if(isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    //echo $email;
    $password = $_POST['p']; // Recupero la password criptata.
    if(login($email, $password, $conn) == true) {
      // Login eseguito
      // echo 'Succ"ess: You have been logged in!';
      if($email == "admin@admin.com"){
        header('Location: ./amministra.php');
      } else {
        header('Location: ./menu.php');
      }
      exit;
    } else {
      // Login fallito
      header('Location: ./accedi.php?error=1');
    }
  } else {
   // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
  }
?>
