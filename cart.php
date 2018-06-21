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
    <!-- per le figurine/carte -->
    <link rel="stylesheet" type="text/css" title="stylesheet" href="./css/food_figure.css">
    <!-- per il pulsante bollicinoso, in fondo alla pagina c'è lo script -->
    <link rel="stylesheet" type="text/css" title="stylesheet" href="./css/bubbly.css">
    <!-- per la mia funzione post -->
    <script src="js/post_function.js"></script>
    <!-- per AJAX -->
    <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
  </head>

  <body>

  <!-- il not-footer serve per il footer statico -->
  <div id="not-footer">

    <header>
      <a href="home.php">
      <h1>Yook!</h1>
      </a>
      <h2>Make it Yours.</h2>
      <p>Resoconto degli acquisti</p>
    </header>


        <!-- barra progressi -->
        <div class="" style="background-color: white">
          <ul class="checkout-bar">
            <li class="visited"><a href="menu.php">Menù</a></li>
            <li class="visited"><a href="address.php">Luogo Consegna</a></li>
            <li class="active">Carrello</li>
            <li class="">Pagamento</li>
            <li class="">Fine</li>
          </ul>
        </div>

    <div class = "row listino allcenter">
      <br><br>
      <img src="./resources/menu/carrello.png" width="30%">
      <?php
        include 'connection.php';
        include 'functions.php';
        sec_session_start();
        if(login_check($conn) == true) {



        $query = "SELECT * FROM listino"; //seleziono tutti i cibi dal listino
        $_SESSION['totale_ordine'] = 0; //mi servirà per tenere conto del prezzo totale che l'utente deve pagare alla fine
        $_SESSION['cibi_ordine'] = "";  //mi serve come lista a parole del totale dei cibi
        if($result = $conn->query($query)){ //se la query ha prodotto risultato
          //echo session_id();
          while($row = $result->fetch_row()){ //fetcho e ciclo ogni riga della tabella
            if( isset($_SESSION['carrello'][$row[0]]) ){ //se esiste una sessione corrispondente a quel prodotto (ovvero è stato inserito nel carrello)
              if( $_SESSION['carrello'][$row[0]]['quantity'] > 0 ) { //se c'è una quantità > 0
      ?>
                <div class = 'figurina'>
                  <section class='movie_image'>
                    <img class='movie_poster' src = '<?php echo $row[5] ?>'> <!--//la variabile row, che contiene riga per riga, ad ogni iterazione, il risultato della query, è un vettore i cui indici sono le colonne della tabella (quella indicata nella query) con indice a partire da 0-->
                  </section>  <!--//es: nella tabella listino la colonna con indice 0 è "Codice", con indice 1 è "Nome" ecc.. (vedi phpMyAdmmin per l'ordine delle colonne)-->
                  <section class='center_fig'>
                    <div class='about_movie'>
                      <h3><?php echo $row[1] ?></h3>
                      <div class='movie_info'>
                        <p><?php echo ($_SESSION['carrello'][$row[0]]['price'] * 2) ?> punti</p>
                      </div>
                      <div class='movie_desc'>
                        <p><?php echo $row[3] ?></p>
                      </div>
                      <p>
                        Totale:<?php echo $_SESSION['carrello'][$row[0]]['price']."€" ?> <!-- //stampo il suo prezzo calcolato nel menù in base alla quantità, prendendolo dalla sessione -->
                      </p>
                      <p>Quantità selezionata:
                        <?php
                          echo $_SESSION['carrello'][$row[0]]['quantity']; //stampo la quantità selezionata dall'utente nel menù e salvata nella sessione
                          //<!--aggiorno il prezzo totale del'ordine e lo inserisco nella variabile di sessione-->
                          $_SESSION['totale_ordine'] = $_SESSION['totale_ordine'] + $_SESSION['carrello'][$row[0]]['price'];
                          //aggiorno la lista di cibi
                          $_SESSION['cibi_ordine'] .= " ".$_SESSION['carrello'][$row[0]]['quantity']." ".$row[1].","; // x3 pizza
                          //PARTE CHE RICEVE I DATI LATO SERVER
                          //è dentro il while perchè deve fare tanti controlli quanto le righe del listino
                          if( isset($_POST['q'.$row[0]]) ) {  //se c'è qualcosa passato nel $_POST aggiorno le variabili di sessione
                            $z = $_POST['q'.$row[0]]; //setto la variabile z per la quantità diretta del cibo con il paramentro inserito dall'utente, il quale è referenziato con l'indice "q+idprodotto"
                            $_SESSION['carrello'][$row[0]]['quantity'] = $z; //aggiorno la quantità appena inserita dall'utente con quella già presente
                            $p = $row[4] * $_SESSION['carrello'][$row[0]]['quantity']; //moltiplico il prezzo (preso dalla colonna 4 del database) per la quantità totale
                            $_SESSION['carrello'][$row[0]]['price'] = $p; //inserisco il prezzo nella sessione
                          }
                        ?>
                        </br>
                        <button class='bubbly-button' onclick="$.post('cart.php', { q<?php echo $row[0] ?>:0 } , function(){ window.location.replace('cart.php'); });">Rimuovi</button>
                      </p>
                    </div>
                  </section>
                </div>
      <?php
              }
            }
          } //fine while che cicla tabella
          //stampo totale
          echo "Totale: ".$_SESSION['totale_ordine']." €</br>";  //<!--stampo il prezzo totale da pagare-->
          //calcolo punti guadagnati
          $_SESSION['punti_ordine'] = ($_SESSION['totale_ordine']*2);
          //stampo punti
          if ($_SESSION['nome'] != "guest") {
            echo "Punti attuali: ".$_SESSION['punti']."</br>";
            echo "Punti guadagnati: ".$_SESSION['punti_ordine']."</br>";
          } else {
            echo "Registrandoti avresti guadagnato: ".$_SESSION['punti_ordine']." punti.</br>";
          }

        }
      ?>
      </br>




      <?php
      //alternativa alla pagina
      } else {
         echo 'You are not authorized to access this page, please login. <br/>';
         echo "<a href='accedi.php'>Accedi</a>";
      }
      ?>
    </div>

    <div class="row listino">

      <div class="col-6 allleft">
        <form class="" action="menu.php" method="post">
          <button class="btn third">Torna al menù</button>
        </form>
      </div>
      <div class="col-6 allright">
        <form class="" action="pagamento.php" method="post">
          <button class="btn third">Vai alla pagina di pagamento</button>
        </form>
      </div>

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
