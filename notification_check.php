<?php
include 'functions.php';
include 'connection.php';
sec_session_start();
header('Content-Type: application/json');
if(login_check($conn) == true) {  //se loggato
  if(!empty($_SESSION['num_ordine'])){ //se esiste la variabile di sessione relativa all'ordine
      $query2 = "SELECT Completato FROM ordini WHERE NumeroOrdine = ".$_SESSION['num_ordine'];
     if($result2 = $conn->query($query2)){
       $value = $result2->fetch_row();
       if($value[0] == 1){ //se l'ordine è stato consegnato
         echo json_encode(array('status' => 'Delivered'));
         session_unset($_SESSION['num_ordine']);
       } else { //altrimenti non ritorno nulla e la chiamata fallisce
         echo json_encode(array('status' => 'Not delivered'));
       }
     }
  } else {
    echo json_encode(array('status' => 'nessun ordine'));
  } //chiusa graffa dell'if per controllo degli ordini consegnati
} else {
  echo json_encode(array('status' => 'non loggato'));
}
?>
