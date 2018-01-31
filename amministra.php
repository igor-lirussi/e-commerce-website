<!DOCTYPE html>
<html lang="it">

  <head>
  </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
    <script>
      // function insert() {
      //   <?php
      //     header("Location: ./inserisci.php?codice=".$indice."&nome=".$nome."&cat=".$cat."&desc=".$desc."&perzzo=".$prezzo."&path=".$pathimg);
      //   ?>
      }
    </script>
    <title>SitoCibo</title>
    <link rel="icon" href="resources/favicon.ico" />
  </head>

  <body>
    <?php
      include 'functions.php';
      include 'connection.php';
      sec_session_start();
      if(login_check($conn) == true) {
     ?>
    <header>
      <a href="home.html">
      <h1>Yook!</h1>
      </a>
      <h2>Amministra menù</h2>
    </header>

    <!-- <h3>Cerca</h3>
    <form class="searchform" action="menu.php" onsubmit="return displayFunction()" method="post">
      <input type="search" name="search" value="" placeholder="Inserisci ricerca qui..">
      <input type="submit">
    </form>
    <div class="searchresult"> --> <!-- DA SPOSATRE TUTTO QUESTO DIV IN UNO SCRIPT CHE SI VISUALIZZA SOLO SE E' STATO PREMUTO IL PULSANTE DELLA RICERCA -->
      <?php
        // if($query = $conn->prepare("SELECT * FROM listino WHERE Nome LIKE '%'?'%'")){ //NON FUNZIONA PER VIA DI SBAGLIATA COMBINAZIONE DI % E ?
        //   $search = $_POST["search"];
        //   $query->bind_param('s', $search);
        //   $query->execute();
        //   echo "after execute";
        //   $result = $query->get_result();
        //   echo "before while";
        //   while($row = $result->fetch_assoc()){
        //     echo "ciao";
        //     echo "<p>".$row[1]."</p>";
        //     echo "<p>".$row[3]."</p>";
        //     echo "<p>".$row[4]."€</p>";
        //   }
        //   echo $row. "  ";
        //   echo "after while";
        // } else {
        //   echo "Query non andata a buon fine";
        // }
      ?>
    <!-- </div> -->

    <div class="row listino">
      <div class="col-4 pastiVeloci">
        <h3>Pasti Veloci</h3>
        <?php
          $query = "SELECT * FROM listino WHERE listino.Categoria ='Pasti Veloci'";
          if($result = $conn->query($query)){
            while($row = $result->fetch_row()){
              echo "<div class = 'offert fast'>";
              echo "<div class = 'row'>";
              echo "<div class = 'col-4'>";
              echo    "<img src = '".$row[5]."'>";
              echo "</div>";
              echo "<div class = 'col-8 desc'>";
              echo    "<p>".$row[1]."</p>";
              echo    "<p>".$row[3]."</p>";
              echo    "<p>".$row[4]."€</p>";
                    echo "</div>";
              echo "</div>";
              echo "</div>";
            }
            echo "<div class = 'offert fast'>";
            echo "<div class = 'row'>";
            echo "<div class = 'col-4'>";

            //caricamento di immagine
            echo "<form action='' method='post' enctype='multipart/form-data'>
            	       <input name='image' type='file' value = 'Inserisci immagine'>
            	       <input name='invia' type='submit' value='Carica immagine'>
                  </form>";
            if(is_uploaded_file($_FILES['image']['tmp_name'])) {

            	//controllo che il file non superi i 100 KB (1 kilobyte = 1024 byte)
            	if($_FILES['image']['size']>250000)
            		$messaggio.="Il file ha dimensioni che superano i 2 MB<br />";

            	//recupero le informazioni sull'immagine
            	list($width, $height, $type, $attr)=getimagesize($_FILES['image']['tmp_name']);

            	//controllo che le dimensioni (in pixel) non superino 800x600
            	if(($width>1280) or ($height>720))
            		$messaggio.="Il file non deve superare le dimensioni di 1280x720<br />";

            	//controllo che il file sia in uno dei formati GIF, JPG o PNG
            	if(($type!=1) and ($type!=2) and ($type!=3))
            		$messaggio.="Il file caricato deve essere un'immagine<br />";


            	//controllo che non esiste già un file con lo stesso nome
            	if(file_exists('./resources/immaginiCibi/'.$_FILES['image']['name']))
            		$messaggio.="Esiste già un file con lo stesso nome. Rinominare l'immagine prima di caricarla<br />";

            	//salvo il file nella cartella di destinazione
            	if(!move_uploaded_file($_FILES['image']['tmp_name'], './resources/immaginiCibi/'.$_FILES['image']['name']))
            		$messaggio.="Errore imprevisto nel caricamento del file. Controllare i permessi della cartella di destinazione";

            }
            //recupero immagine
            echo    "<img src = './resources/immaginiCibi/".$_FILES['image']['name']."'>";
            $pathimg = "./resources/immaginiCibi/".$_FILES['image']['name'];
            echo "</div>";
            echo "<div class = 'col-8 desc'>";
            echo    "<form action='inserisci.php' method='POST'>";
            echo "<input type = 'text' name = 'nomeInserito' placeholder = 'Inserisci nome prodotto'>";
            echo    "<input type = 'text' name = 'categInserita' placeholder = 'Inserisci categoria prodotto'>";
            echo      "<textarea rows='4' cols='50' name = 'descInserita' placeholder = 'Inserisci descrizione prodotto'></textarea>";
            echo      "<input type = 'number' name = 'prezzoInserito' placeholder = 'Inserisci prezzo prodotto'>€";
            echo    "<input type='submit' value='Aggiungi prodotto'></form>";
                  echo "</div>";
            echo "</div>";
            echo "</div>";
          } else {
            echo "Nessun dato trovato";
          }
          echo $row[0];
          $indice=$row[0]++;
          echo $indice;
          echo $pathimg;
          $nome=$_POST['nomeInserito'];
          $cat=$_POST['categInserita'];
          $desc=$_POST['descInserita'];
          $prezzo=$_POST['prezzoInserito'];
        ?>
      </div>

      <div class="col-4 primi">
        <h3>Primi</h3>
        <?php
          $query = "SELECT * FROM listino WHERE listino.Categoria ='Primi'";
          if($result = $conn->query($query)){
            while($row = $result->fetch_row()){
              echo "<div class = 'offert meal'>";
              echo "<div class = 'row'>";
              echo "<div class = 'col-4'>";
              echo    "<img src = '".$row[5]."'>";
              echo "</div>";
              echo "<div class = 'col-8 desc'>";
              echo    "<p>".$row[1]."</p>";
              echo    "<p>".$row[3]."</p>";
              echo    "<p>".$row[4]."€</p>";
              echo "</div>";
              echo "</div>";
              echo "</div>";
            }
          } else {
            echo "Nessun dato trovato";
          }
        ?>
      </div>

      <div class="col-4 bevande">
        <h3>Bevande</h3>
        <?php
          $query = "SELECT * FROM listino WHERE listino.Categoria ='Bevande'";
          if($result = $conn->query($query)){
            while($row = $result->fetch_row()){
              echo "<div class = 'offert drink'>";
              echo  "<div class = 'row'>";
              echo    "<div class = 'col-4'>";
              echo      "<img src = '".$row[5]."'>";
              echo    "</div>";
              echo    "<div class = 'col-8 desc'>";
              echo      "<p>".$row[1]."</p>";
              echo      "<p>".$row[3]."</p>";
              echo      "<p>".$row[4]."€</p>";
              echo    "</div>";
              echo  "</div>";
              echo "</div>";
            }
          } else {
            echo "Nessun dato trovato";
          }
        $conn->close();
      } else {
         echo 'You are not authorized to access this page, please login. <br/>';
      }
        ?>
      </div>
    </div>
    <form class="" action="menu.php" method="post">
      <input type="submit" name="sm" value="Salva modifiche e torna al menù">
    </form>
  </body>
</html>
