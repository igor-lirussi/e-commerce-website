<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <title>Accedi</title>
    <link rel="icon" href="resources/favicon.ico" />
    <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="./js/sha512.js"></script>
    <script type="text/javascript" src="./js/forms.js"></script>
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
              if(isset($_GET['error'])) {
                if($_GET['error']==1) {
                  echo '<i class="fas fa-exclamation-triangle"></i> <h1>Error Logging In!<br/>Try again!</h1>';

                } else if($_GET['error']==2) {
                  echo '<i class="fas fa-envelope"></i> <h1>An e-mail to your account has been sent!</h1>';
                  echo 'Please log-in with the new password';

                } else if($_GET['error']==3) {
                  echo '<i class="fas fa-sign-out-alt"></i> <h1>Successfully logged-out!</h1>';
                  echo 'Next time log-in will be required';

                } else {
                  echo '<i class="fas fa-exclamation-triangle"></i> <h1> Error unknown </h1>';
                }
              }
              if(isset($_GET['register'])) {
                echo '<i class="fas fa-thumbs-up"></i> <h1>Registration successfull</h1>  8 points gained!';
              }
            ?></div>
        </div>
      </div>
    </div>

    <div id="not-footer">

    <header>
      <a href="home.html">
      <h1>Yook!</h1>
      </a>
      <h2>Accedi</h2>
      <p>Accumula punti e ottieni fantastiche ricompense!</p>
    </header>




    <fieldset> <legend><h2>i tuoi dati personali:</h2></legend>
    <form action="process_login.php" method="post" name="login_form">
       <p><label for="ema">Email:
         <input type="text" id="ema" name="email" autocomplete="on"
         placeholder="inserisci email" required/></label>
       </p>
       <p><label for="password">Password:
          <input type="password" name="p" id="password"
          placeholder="inserisci password" required />
            <?php
              if(isset($_GET['error'])) {
              if($_GET['error']==1) {
                echo '<div class="tip"> Forgot your password? Send an <a href="accedi.php?error=2">e-mail</a></div>';
              }}
            ?>
          </label>
        </p>
        <input type="button" value="Accedi" onclick="formhash(this.form, this.form.password);" /> <!-- se l'utente accede con admin@admin.com, pw:admin, viene rediretto sulla pagina dell'amministratore -->
    </form>
    <br/>Non hai ancora un account? <br/>
    <a href="registrati.html">Registrati!</a>
  </fieldset>

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
  </body>
</html>
