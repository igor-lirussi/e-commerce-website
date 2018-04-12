<!DOCTYPE html>
<html lang="it">

  <head>
  </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script>
      $(document).ready(function(){
        $(".nascondi").hide();
      });
    </script>
    <title>SitoCibo</title>
    <link rel="icon" href="resources/favicon.ico" />
  </head>

  <body>
    <?php
      include 'functions.php';
      include 'connection.php';
      sec_session_start();
      if(login_check($conn) == true) {
     ?>
    <header>
      <a href="home.html">
      <h1>Yook!</h1>
      </a>
      <h2>Pagina di gestione del sito.</h2>
    </header>
    <div class="col-12 admin">
      <div class = "col-5 link1">
        <a href="amministra_menu.php"><img src="resources/menu_con_logo.png" alt="menu" href="amministra_menu.php"></a>
      </div>
      <div class = "col-5 link2">
        <a href="chart.php"><img src="resources/grafico.png" alt="grafico"></a>
      </div>
    </div>
    <?php
      $conn->close();
      } else {
        echo 'You are not authorized to access this page, please login. <br/>';
      }
    ?>
  </body>
</html>
