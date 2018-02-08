<?php
  include 'functions.php';
  include 'connection.php';

  $query = "SELECT codice FROM listino ORDER BY codice DESC LIMIT 1";
  if($result = $conn->query($query)){
    while($row = $result->fetch_row()){
      echo $row[0];
      $codice = $row[0] + 1;
    }
  }

  $immagine = $_POST['img'];
  $nome = $_POST['nomeInserito'];
  $cat = $_POST['categInserita'];
  $desc = $_POST['descInserita'];
  $prezzo = $_POST['prezzoInserito'];
  if($query = $conn->prepare("INSERT INTO listino (Codice, Nome, Categoria, Descrizione, Prezzo, Immagine) VALUES (?, ?, ?, ?, ?, ?)")){
    $query->bind_param('isssds', $codice, $nome, $cat, $desc, $prezzo, $immagine);
    $query->execute();
    $result = $query->get_result();
      if($result){
        echo "Inserimento andato a buon fine.";
      } else {
        echo "Query non andata a buon fine.";
        echo $conn->errno;
      }
    }
    header("Location: ./amministra.php");
?>
