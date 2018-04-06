<!DOCTYPE html>
<html lang="it">

  <head>
  </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
    <!-- per barra progressi -->
    <link rel="stylesheet" type="text/css" title="stylesheet" href="./css/progress.css">

    </script>
    <title>SitoCibo</title>
    <link rel="icon" href="resources/favicon.ico" />
  </head>

  <body>
    <?php
      include 'functions.php';
      include 'connection.php';
      error_reporting(~E_WARNING);
      sec_session_start();
      if(login_check($conn) == true) {
     ?>
    <header>
      <a href="home.html">
      <h1>Yook!</h1>
      </a>
      <h2>Menù</h2>
    </header>

    <!-- barra progressi -->
    <div class="checkout-wrap">
      <ul class="checkout-bar">
        <li class="active"><a href="#">Menù</a></li>
        <li class="">Luogo Consegna</li>
        <li class="">Carrello</li>
        <li class="">Pagamento</li>
        <li class="">Fine</li>
      </ul>
    </div>

    <h3>Cerca</h3>
      <form class="searchform" action="search.php" onsubmit="return displayFunction()" method="post">
        <input type="search" name="search" value="" placeholder="Inserisci ricerca qui..">
        <input type="submit">
      </form>

    <div class="row listino">
      <div class="col-4 pastiVeloci">
        <h3>Pasti Veloci</h3>
        <?php
          $query = "SELECT * FROM listino WHERE listino.Categoria ='Pasti Veloci'";
          if($result = $conn->query($query)){
            while($row = $result->fetch_row()){
              echo "<div class = 'offert fast'>";
              echo  "<div class = 'row prova'>";
              echo    "<div class = 'col-4'>";
              echo      "<img src = '".$row[5]."'>";
              echo    "</div>";
              echo    "<div class = 'col-8 desc'>";
              echo      "<p>".$row[1]."</p>";
              echo      "<p>".$row[3]."</p>";
              echo      "<p>".$row[4]."€</p>";
              echo      "<form action='menu.php' method='post'>
                          <input type='number' name='q".$row[0]."' max='100' value = 1>
                          <input type='submit' name='fast' value='Aggiungi al carrello'>
                        </form>";
              if (isset($_SESSION['carrello'][$row[0]])) {
                $q = @$_POST['q'.$row[0]];
                $p = $row[4] * $_SESSION['carrello'][$row[0]]['quantity'];
                $_SESSION['carrello'][$row[0]]['quantity'] += $q;
                $_SESSION['carrello'][$row[0]]['price'] = $p;
              } else {
                $_SESSION['carrello'][$row[0]] = array('quantity' => 0, 'price' => 0);
              }
              echo    "</div>";
              echo  "</div>";
              echo "</div>";
            }
          } else {
            echo "Nessun dato trovato";
          }
        ?>
      </div>

      <div class="col-4 primi">
        <h3>Primi</h3>
        <?php
          $query = "SELECT * FROM listino WHERE listino.Categoria ='Primi'";
          if($result = $conn->query($query)){
            while($row = $result->fetch_row()){
              echo "<div class = 'offert meal'>";
              echo  "<div class = 'row prova'>";
              echo    "<div class = 'col-4'>";
              echo      "<img src = '".$row[5]."'>";
              echo    "</div>";
              echo    "<div class = 'col-8 desc'>";
              echo      "<p>".$row[1]."</p>";
              echo      "<p>".$row[3]."</p>";
              echo      "<p>".$row[4]."€</p>";
              echo      "<form action='menu.php' method='post'>
                          <input type='number' name='q".$row[0]."' max='100' value = 1>
                          <input type='submit' name='fast' value='Aggiungi al carrello'>
                        </form>";
              if (isset($_SESSION['carrello'][$row[0]])) {
                $q = @$_POST['q'.$row[0]];
                $p = $row[4] * $q;
                $_SESSION['carrello'][$row[0]]['quantity'] += $q;
                $_SESSION['carrello'][$row[0]]['price'] = $p;
              } else {
                $_SESSION['carrello'][$row[0]] = array('quantity' => 0, 'price' => 0);
              }
              echo    "</div>";
              echo  "</div>";
              echo "</div>";
            }
          } else {
            echo "Nessun dato trovato";
          }
        ?>
      </div>

      <div class="col-4 bevande">
        <h3>Bevande</h3>
        <?php
          $query = "SELECT * FROM listino WHERE listino.Categoria ='Bevande'";
          if($result = $conn->query($query)){
            while($row = $result->fetch_row()){
              echo "<div class = 'offert drink'>";
              echo  "<div class = 'row prova'>";
              echo    "<div class = 'col-4'>";
              echo      "<img src = '".$row[5]."'>";
              echo    "</div>";
              echo    "<div class = 'col-8 desc'>";
              echo      "<p>".$row[1]."</p>";
              echo      "<p>".$row[3]."</p>";
              echo      "<p>".$row[4]."€</p>";
              echo      "<form action='menu.php' method='post'>
                          <input type='number' name='q".$row[0]."' max='100' value = 1>
                          <input type='submit' name='fast' value='Aggiungi al carrello'>
                        </form>";
              if (isset($_SESSION['carrello'][$row[0]])) {
                $q = @$_POST['q'.$row[0]];
                $p = $row[4] * $q;
                $_SESSION['carrello'][$row[0]]['quantity'] += $q;
                $_SESSION['carrello'][$row[0]]['price'] = $p;
              } else {
                $_SESSION['carrello'][$row[0]] = array('quantity' => 0, 'price' => 0);
              }
              echo    "</div>";
              echo  "</div>";
              echo "</div>";
            }
          } else {
            echo "Nessun dato trovato";
          }
        $conn->close();
      } else {
         echo 'You are not authorized to access this page, please login. <br/>';
         echo "<a href='accedi.php'>Accedi</a>";
      }
        ?>
      </div>
    </div>
    <form class="" action="cart.php" method="post">
      <input type="submit" name="cart" value="Vai al carrello">
    </form>
  </body>
</html>
