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
  </head>

  <body>
    <div id="not-footer">

    <header>
      <a href="home.html">
      <h1>Yook!</h1>
      </a>
      <h2>Accedi</h2>
      <p>Accumula punti e ottieni fantastiche ricompense!</p>
    </header>
    <?php
      if(isset($_GET['error'])) {
        if($_GET['error']==1) {
          echo 'Error Logging In! Try again!';
        } else {
          echo 'Error unknown passed';
        }
      }
      if(isset($_GET['register'])) {
        echo 'Registration successfull';
      }

    ?>

    <fieldset> <legend><h2>i tuoi dati personali:</h2></legend>
    <form action="process_login.php" method="post" name="login_form">
   <p><label for="ema">Email:
     <input type="text" id="ema" name="email" autocomplete="on"
     placeholder="inserisci email" required/></label>
   </p>
   <p><label for="password">Password:
      <input type="password" name="p" id="password"
      placeholder="inserisci password" required /></label>
    </p>
   <input type="button" value="Accedi" onclick="formhash(this.form, this.form.password);" />

    </form>
    <br/>Non hai ancora un account? <br/>
    <a href="registrati.html">Registrati!</a>
  </fieldset>

  </div>

  <footer>
    <p>Posted by: </p>
    <p>Contact information: <a href="mailto:someone@example.com">
    someone@example.com</a>.</p>
    </footer>
  </body>
</html>
