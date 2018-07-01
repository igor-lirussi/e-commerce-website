<!DOCTYPE html>
<html lang="it">

  <head>
    <meta charset="utf-8">
    <title>Yook - Menu</title>
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
  </head>

  <body>

  <!-- il not-footer serve per il footer statico -->
  <div id="not-footer">

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
              if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {  //se mi è giunto qualcosa via metodo post
                if(false) {  //sempre
                  echo '<i class="fas fa-shopping-cart"></i> <h1>Aggiunto al carrello!<br/></h1>';
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
      if(login_check($conn) == true) {  //se loggato
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
      <a href="home.php">
      <h1>Yook!</h1>
      </a>
      <h2>Menù</h2>
      <p>I nostri prodotti</p>
    </header>

<div class="" style="background-color: white">
  <!-- barra progressi -->
    <ul class="checkout-bar">
      <li class="active">Menù</li>
      <li class="">Luogo Consegna</li>
      <li class="">Carrello</li>
      <li class="">Pagamento</li>
      <li class="">Fine</li>
    </ul>
</div>



<div class="row listino allcenter">
    <br>
    <br>
    <img src="./resources/menu/menu1.png" width="30%">
    <!-- Barra ricerca-->
      <form class="searchform" action="search.php" onsubmit="return displayFunction()" method="post"> <!-- on submit non dovrebbe fare niete-->
        <input type="search" name="search" value="" placeholder="Inserisci ricerca qui...">
        <button class="btn third">Cerca</button>
      </form>

    </div>
    <!-- Inizio elenco menù-->
    <div class="row listino">
      <div class="col-4 pastiVeloci"> <!-- Categoria pasti veloci-->
        <h3>Pasti Veloci</h3>
        <?php
          $query = "SELECT * FROM listino WHERE listino.Categoria ='Pasti Veloci'"; //con questa query seleziono tutti i pasti dalla tabella listino che sono nella categoria "Pasti Veloci"
          if($result = $conn->query($query)){ //se la query ha prodotto un risultato
            while($row = $result->fetch_row()){ //il risultato prodotto è un insieme di righe prelevate dal database. faccio la fetch del risultato e ogni riga, fintanto che ci sono righe, la analizzo mettendola nella variabile "row"
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
            }
          } else {
            echo "Nessun dato nel listino trovato";
          }
        ?>
      </div>

      <div class="col-4 primi"> <!-- come sopra -->
        <h3>Primi</h3>
        <?php
          $query = "SELECT * FROM listino WHERE listino.Categoria ='Primi'";
          if($result = $conn->query($query)){ //se la query ha prodotto un risultato
            while($row = $result->fetch_row()){ //il risultato prodotto è un insieme di righe prelevate dal database. faccio la fetch del risultato e ogni riga, fintanto che ci sono righe, la analizzo mettendola nella variabile "row"
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
                  }
                } else {
                  echo "Nessun dato nel listino trovato";
                }
        ?>

        <!-- per la pizza Personalizza  -->
        <?php if (isset($_SESSION["pizza_pers"])) { ?>
        <div class='figurina'>
          <form action='draw.php' method='post' enctype='multipart/form-data'>
            <section class='movie_image'>
              <div class="center">
                <img class='movie_poster' src="<?php echo $_SESSION["pizza_pers"]["image"]; ?>">
              </div>
            </section>
            <section class='center_fig'>
              <div class='about_movie'>
                <h3><?php echo $_SESSION["pizza_pers"]["name"]; ?></h3>
                <div class='movie_info'>
                  <p><?php echo $_SESSION["pizza_pers"]["price"]; ?> €</p>
                </div>
                <div class='movie_desc'>
                  <p>La mia pizza personalizzata!</p>
                </div>
                <button class='bubbly-button'>Ricrea</button>
             </div>
            </section>
          </form>
         </div>
       <?php } else {?>
         <div class='figurina'>
           <form action='draw.php' method='post' enctype='multipart/form-data'>
             <section class='movie_image'>
               <div class="center">
                 <img class='movie_poster' src="./resources/logo2.png">
               </div>
             </section>
             <section class='center_fig'>
               <div class='about_movie'>
                 <h3>Crea la tua pizza</h3>
                 <div class='movie_info'>
                   <p></p>
                 </div>
                 <div class='movie_desc'>
                   <p>Puoi creare una pizza personalizzata ad ogni ordine dal prezzo variabile in base agli ingredienti</p>
                 </div>
                 <button class='bubbly-button'>Crea</button>
              </div>
             </section>
           </form>
          </div>
       <?php } ?>
      </div>

      <div class="col-4 bevande"> <!-- come sopra -->
        <h3>Bevande</h3>
        <?php
          $query = "SELECT * FROM listino WHERE listino.Categoria ='Bevande'";
          if($result = $conn->query($query)){ //se la query ha prodotto un risultato
            while($row = $result->fetch_row()){ //il risultato prodotto è un insieme di righe prelevate dal database. faccio la fetch del risultato e ogni riga, fintanto che ci sono righe, la analizzo mettendola nella variabile "row"
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
                  }
                } else {
                  echo "Nessun dato nel listino trovato";
                }
        //chiudo la connessione a fine query
        $conn->close();
      } else {
         echo 'You are not authorized to access this page, please login. <br/>';
         echo "<a href='accedi.php'>Accedi</a>";
      }
        ?>
      </div>
    </div>
    <div class="row listino allright">
      <form class="" action="address.php" method="post">
        <button class="btn third">Scegli luogo consegna</button>
      </form>
    </div>

    <!-- script per pulsante bollicinoso -->
    <script src="js/bubbly.js"></script>

  </div>
  <footer>
    <?php
      include 'footer.php';
      print_footer();
    ?>
  </footer>
  </body>
</html>
