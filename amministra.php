<!DOCTYPE html>
<html lang="it">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
    <link href="./notify/node_modules/pnotify/dist/PNotifyBrightTheme.css" rel="stylesheet" type="text/css" /> <!-- includo il foglio di stile relativo al tema Bright per le notifiche-->
    <title>SitoCibo</title>
    <link rel="icon" href="resources/favicon.ico" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="./notify/node_modules/pnotify/lib/iife/PNotify.js"></script><!-- includo lo script PNotify che mi permetterà di far apparire le notifiche-->
    <script type="text/javascript">
      function showStackTopLeft() {
        /*if (typeof window.stackTopLeft === 'undefined') {
          window.stackTopLeft = {
            'dir1': 'down',
            'dir2': 'right',
            'firstpos1': 25,
            'firstpos2': 25,
            'push': 'top'
          };
        }
        var opts = {
          title: 'Il tuo ordine è stato spedito!',
          text: "Entro poco tempo vedrai arrivare all'indirizzo da te indicato il tuo gustosissimo pasto",
          type: 'success',
          stack: window.stackTopLeft
        };
        PNotify.alert(opts);*/
        PNotify.notice({
          title: 'Custom Styling',
          text: 'I have an additional class that\'s used to give me special styling. I always wanted to be pretty.',
          //styling: {},
          addClass: 'custom',
          icon: 'far fa-file-image fa-3x'
        });
      }
    </script>
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
        <a href="amministra_menu.php"><img src="resources/menu_con_logo.png" alt="menu"></a>
      </div>
      <div class = "col-5 link2">
        <a href="chart.php"><img src="resources/grafico.png" alt="grafico"></a>
        <form class="" action="amministra_ordini.php" method="post">
          <input type="submit" id="ordini" value = "Vai agli ordini degli utenti">
        </form>
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
