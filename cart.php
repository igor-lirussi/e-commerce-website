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

  </head>

  <body>

    <!-- inizio corpo del sito, displayed dopo il loading-->
<div id="allpage">
  <!-- il not-footer serve per il footer statico -->
  <div id="not-footer">

    <header>
      <a href="home.html">
      <h1>Yook!</h1>
      </a>
      <h2>Make it Yours.</h2>
      <nav>
      <ul>
        <li><a href="ourFood.html">Il nostro cibo</a></li>
        <li><a href="ourStory.html">La nostra storia</a></li>
        <li><a href="#">Location</a></li>
        <li><a href="#">Contattaci</a></li>
      </ul>
      </nav>
    </header>


        <!-- barra progressi -->
        <div class="checkout-wrap">
          <ul class="checkout-bar">
            <li class="visited"><a href="#">Menù</a></li>
            <li class="visited">Luogo Consegna</li>
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

        $query = "SELECT * FROM listino"; //seleziono tutti i cibi dal listino
        $totale = 0; //mi servirà per tenere conto del prezzo totale che l'utente deve pagare alla fine
        if($result = $conn->query($query)){ //se la query ha prodotto risultato
          echo session_id();
          while($row = $result->fetch_row()){ //fetcho e ciclo ogni riga della tabella
            if(isset($_SESSION['carrello'][$row[0]])){ //se esiste una sessione corrispondente a quel prodotto (ovvero è stato inserito nel carrello)
              echo "<div class = 'offert'>"; //lo mostro
              echo  "<div class = 'row'>";
              echo    "<div class = 'col-4'>";
              echo      "<img src = '".$row[5]."'>";
              echo    "</div>";
              echo    "<div class = 'col-8 desc'>";
              echo      "<p>".$row[1]."</p>";
              echo      "<p>".$row[3]."</p>";
              echo      "<p>";
              print_r($_SESSION['carrello'][$row[0]]['price']); //stampo il suo prezzo calcolato nel menù in base alla quantità, prendendolo dalla sessione
              echo "€</p>";
              echo      "<p>Quantità selezionata: ";
              print_r($_SESSION['carrello'][$row[0]]['quantity']); //stampo la quantità selezionata dall'utente nel menù e salvata nella sessione
              $totale = $totale + $_SESSION['carrello'][$row[0]]['price']; //aggiorno il prezzo totale
              echo "</p>";
              echo    "</div>";
              echo  "</div>";
              echo "</div>";
            }
          }
          echo $totale; //stampo il prezzo totale da pagare
        }
      ?>
      <a href="menu.php">Torna al menu</a>
      <a href="pagamento.php">Paga</a>

    </div>

    </div>
    <footer>
      <address>
            <p>
                Copyright 2018 <strong>Yook S.r.l.</strong><br>
                Via Albert Einstein n. 3, 48018 Faenza (RA)<br>
                <a href="mailto:info@Yook.it">info@Yook.it</a>
            </p>
            <p>
                P.Iva: 02684269693 - REA: RA-526419
                <br>
                Cap. Soc. 10.000€ e riserve in conto capitale per un totale di 101.000€ interamente versati.
            </p>
            <p>
                <a id="footer_InfoLegali" href="info_legali.html">Info Legali</a> | <a id="footer_PrivacyPolicy" href="privacy_policy.html">Privacy</a>
            </p>
      </address>
    </footer>
  <!-- fine corpo del sito -->
  </div>
  </body>

</html>
