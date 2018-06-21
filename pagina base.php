<!DOCTYPE html>
<html lang="it">

  <head>
    <meta charset="utf-8">
    <title>Yook</title>
    <link rel="icon" href="resources/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">

  </head>

  <body >

  <!-- il not-footer serve per il footer statico -->
  <div id="not-footer">

    <header>
      <a href="home.php">
      <h1>Yook!</h1>
      </a>
      <h2>Pagina base</h2>
      <p>sottotitolo eventuale</p>
    </header>


    <div class = "row">
      <div class="col-3">
        <!-- cose -->
      </div>
      <div class="col-9">
        <!-- cose -->
      </div>
    </div>


    </div>
    <footer>
      <?php
        include 'footer.php';
        print_footer();
      ?>
    </footer>
  </body>

</html>
