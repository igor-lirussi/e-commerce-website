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
       <h2>Make it Yours.</h2>
       <p>Il tuo ordine è stato accetato!</p>
     </header>


        <!-- barra progressi -->
        <div class="checkout-wrap">
          <ul class="checkout-bar">
            <li class="visited">Menù</li>
            <li class="visited">Luogo Consegna</li>
            <li class="visited">Carrello</li>
            <li class="visited">Pagamento</li>
            <li class="last">Fine</li>
          </ul>
        </div>


    <div class = "row">
        FINE.</br>
        <?php
        echo "</br>Consegna in ".$_SESSION['indir_ordine'];
        echo "</br>Nome ".$_SESSION['nome'];
        echo "</br>cognome ".$_SESSION['cognome'];
        echo "</br>email in ".$_SESSION['email'];
        echo "</br>Indirizzo in ".$_SESSION['indirizzo'];
        echo "</br>pagamento in ".$_SESSION['pagamento'];
        echo "</br>carta in ".$_SESSION['carta'];
        echo "</br>scadenza in ".$_SESSION['scadenza'];
        echo "</br>cvv in ".$_SESSION['cvv'];
        echo "</br>punti in ".$_SESSION['punti'];
        echo "</br>Totale in ".$_SESSION['totale'];
        echo "</br>id in ".$_SESSION['user_id'];
        ?>
    </div>



    <?php
    //alternativa alla pagina
    } else {
       echo 'You are not authorized to access this page, please login. <br/>';
       echo "<a href='accedi.php'>Accedi</a>";
    }
    ?>

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
