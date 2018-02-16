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
    <!-- per il paypal -->
  <script src="https://www.paypalobjects.com/api/checkout.js"></script>
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
        <li><a href="story.html">La nostra storia</a></li>
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
            <li class="visited">Carrello</li>
            <li class="active">Pagamento</li>
            <li class="">Fine</li>
          </ul>
        </div>


    <div class = "row">
      <!-- PayPal Logo -->
      <table border="0" cellpadding="10" cellspacing="0" align="center"><tr><td align="center"></td></tr>
      <tr><td align="center"><a href="https://www.paypal.com/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open('https://www.paypal.com/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;">
        <img src="https://www.paypalobjects.com/webstatic/mktg/logo/bdg_now_accepting_pp_2line_w.png" border="0" alt="Now Accepting PayPal"></a></td></tr></table>
        <!-- PayPal Logo -->

          <iframe src="https://www.paypal.com/webapps/hermes/button?version=4&amp;env=production&amp;style.size=medium&amp;style.layout=vertical&amp;funding.allowed=credit,venmo&amp;sessionID=46171950e0&amp;locale.x=en_US&amp;logLevel=warn&amp;uid=f6713002fd&amp;xcomponent=1" width="250" height="173" frameborder="0"></iframe>
          <div id="paypal-button"></div>

           <script>
             paypal.Button.render({
               env: 'production', // Or 'sandbox',

               commit: true, // Show a 'Pay Now' button

               style: {
                 color: 'gold',
                 size: 'small'
               },

               payment: function(data, actions) {
                 /*
                  * Set up the payment here
                  */
               },

               onAuthorize: function(data, actions) {
                 /*
                  * Execute the payment here
                  */
               },

               onCancel: function(data, actions) {
                 /*
                  * Buyer cancelled the payment
                  */
               },

               onError: function(err) {
                 /*
                  * An error occurred during the transaction
                  */
               }
             }, '#paypal-button');
           </script>
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
