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
    <!-- per il pagamento -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/payment.css">
    <!-- per AJAX -->
    <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
    <!-- per mia funzione poi cancellare -->
    <script src="js/post_function.js"></script>
  </head>

  <body onload="body_loaded()">

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
      <a href="home.php">
      <h1>Yook!</h1>
      </a>
      <h2>Make it Yours.</h2>
      <p>Pagamento</p>
    </header>


    <!-- barra progressi -->
    <div class="checkout-wrap">
      <ul class="checkout-bar">
        <li class="visited"><a href="menu.php">Menù</a></li>
        <li class="visited"><a href="address.php">Luogo Consegna</a></li>
        <li class="visited"><a href="cart.php">Carrello</a></li>
        <li class="active">Pagamento</li>
        <li class="">Fine</li>
      </ul>
    </div>

    <?php
    //OPERAZIONI LATO SERVER DOPO IL PAGAMENTO
    if ( !empty($_POST['svuoto']) ) { //se c'è post di svuoto
        if ($_POST['svuoto']==true) { //se è true (doppio controllo per sicurezza)
          //azzero
          $_POST['svuoto']=false;
          //memorizzo numero ordine
          $_SESSION['num_ordine'] = 0;
          $_SESSION['num_ordine'] = mt_rand(10,99999999999);
          echo "<br>num ordine: ".$_SESSION['num_ordine'];
          echo "<br>cibi ordine: ".$_SESSION['cibi_ordine'];
          echo "<br>totale ordine: ".$_SESSION['totale_ordine'];
          echo "<br>punti ordine: ".$_SESSION['punti_ordine'];
          //inserisco ordine con query (le date vanno 'YYYY-MM-GG')
          $query = "INSERT INTO ordini(NumeroOrdine, Cibi, PrezzoTotale, IndirizzoOrdine, NumeroCarta, Scadenza, CVV, IDUtente) VALUES".
                                      "(' ".$_SESSION['num_ordine']." ', ' ".$_SESSION['cibi_ordine']." ',   ".$_SESSION['totale_ordine']."   , '  ".$_SESSION['indir_ordine']."  ',".$_POST['carta_ordine'].", '   ".$_POST['scadenza_ordine']."   ',".$_POST['cvv_ordine'].",".$_SESSION['user_id'].")";

          echo "<br>Query: ".$query;
          if($result = $conn->query($query)){ //se la query ha prodotto un risultato
            echo "<br>Ordine inserito correttamente";
          }
          //aggiorno punti totali all'utente
          $punti_tot=$_SESSION['punti']+$_SESSION['punti_ordine'];
          $query = "UPDATE members SET `PuntiAccumulati`=".$punti_tot." WHERE `id`=".$_SESSION['user_id'];
          if($result = $conn->query($query)){ //se la query ha prodotto un risultato
            echo "<br>Punti aggiunti correttamente";
            $_SESSION['punti'] = $punti_tot;
          }
          //cancello il carrello e le variabili di sessione
          unset( $_SESSION['carrello'] ); //devo fare l'unset oppure l'isset() del menu non crea di nuovo il carrello
          $_SESSION['totale_ordine'] = 0;
          $_SESSION['punti_ordine'] = 0;
          $_SESSION['cibi_ordine'] = "";
        }
      }
     ?>

    <div class = "row">

    <div class="tips">
      Payment card number: (4) VISA, (51 -> 55) MasterCard, (36-38-39) DinersClub, (34-37) American Express, (65) Discover, (5019) DanKort
    </div>

    </br>
    <h2>Inserisci i tuoi dati di pagamento</h2></br>

    <div class="container">
      <div class="col1">
        <div class="paycard">
          <div class="front">
            <div class="type">
              <img class="bankid"/>
            </div>
            <span class="chip"></span>
            <span class="card_number">&#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; </span>
            <div class="date"><span class="date_value">YYYY-MM-GG</span></div>
            <span class="fullname">Nome Cognome</span>
          </div>
          <div class="back">
            <div class="magnetic"></div>
            <div class="bar"></div>
            <span class="seccode">&#x25CF;&#x25CF;&#x25CF;</span>
            <span class="chip"></span><span class="disclaimer">This card is property of Random Bank of Random corporation. <br> If found please return to Random Bank of Random corporation - 47521, via Boccaquattro, 3 Cesena </span>
          </div>
        </div>
      </div>
      <div class="col2">
        <label>Numero carta</label>
        <input id="c_num" class="number" type="text" placeholder="0000 0000 0000 0000" ng-model="ncard" maxlength="19" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
        <label>Proprietario carta</label>
        <input id="c_name" class="inputname" type="text" placeholder="Nome Cognome"/>
        <label>Scadenza</label>
        <input id="c_date" class="expire" type="text" placeholder="YYYY-MM-GG"/>
        <label>CVV</label>
        <input id="c_cvv" class="ccv" type="text" placeholder="CVV" maxlength="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
        <button class="buy" onclick="sim_pagamento()" ><i class="material-icons">lock</i> Pay <?php echo $_SESSION['totale_ordine']; ?> €</button>
      </div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'></script>
    <script src="js/payment.js"></script>
    </div>

    <script>
      function body_loaded() {
        //carico i dati della carta
        if ( "<?php echo $_SESSION['nome'] ?>" != "guest") {  //guest non visualizza nulla
          document.getElementById("c_num").value = "<?php echo $_SESSION['carta']?>";
          document.getElementById("c_name").value = "<?php echo $_SESSION['nome']." ".$_SESSION['cognome'] ?>";
          document.getElementById("c_date").value = "<?php echo $_SESSION['scadenza']?>";
          document.getElementById("c_cvv").value = "<?php echo $_SESSION['cvv'] ?>";
          //aggiorno la carta triggerando manualmente il keyup event
          $( "#c_num" ).keyup();
          $( "#c_name" ).keyup();
          $( "#c_date" ).keyup();
          $( "#c_cvv" ).keyup();
        }
      }

      function sim_pagamento(){
        //controllo campi non vuoti
        if ( document.getElementById("c_num").value && document.getElementById("c_name").value && document.getElementById("c_date").value && document.getElementById("c_cvv").value ) {
          //chiamo me stesso lato server
          $.post('pagamento.php', { svuoto: true ,
                                    carta_ordine: document.getElementById("c_num").value.replace(/\s/g,'') , //rimpiazzo tolgo tutti gli spazi, deve diventare un nu
                                        scadenza_ordine: document.getElementById("c_date").value,
                                          cvv_ordine: document.getElementById("c_cvv").value  } , function(){ window.location.replace('fine.php'); });
          //post('pagamento.php', { svuoto: true ,
          //                          carta_ordine: document.getElementById("c_num").value.replace(/\s/g,'') , //rimpiazzo tolgo tutti gli spazi, deve diventare un nu
          //                              scadenza_ordine: document.getElementById("c_date").value,
          //                                cvv_ordine: document.getElementById("c_cvv").value  });
        } else { //se campi vuoti
            window.alert("Please set all fields");
        }
      }
    </script>

    <script src="js/payment.js"></script>

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
