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
    <!-- per il pulsante bollicinoso, in fondo alla pagina c'è lo script -->
    <link rel="stylesheet" type="text/css" title="stylesheet" href="./css/bubbly.css">
    <!-- per input text figo -->
    <link rel="stylesheet" type="text/css" title="stylesheet" href="./css/inp_text.css">
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
      <a href="home.php">
      <h1>Yook!</h1>
      </a>
      <h2>Accedi</h2>
      <p>Accumula punti e ottieni fantastiche ricompense!</p>
    </header>


<div class="row easy2sfondo">
  <div class="col-6 allright">
    <br>
    <div class="logga">
      <fieldset> <legend><h2>Login</h2></legend>
      <form action="process_login.php" method="post" name="login_form">
         <p><label for="ema">Email
           <div class='cont_inp'><span><input class='gate' type="text" id="ema" name="email" autocomplete="on" placeholder="inserisci email" required /><label for='class'>Email</label></span></div>
           <!-- <input type="text" id="ema" name="email" autocomplete="on" placeholder="inserisci email" required/></label> -->
         </p>
         <p><label for="password">Password
           <div class='cont_inp'><span><input class='gate' type="password" name="p" id="password" placeholder="inserisci password" required /><label for='class'>Password</label></span></div>
            <!-- <input type="password" name="p" id="password" placeholder="inserisci password" required /> -->
              <?php
                if(isset($_GET['error'])) {
                if($_GET['error']==1) {
                  echo '<div class="tip"> Forgot your password? Send an <a href="accedi.php?error=2">e-mail</a></div>';
                }}
              ?>
            </label>
          </p>
          <button class="bubbly-button" onclick="formhash(this.form, this.form.password);">Accedi <i class="fas fa-sign-in-alt"></i></button>
           <!-- se l'utente accede con admin@admin.com, pw:admin, viene rediretto sulla pagina dell'amministratore -->
      </form>

      </fieldset>
    </div>
    <br>
  </div>

  <div class="col-6 allleft">
    <br><br><br>
    <div class="registra">
      <fieldset> <legend><h2>Registrati</h2></legend>
        <form class="" action="registrazione.php" method="post">
          <br/><h3>Non hai ancora un account? </h3>  <br/>
          Con la registrazione puoi accumulare punti e salvare i tuoi dati!
          <br>
          <button class="bubbly-button">Registrati <i class="fas fa-user-plus"></i></button>
        </form>
      </fieldset>
    </div>

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
