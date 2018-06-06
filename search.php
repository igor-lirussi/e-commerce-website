<!DOCTYPE html>
<html lang="it">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
    <!-- per barra progressi -->
    <link rel="stylesheet" type="text/css" title="stylesheet" href="./css/progress.css">
    <!-- per il pulsante bollicinoso, in fondo alla pagina c'è lo script -->
    <link rel="stylesheet" type="text/css" title="stylesheet" href="./css/bubbly.css">
    <!-- per input text figo -->
    <link rel="stylesheet" type="text/css" title="stylesheet" href="./css/inp_text.css">
    <!-- per le figurine/carte -->
    <link rel="stylesheet" type="text/css" title="stylesheet" href="./css/food_figure.css">
    <!-- per hamburger menu -->
    <link rel="stylesheet" href="css/hamburger.css">
    <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
    <script src="js/hamburger.js"></script>

    <title>SitoCibo</title>
    <link rel="icon" href="resources/favicon.ico" />
  </head>

  <body>

    <!-- il not-footer serve per il footer statico -->
    <div id="not-footer">

    <?php
      include 'functions.php';
      include 'connection.php';
      error_reporting(~E_WARNING);
      sec_session_start();
      if(login_check($conn) == true) {
     ?>

     <?php
     //faccio query per le informazioni dell'utente
       $query = "SELECT * FROM members WHERE id = '".$_SESSION['user_id']."'"; //con questa query seleziono tutti i dati dell'utente
       if($result = $conn->query($query)){ //se la query ha prodotto un risultato
         while($row = $result->fetch_row()) { //il risultato prodotto è un insieme di righe prelevate dal database. faccio la fetch del risultato e ogni riga, fintanto che ci sono righe, la analizzo mettendola nella variabile "row"
           //echo "Benvenuto ".$row[1]; //username c'è già dal login
           $_SESSION['nome'] = $row[1];
           $_SESSION['cognome'] = $row[2];
           $_SESSION['email'] = $row[4];
           $_SESSION['indirizzo'] = $row[7];
           $_SESSION['pagamento'] = $row[8];
           $_SESSION['carta'] = $row[9];
           $_SESSION['scadenza'] = $row[10];
           $_SESSION['cvv'] = $row[11];
           $_SESSION['punti'] = $row[14];
           //echo "<br>Dati in-sessione: ".$_SESSION['nome']." ".$_SESSION['cognome']." ".$_SESSION['email']." ".$_SESSION['indirizzo']." ";
           //echo "<br>Dati in-sessione: ".$_SESSION['pagamento']." ".$_SESSION['carta']." ".$_SESSION['scadenza']." ".$_SESSION['cvv']." ".$_SESSION['punti'];
         }
       } else {
         echo "Nessun dato sull' utente trovato";
       }
     ?>

     <!-- menu hamburger -->
      <div  class="open">
     	<span class="cls"></span>
     	<span>
     		<ul class="sub-menu ">
        <?php if ($_SESSION['nome'] != "guest") { ?>
     			<li>
            <div class="saluto"><?php echo "Ciao ".$_SESSION['nome'] ?></title></div>
     			</li>
     			<li>
     				<p><?php echo $_SESSION['punti']." punti" ?></p>
     			</li>
     			<li>
     				<a href="./logout.php" title="">Logout</a>
     			</li>
        <?php } else { ?>
          <li>
            <div class="saluto center">Come utente ospite non puoi accumulare punti e salvare i tuoi dati.</title></div>
          </li>
        <?php } ?>
     			<li>
     				<a href="./ourContacts.html" title="contact">Aiuto</a>
     			</li>
     		</ul>
     	</span>
     	<span class="cls"></span>
     </div>

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

    <div class="row listino">
      <h3>Cerca</h3>
      <h3><a href="menu.php">Torna al menù</a></h3>
        <form class="searchform" action="search.php" onsubmit="return displayFunction()" method="post">
          <input type="search" name="search" value="" placeholder="Inserisci ricerca qui..">
          <button class="btn third">Cerca</button>
        </form>
        <div class="searchresult">  <!-- DA SPOSATRE TUTTO QUESTO DIV IN UNO SCRIPT CHE SI VISUALIZZA SOLO SE E' STATO PREMUTO IL PULSANTE DELLA RICERCA -->
          <?php
            if($query = $conn->prepare("SELECT * FROM listino WHERE Nome LIKE ?")){
              $search = "%".@$_POST["search"]."%";
              $query->bind_param('s', $search);
              $query->execute();
              $result = $query->get_result();
              while($row = $result->fetch_row()){
                switch ($row[2]) {
                  case 'Pasti Veloci':?>
                    <div class = 'figurina'>
                      <section class='movie_image'>
                          <img class='movie_poster' src = "<?php echo $row[5] ?>"> <!--la variabile row, che contiene riga per riga, ad ogni iterazione, il risultato della query, è un vettore i cui indici sono le colonne della tabella (quella indicata nella query) con indice a partire da 0-->
                      </section>  <!--es: nella tabella listino la colonna con indice 0 è "Codice", con indice 1 è "Nome" ecc.. (vedi phpMyAdmmin per l'ordine delle colonne)-->
                      <section class='center_fig'>
                        <div class='about_movie'>
                          <h3><?php echo $row[1] ?></h3>
                          <div class='movie_info'>
                            <p><?php echo $row[4] ?>€</p>
                          </div>
                          <div class='movie_desc'>
                            <p><?php echo $row[3] ?></p>
                          </div>
                          <!-- uso AJAX per passare con post { l'ID : quantità } alla pagina stessa sul server, la parte che riceve i dati ( qui sotto) si occupa di memorizzarli in variabili di sessione -->
                          <div class='cont_inp'><span><input class='gate' id='q<?php echo $row[0] ?>' type='number' name='q<?php echo $row[0] ?>' max='100' value=1 placeholder='Fame?' /><label for='class'>Quantità</label></span></div>
                          <button class='bubbly-button' onclick="$.post('menu.php', { q<?php echo $row[0] ?> : document.getElementById('q<?php echo $row[0] ?>').value }, function(){} );">Aggiungi</button>
                      <?php
                      //PARTE CHE RICEVE I DATI LATO SERVER
                      //è dentro il while perchè deve fare tanti controlli quanto le righe del listino
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
                      ?>
                        </div>
                      </section>
                    </div>
                    <?php
                  break;

                  case 'Primi':
                    ?>
                    <div class = 'figurina'>
                      <section class='movie_image'>
                          <img class='movie_poster' src = "<?php echo $row[5] ?>"> <!--la variabile row, che contiene riga per riga, ad ogni iterazione, il risultato della query, è un vettore i cui indici sono le colonne della tabella (quella indicata nella query) con indice a partire da 0-->
                      </section>  <!--es: nella tabella listino la colonna con indice 0 è "Codice", con indice 1 è "Nome" ecc.. (vedi phpMyAdmmin per l'ordine delle colonne)-->
                      <section class='center_fig'>
                        <div class='about_movie'>
                          <h3><?php echo $row[1] ?></h3>
                          <div class='movie_info'>
                            <p><?php echo $row[4] ?>€</p>
                          </div>
                          <div class='movie_desc'>
                            <p><?php echo $row[3] ?></p>
                          </div>
                          <!-- uso AJAX per passare con post { l'ID : quantità } alla pagina stessa sul server, la parte che riceve i dati ( qui sotto) si occupa di memorizzarli in variabili di sessione -->
                          <div class='cont_inp'><span><input class='gate' id='q<?php echo $row[0] ?>' type='number' name='q<?php echo $row[0] ?>' max='100' value=1 placeholder='Fame?' /><label for='class'>Quantità</label></span></div>
                          <button class='bubbly-button' onclick="$.post('menu.php', { q<?php echo $row[0] ?> : document.getElementById('q<?php echo $row[0] ?>').value }, function(){} );">Aggiungi</button>
                      <?php
                      //PARTE CHE RICEVE I DATI LATO SERVER
                      //è dentro il while perchè deve fare tanti controlli quanto le righe del listino
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
                      ?>
                        </div>
                      </section>
                    </div>
                    <?php
                    break;
                  case 'Bevande':
                    ?>
                    <div class = 'figurina'>
                      <section class='movie_image'>
                          <img class='movie_poster' src = "<?php echo $row[5] ?>"> <!--la variabile row, che contiene riga per riga, ad ogni iterazione, il risultato della query, è un vettore i cui indici sono le colonne della tabella (quella indicata nella query) con indice a partire da 0-->
                      </section>  <!--es: nella tabella listino la colonna con indice 0 è "Codice", con indice 1 è "Nome" ecc.. (vedi phpMyAdmmin per l'ordine delle colonne)-->
                      <section class='center_fig'>
                        <div class='about_movie'>
                          <h3><?php echo $row[1] ?></h3>
                          <div class='movie_info'>
                            <p><?php echo $row[4] ?>€</p>
                          </div>
                          <div class='movie_desc'>
                            <p><?php echo $row[3] ?></p>
                          </div>
                          <!-- uso AJAX per passare con post { l'ID : quantità } alla pagina stessa sul server, la parte che riceve i dati ( qui sotto) si occupa di memorizzarli in variabili di sessione -->
                          <div class='cont_inp'><span><input class='gate' id='q<?php echo $row[0] ?>' type='number' name='q<?php echo $row[0] ?>' max='100' value=1 placeholder='Fame?' /><label for='class'>Quantità</label></span></div>
                          <button class='bubbly-button' onclick="$.post('menu.php', { q<?php echo $row[0] ?> : document.getElementById('q<?php echo $row[0] ?>').value }, function(){} );">Aggiungi</button>
                      <?php
                      //PARTE CHE RICEVE I DATI LATO SERVER
                      //è dentro il while perchè deve fare tanti controlli quanto le righe del listino
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
                      ?>
                        </div>
                      </section>
                    </div>
                    <?php
                    break;

                  default:
                    # code...
                    break;
                }
              }
            } else {
              echo "Nessun risultato trovato";
            }
          ?>
          </div>
        </div>
    <?php $conn->close();
      } else {
         echo 'You are not authorized to access this page, please login. <br/>';
      }
        ?>
      </div>
      <script src="js/bubbly.js"></script>
    </div>
    <form class="" action="cart.php" method="post">
      <input type="submit" name="cart" value="Vai al carrello">
    </form>
    </div>
    <footer>
      <address>
            <p>
                Copyright 2018 <strong>Yook S.r.l.</strong><br>
                Piazza Fabbri n.5, Cesena 47521 (FC), Italia<br>
                <a href="mailto:info@Yook.it">info@Yook.it</a>
            </p>
            <p>
                P.Iva: 02684269693 - REA: FC-526419
                <br>
                Cap. Soc. 10.000€ e riserve in conto capitale per un totale di 100.000€ interamente versati.
            </p>
            <p>
                <a id="footer_InfoLegali" href="info_legali.html">Info Legali</a> | <a id="footer_PrivacyPolicy" href="privacy_policy.html">Privacy</a>
            </p>
      </address>
    </footer>
  </body>
</html>
