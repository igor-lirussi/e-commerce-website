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
      <a href="home.html">
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
            <div class="date"><span class="date_value">MM / YYYY</span></div>
            <span class="fullname">FULL NAME</span>
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
        <label>Card Number</label>
        <input id="c_num" class="number" type="text" ng-model="ncard" maxlength="19" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
        <label>Cardholder name</label>
        <input id="c_name" class="inputname" type="text" placeholder=""/>
        <label>Expiry date</label>
        <input id="c_date" class="expire" type="text" placeholder="MM / YYYY"/>
        <label>Security Number</label>
        <input id="c_cvv" class="ccv" type="text" placeholder="CVC" maxlength="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
        <button class="buy" onclick="window.location.href='./fine.php'" ><i class="material-icons">lock</i> Pay <?php echo $_SESSION['totale']; ?> €</button>
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
