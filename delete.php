<?php
  include 'functions.php';
  include 'connection.php';

  $codice = $_POST['cod'];
  echo "prodotto ".$codice.".";
  if($query = $conn->prepare("DELETE FROM listino WHERE Codice = ?")){
    $query->bind_param('i', $codice);
    $query->execute();
    $result = $query->get_result();
      if($result){
        echo "Cancellazione andata a buon fine.";
      } else {
        echo "Query non andata a buon fine.";
        echo "Errore: ".$conn->errno;
      }
    } else {
      echo "Connessione non andata a buon fine.";
      echo "Errore: ".$conn->errno;
    }
    header("Location: ./amministra.php");
?>
