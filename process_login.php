<?php

  include 'functions.php';

  $servername = "localhost";
  $username = "sec_user";
  $password = "gtTsfOlrsGRi";
  $dbname = "databasesito";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


  sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
  echo "email: ".$_POST['email'];
  if(isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    echo $email;
    $password = $_POST['p']; // Recupero la password criptata.
    if(login($email, $password, $conn) == true) {
      // Login eseguito
      echo 'Success: You have been logged in!';
    } else {
      // Login fallito
      header('Location: ./login.php?error=1');
    }
  } else {
   // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
  }
?>
