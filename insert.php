<?php
  include 'functions.php';
  include 'connection.php';

  $query = "SELECT codice FROM listino ORDER BY codice DESC LIMIT 1";
  if($result = $conn->query($query)){
    while($row = $result->fetch_row()){
      echo "<br>ultimo id:".$row[0];
      $codice = $row[0] + 1;
    }
  }
  if ($_FILES['image']) {
    if(is_uploaded_file($_FILES['image']['tmp_name'])) {

      //controllo che il file non superi i 2MB = 2000 KB (1 kilobyte = 1024 byte)
      if($_FILES['image']['size']>2000000) {
        echo "<br>Il file ha dimensioni che superano i 2 MB";
      }

      //recupero le informazioni sull'immagine
      list($width, $height, $type, $attr)=getimagesize($_FILES['image']['tmp_name']);

      //controllo che le dimensioni (in pixel) non superino 800x600
      if(($width>1280) or ($height>720)) {
        echo "<br>Il file non deve superare le dimensioni di 1280x720";
      }

      //controllo che il file sia in uno dei formati GIF, JPG o PNG
      if(($type!=1) and ($type!=2) and ($type!=3)) {
        echo "<br>Il file caricato deve essere un'immagine";
      }


      //controllo che non esiste già un file con lo stesso nome
      if(file_exists('./resources/immaginiCibi/'.$_FILES['image']['name'])) {
        echo "<br>Esiste già un file con lo stesso nome. Rinominare l'immagine prima di caricarla";
      }
      //salvo il file nella cartella di destinazione
      if(!move_uploaded_file($_FILES['image']['tmp_name'], './resources/immaginiCibi/'.$_FILES['image']['name'])) {
        echo "<br>Errore imprevisto nel caricamento del file. Controllare i permessi della cartella di destinazione";
      }

    }
  }
  $immagine = "./resources/immaginiCibi/".$_FILES['image']['name'];
  echo "<br>percorso creato:".$immagine;
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
        echo "<br>Errore: ".$conn->errno;
      }
    }
    header("Location: ./amministra.php");
?>
