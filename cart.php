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
  </head>

  <body>

  <!-- il not-footer serve per il footer statico -->
  <div id="not-footer">

    <header>
      <a href="home.html">
      <h1>Yook!</h1>
      </a>
      <h2>Make it Yours.</h2>
      <p>Resoconto degli acquisti</p>
    </header>


        <!-- barra progressi -->
        <div class="checkout-wrap">
          <ul class="checkout-bar">
            <li class="visited"><a href="menu.php">Menù</a></li>
            <li class="visited"><a href="address.php">Luogo Consegna</a></li>
            <li class="active">Carrello</li>
            <li class="">Pagamento</li>
            <li class="">Fine</li>
          </ul>
        </div>


    <div class = "row">
      <h1>Il tuo carrello</h1>
      <?php
        include 'connection.php';
        include 'functions.php';
        sec_session_start();
        if(login_check($conn) == true) {

        //prendo il POST dell'indirizzo
        if ( !empty($_SESSION['indir_new']) || !empty($_POST['indir_new']) ) {
          if ( !empty($_POST['indir_new']) ) {
            $_SESSION['indir_new'] = $_POST['indir_new'];
          }
          echo "Consegna in ".$_SESSION['indir_new'];
        } else {
          echo "Indirizzo di consegna non impostato.</br>";
        }


        $query = "SELECT * FROM listino"; //seleziono tutti i cibi dal listino
        $_SESSION['totale'] = 0; //mi servirà per tenere conto del prezzo totale che l'utente deve pagare alla fine
        if($result = $conn->query($query)){ //se la query ha prodotto risultato
          //echo session_id();
          while($row = $result->fetch_row()){ //fetcho e ciclo ogni riga della tabella
            if( isset($_SESSION['carrello'][$row[0]]) ){ //se esiste una sessione corrispondente a quel prodotto (ovvero è stato inserito nel carrello)
              if( $_SESSION['carrello'][$row[0]]['quantity'] > 0 ) { //se c'è una quantità > 0
                echo "<div class = 'figurina'>";
                echo  "<section class='movie_image'>";
                echo      "<img class='movie_poster' src = '".$row[5]."'>"; //la variabile row, che contiene riga per riga, ad ogni iterazione, il risultato della query, è un vettore i cui indici sono le colonne della tabella (quella indicata nella query) con indice a partire da 0
                echo  "</section>";  //es: nella tabella listino la colonna con indice 0 è "Codice", con indice 1 è "Nome" ecc.. (vedi phpMyAdmmin per l'ordine delle colonne)
                echo  "<section class='center_fig'>";
                echo    "<div class='about_movie'>";
                echo      "<h3>".$row[1]."</h3>";
                echo      "<div class='movie_info'>";
                echo        "<p>".($_SESSION['carrello'][$row[0]]['price'] * 2)." punti</p>";
                echo      "</div>";
                echo      "<div class='movie_desc'>";
                echo        "<p>".$row[3]."</p>";
                echo      "</div>";
                echo      "<p>";
                print_r($_SESSION['carrello'][$row[0]]['price']); //stampo il suo prezzo calcolato nel menù in base alla quantità, prendendolo dalla sessione
                echo "€</p>";
                echo      "<p>Quantità selezionata: ";
                print_r($_SESSION['carrello'][$row[0]]['quantity']); //stampo la quantità selezionata dall'utente nel menù e salvata nella sessione
                $_SESSION['totale'] = $_SESSION['totale'] + $_SESSION['carrello'][$row[0]]['price']; //aggiorno il prezzo totale e lo inserisco nella variabile di sessione
                echo "</p>";
                echo    "</div>";
                echo  "</section>";
                echo "</div>";
              }
            }
          }
          echo "Totale: ".$_SESSION['totale']." €</br>"; //stampo il prezzo totale da pagare
          echo "Punti guadagnati: ".($_SESSION['totale']*2)."</br>";
        }
      ?>
      </br>
      <a href="menu.php">Torna al menu</a>
      <a href="pagamento.php">Vai alla pagina di pagamento</a>


      <?php
      //alternativa alla pagina
      } else {
         echo 'You are not authorized to access this page, please login. <br/>';
         echo "<a href='accedi.php'>Accedi</a>";
      }
      ?>
    </div>

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
