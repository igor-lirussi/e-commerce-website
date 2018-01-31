<!DOCTYPE html>
<html lang="it">

  <head>
  </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
    <script>
      function addFast(var quant) {
      }
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
      <h2>Menù</h2>
    </header>

    <h3>Cerca</h3>
    <form class="searchform" action="menu.php" onsubmit="return displayFunction()" method="post">
      <input type="search" name="search" value="" placeholder="Inserisci ricerca qui..">
      <input type="submit">
    </form>
    <div class="searchresult">  <!-- DA SPOSATRE TUTTO QUESTO DIV IN UNO SCRIPT CHE SI VISUALIZZA SOLO SE E' STATO PREMUTO IL PULSANTE DELLA RICERCA -->
      <?php
        if($query = $conn->prepare("SELECT * FROM listino WHERE Nome LIKE '%'?'%'")){ //NON FUNZIONA PER VIA DI SBAGLIATA COMBINAZIONE DI % E ?
          $search = $_POST["search"];
          $query->bind_param('s', $search);
          $query->execute();
          echo "after execute";
          $result = $query->get_result();
          echo "before while";
          while($row = $result->fetch_assoc()){
            echo "ciao";
            echo "<p>".$row[1]."</p>";
            echo "<p>".$row[3]."</p>";
            echo "<p>".$row[4]."€</p>";
          }
          echo $row. "  ";
          echo "after while";
        } else {
          echo "Query non andata a buon fine";
        }
      ?>
    </div>

    <div class="row listino">
      <div class="col-4 pastiVeloci">
        <h3>Pasti Veloci</h3>
        <?php
          // if($query = $conn->prepare("SELECT * FROM listino WHERE listino.Categoria ='Pasti Veloci'")){
          //   $query->execute();
          //   if($query->num_rows == 1){
          //     while($row = mysqli_fetch_assoc($query)){
          //       echo "<div class = 'offert fast'>";
          //       echo "<p>".$row['Nome']."</p>";
          //       echo "<p>".$row['Descrizione']."</p>";
          //       echo "<p>".$row['Prezzo']."€</p>";
          //       echo "</div>";
          //     }
          //   } else {
          //     echo "Nessun dato trovato";
          //   }
          // } else {
          //   echo "Query non esguita";
          // }
          $query = "SELECT * FROM listino WHERE listino.Categoria ='Pasti Veloci'";
          if($result = $conn->query($query)){
            while($row = $result->fetch_row()){
              echo "<div class = 'offert fast'>";
              echo "<div class = 'row'>";
              echo "<div class = 'col-4'>";
              echo    "<img src = '".$row[5]."'>";
              echo "</div>";
              echo "<div class = 'col-8 desc'>";
              echo    "<p>".$row[1]."</p>";
              echo    "<p>".$row[3]."</p>";
              echo    "<p>".$row[4]."€</p>";
              echo "<form action='menu.php' method='post'>
                      <input type='number' name='qfast' max='100' value = 1>
                      <input type='button' name='fast' value='Aggiungi al carrello'>
                    </form>";
                    echo "</div>";
              echo "</div>";
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
          // if($query = $conn->prepare("SELECT * FROM listino WHERE listino.Categoria ='Primi'")){
          //   $query->execute();
          //   if($query->num_rows == 1){
          //     while($row=mysqli_fetch_assoc($result)){
          //       echo "<div class = 'offert meal'>";
          //       echo "<p>".$row['Nome']."</p>";
          //       echo "<p>".$row['Descrizione']."</p>";
          //       echo "<p>".$row['Prezzo']."€</p>";
          //       echo "</div>";
          //     }
          //   }
          // }
          $query = "SELECT * FROM listino WHERE listino.Categoria ='Primi'";
          if($result = $conn->query($query)){
            while($row = $result->fetch_row()){
              echo "<div class = 'offert meal'>";
              echo "<div class = 'row'>";
              echo "<div class = 'col-4'>";
              echo    "<img src = '".$row[5]."'>";
              echo "</div>";
              echo "<div class = 'col-8 desc'>";
              echo    "<p>".$row[1]."</p>";
              echo    "<p>".$row[3]."</p>";
              echo    "<p>".$row[4]."€</p>";
              echo "<form action='menu.php' method='post'>
                      <input type='number' name='qmeal' max='100' value = 1>
                      <input type='button' name='fast' value='Aggiungi al carrello'>
                    </form>";
                    echo "</div>";
              echo "</div>";
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
          // if($query = $conn->prepare("SELECT * FROM listino WHERE listino.Categoria ='Bevande'")){
          //   $query->execute();
          //   if($query->num_rows == 1){
          //     while($row=mysqli_fetch_assoc($result)){
          //       echo "<div class = 'offert drink'>";
          //       echo "<p>".$row['Nome']."</p>";
          //       echo "<p>".$row['Descrizione']."</p>";
          //       echo "<p>".$row['Prezzo']."€</p>";
          //       echo "</div>";
          //     }
          //   }
          // }
          $query = "SELECT * FROM listino WHERE listino.Categoria ='Bevande'";
          if($result = $conn->query($query)){
            while($row = $result->fetch_row()){
              echo "<div class = 'offert drink'>";
              echo  "<div class = 'row'>";
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
              $indq = $_POST['q'.$row[0]];
              echo $indq;
              if(isset($_SESSION['cart'][$row[0]])){
                echo "ciao";
                echo $indq;
                for ($i=0; $i < $indq; $i++) {
                  echo "ciao in for";
                  $_SESSION['cart'][$row[0]]++;
                  print_r($_SESSION['cart'][$row[0]]);
                }
              }else{
                echo "ciao mai inizializzato";
                $_SESSION['cart'] = array($row[0] => $indq);
                print_r($_SESSION['cart'][$row[0]]);
                print_r($_SESSION['cart']);
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
      }
        ?>
      </div>
    </div>
    <form class="" action="cart.php" method="post">
      <input type="submit" name="cart" value="Vai al carrello">
    </form>
  </body>
</html>
