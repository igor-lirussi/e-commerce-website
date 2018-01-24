<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <title>Accedi</title>
    <link rel="icon" href="resources/favicon.ico" />
    <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="sha512.js"></script>
    <script type="text/javascript" src="forms.js"></script>
  </head>

  <body>
    <header>
      <a href="home.html">
      <h1>Yook!</h1>
      </a>
      <h2>Accedi</h2>
      <p>Accumula punti e ottieni fantastiche ricompense!</p>
    </header>
    <?php
      if(isset($_GET['error'])) {
        echo 'Error Logging In! Try again!';
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

  <footer>
    <p>Posted by: </p>
    <p>Contact information: <a href="mailto:someone@example.com">
    someone@example.com</a>.</p>
    </footer>
  </body>
</html>
