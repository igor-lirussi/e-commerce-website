<!DOCTYPE html>
<html lang="it">

  <head>
    <meta charset="utf-8">
    <title>Yook</title>
    <link rel="icon" href="resources/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
    <!-- per barra progressi -->
    <link rel="stylesheet" type="text/css" title="stylesheet" href="./css/progress.css">
    <!-- per il popup modal -->
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/modal.css">
    <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
    <script src="js/modal.js"></script>
  </head>

  <body>
    <!-- popup modal -->
    <!-- va messo nel body come figlio diretto, tutto gli altri figli verranno sfocati -->
    <div class="modal-wrapper">
      <div class="modal">
        <div class="head">
          Wow! <i class="fas fa-child"></i>
          <a class="btn-close trigger" href="#">
            <i class="fas fa-times" aria-hidden="true"></i>
          </a>
        </div>
        <div class="content">
            <div id="good-job"><?php
              if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
                if(true) {  //sempre
                  echo '<i class="fas fa-exclamation-triangle"></i> <h1>Aggiunto!<br/></h1>';

                }
              }
            ?></div>
        </div>
      </div>
    </div>


    <?php
      include 'functions.php';
      include 'connection.php';
      error_reporting(~E_WARNING);
      sec_session_start();  //chiama inizia sessione
      if(login_check($conn) == true) {
     ?>
    <header>
      <a href="home.html">
      <h1>Yook!</h1>
      </a>
      <h2>Menù</h2>
    </header>

    <!-- barra progressi -->
    <div class="checkout-wrap">
      <ul class="checkout-bar">
        <li class="active"><a href="#">Menù</a></li>
        <li class="">Luogo Consegna</li>
        <li class="">Carrello</li>
        <li class="">Pagamento</li>
        <li class="">Fine</li>
      </ul>
    </div>

    <h3> I nostri piatti sono divisi in categorie </h3>
    <!-- Barra ricerca-->
      <form class="searchform" action="search.php" onsubmit="return displayFunction()" method="post"> <!-- on submit non dovrebbe fare niete-->
        <input type="search" name="search" value="" placeholder="Inserisci ricerca qui...">
        <button class="btn third">Cerca</button>
      </form>

    <!-- Inizio elenco menù-->
    <div class="row listino">
      <div class="col-4 pastiVeloci"> <!-- Categoria pasti veloci-->
        <h3>Pasti Veloci</h3>
        <?php
          $query = "SELECT * FROM listino WHERE listino.Categoria ='Pasti Veloci'"; //con questa query seleziono tutti i pasti dalla tabella listino che sono nella categoria "Pasti Veloci"
          if($result = $conn->query($query)){ //se la query ha prodotto un risultato
            while($row = $result->fetch_row()){ //il risultato prodotto è un insieme di righe prelevate dal database. faccio la fetch del risultato e ogni riga, fintanto che ci sono righe, la analizzo mettendola nella variabile "row"
              echo "<div class = 'offert fast'>";
              echo  "<div class = 'row prova'>";
              echo    "<div class = 'col-4'>";
              echo      "<img src = '".$row[5]."'>"; //la variabile row, che contiene riga per riga, ad ogni iterazione, il risultato della query, è un vettore i cui indici sono le colonne della tabella (quella indicata nella query) con indice a partire da 0
              echo    "</div>";  //es: nella tabella listino la colonna con indice 0 è "Codice", con indice 1 è "Nome" ecc.. (vedi phpMyAdmmin per l'ordine delle colonne)
              echo    "<div class = 'col-8 desc'>";
              echo      "<p>".$row[1]."</p>";
              echo      "<p>".$row[3]."</p>";
              echo      "<p>".$row[4]."€</p>";
              echo      "<form action='menu.php' method='post'>
                          <input type='number' name='q".$row[0]."' max='100' value = 1>
                          <input type='submit' name='fast' value='Aggiungi al carrello'>
                        </form>";
              if (isset($_SESSION['carrello'][$row[0]])) { //se esiste l'indice nel vettore "$_SESSION" corrispondente all'id del prodotto in quel momento preso in considerazione (la prima sessione crea tutta la struttura vuota, poi vado qui)
                if( isset($_POST['q'.$row[0]]) ) {  //se c'è qualcosa passato nel $_POST aggiorno le variabili di sessione
                  $q = $_POST['q'.$row[0]]; //setto la variabile q per la quantità con il paramentro inserito dall'utente, il quale è referenziato con l'indice "q+idprodotto"
                  $_SESSION['carrello'][$row[0]]['quantity'] += $q; //aggiorno la quantità appena inserita dall'utente con quella già presente
                  $p = $row[4] * $_SESSION['carrello'][$row[0]]['quantity']; //moltiplico il prezzo (preso dalla colonna 4 del database) per la quantità totale
                  $_SESSION['carrello'][$row[0]]['price'] = $p; //inserisco il prezzo nella sessione
                }
              } else { //se non esiste l'indice nel vettore "$_SESSION" corrispondente all'id del prodotto in quel momento preso in considerazione, lo creo
                //alla prima apertura della pagina cicla tutto e crea ogni cosa con quantità e prezzo nulle
                $_SESSION['carrello'][$row[0]] = array('quantity' => 0, 'price' => 0); //sia quello per la quantità, sia quello per il prezzo
              }
              echo    "</div>";
              echo  "</div>";
              echo "</div>";
            }
          } else {
            echo "Nessun dato trovato";
          }
        ?>
      </div>

      <div class="col-4 primi"> <!-- come sopra -->
        <h3>Primi</h3>
        <?php
          $query = "SELECT * FROM listino WHERE listino.Categoria ='Primi'";
          if($result = $conn->query($query)){
            while($row = $result->fetch_row()){
              echo "<div class = 'offert meal'>";
              echo  "<div class = 'row prova'>";
              echo    "<div class = 'col-4'>";
              echo      "<img src = '".$row[5]."'>";
              echo    "</div>";
              echo    "<div class = 'col-8 desc'>";
              echo      "<p>".$row[1]."</p>";
              echo      "<p>".$row[3]."</p>";
              echo      "<p>".$row[4]."€</p>";
              echo      "<form action='menu.php' method='post'>
                          <input type='number' name='q".$row[0]."' max='100' value = 1>
                          <input type='submit' name='fast' value='Aggiungi al carrello'>
                        </form>";
              if (isset($_SESSION['carrello'][$row[0]])) {
                $q = @$_POST['q'.$row[0]];
                $p = $row[4] * $q;
                $_SESSION['carrello'][$row[0]]['quantity'] += $q;
                $_SESSION['carrello'][$row[0]]['price'] = $p;
              } else {
                $_SESSION['carrello'][$row[0]] = array('quantity' => 0, 'price' => 0);
              }
              echo    "</div>";
              echo  "</div>";
              echo "</div>";
            }
          } else {
            echo "Nessun dato trovato";
          }
        ?>
      </div>

      <div class="col-4 bevande"> <!-- come sopra -->
        <h3>Bevande</h3>
        <?php
          $query = "SELECT * FROM listino WHERE listino.Categoria ='Bevande'";
          if($result = $conn->query($query)){
            while($row = $result->fetch_row()){
              echo "<div class = 'offert drink'>";
              echo  "<div class = 'row prova'>";
              echo    "<div class = 'col-4'>";
              echo      "<img src = '".$row[5]."'>";
              echo    "</div>";
              echo    "<div class = 'col-8 desc'>";
              echo      "<p>".$row[1]."</p>";
              echo      "<p>".$row[3]."</p>";
              echo      "<p>".$row[4]."€</p>";
              echo      "<form action='menu.php' method='post'>
                          <input type='number' name='q".$row[0]."' max='100' value = 1>
                          <input type='submit' name='fast' value='Aggiungi al carrello'>
                        </form>";
              if (isset($_SESSION['carrello'][$row[0]])) {
                $q = @$_POST['q'.$row[0]];
                $p = $row[4] * $q;
                $_SESSION['carrello'][$row[0]]['quantity'] += $q;
                $_SESSION['carrello'][$row[0]]['price'] = $p;
              } else {
                $_SESSION['carrello'][$row[0]] = array('quantity' => 0, 'price' => 0);
              }
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
         echo "<a href='accedi.php'>Accedi</a>";
      }
        ?>
      </div>
    </div>
    <form class="" action="cart.php" method="post">
      <input type="submit" name="cart" value="Vai al carrello">
    </form>
  </body>
</html>
