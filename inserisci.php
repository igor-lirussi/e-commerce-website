<?php
  include 'functions.php';
  include 'connection.php';
  echo  $_POST['nomeInserito'];
  echo  $_POST['categInserita'];
  echo  $_POST['descInserita'];
  echo  $_POST['prezzoInserito'];
  $query = "INSERT INTO listino('Codice', 'Nome', 'Categoria', 'Descrizione', 'Prezzo', 'Immagine') VALUES (10, $_POST['nomeInserito'], $_POST['categInserita'], $_POST['descInserita'], $_POST['prezzoInserito'], './resources/immaginiCibi/')";
    if($result = $conn->query($query)){
      echo "Inserimento andato a buon fine.";
    }
?>
