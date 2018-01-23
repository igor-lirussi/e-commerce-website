<!DOCTYPE html>
<html lang="it">

  <head>
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
      $servername = "localhost";
      $username = "sec_user";
      $password = "gtTsfOlrsGRi";
      $dbname = "databasesito";

      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      session_start();
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
    <div class="searchresult">
      <?php
        if($query = $conn->prepare("SELECT * FROM listino WHERE listino.Nome LIKE ?")){
          $search = $_POST["search"];
          $query->bind_param('s', $search);
          $query->execute();
          echo "after execute";
          $result = $query->get_result();
          echo "before while";
          while($row = $result->fetch_row()){
            echo "ciao";
            echo "<p>".$row[1]."</p>";
            echo "<p>".$row[3]."</p>";
            echo "<p>".$row[4]."€</p>";
          }
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
              echo "<p>".$row[1]."</p>";
              echo "<p>".$row[3]."</p>";
              echo "<p>".$row[4]."€</p>";
        ?>
        <form class="" action="menu.php" method="post">
          <input type="number" name="quantity" max="100">
          <input type="button" name="fast" value="Aggiungi al carrello" onclick="addFast()">
        </form>
        <?php
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
              echo "<p>".$row[1]."</p>";
              echo "<p>".$row[3]."</p>";
              echo "<p>".$row[4]."€</p>";
              echo "<button type='button' name=".$row[3].">Aggiungi al carrello</button>";
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
              echo "<p>".$row[1]."</p>";
              echo "<p>".$row[3]."</p>";
              echo "<p>".$row[4]."€</p>";
              echo "<button type='button' name=".$row[3].">Aggiungi al carrello</button>";
              echo "</div>";
            }
          } else {
            echo "Nessun dato trovato";
          }
        $conn->close();
        ?>
      </div>
    </div>
    <form class="" action="cart.php" method="post">
      <input type="submit" name="cart" value="Vai al carrello">
    </form>
    <!-- <?php
      echo $_POST['quantity'];
        $_SESSION['quantity'];
    ?> -->
  </body>
</html>
