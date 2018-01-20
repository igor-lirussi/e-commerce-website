<!DOCTYPE html>
<html lang="it">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
    <script>
      function displayFunction() {

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
      $dbname = "secure_login";

      $conn = new mysqli($servername, $username, $password, $dbname);


      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
     ?>
    <header>
      <a href="home.html">
      <h1>SitoCibo</h1>
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
      //if(!empty($search)){
        $search = $_POST["search"];
        echo $search;
        $query = $conn->prepare("SELECT * FROM listino WHERE listino.Nome LIKE '%'?'%'");
        //if($query){
           // $result = $query->execute($search);
           // if(!$result){
           //   echo "Error";
           // }
        //}
        // if($query->bind_param('s', $search)){
        //   $query->execute();
        //   $result = $query->get_result();
        $result = mysqli_query($conn,$query);
          if(mysqli_num_rows($result)>0){

              while($row=mysqli_fetch_assoc($result)){
                echo "<p>".$row['Nome']."</p>";
                echo "<p>".$row['Descrizione']."</p>";
                echo "<p>".$row['Prezzo']."€</p>";
              }
          } else {
            echo "Nessun risultato trovato.";
          }
        //}
      ?>
    </div>

    <div class="row listino">
      <div class="col-4 pastiVeloci">
        <h3>Pasti Veloci</h3>
        <?php

          $query = "SELECT *
                    FROM listino
                    WHERE listino.Categoria ='Pasti Veloci'";
          $result = mysqli_query($conn,$query);

          if(mysqli_num_rows($result)>0){

              while($row=mysqli_fetch_assoc($result)){
                echo "<div class = 'offert fast'>";
                echo "<p>".$row['Nome']."</p>";
                echo "<p>".$row['Descrizione']."</p>";
                echo "<p>".$row['Prezzo']."€</p>";
                echo "</div>";
              }
        }
        ?>
      </div>

      <div class="col-4 primi">
        <h3>Primi</h3>
        <?php

          $query = "SELECT *
                    FROM listino
                    WHERE listino.Categoria ='Primi'";
          $result = mysqli_query($conn,$query);

          if(mysqli_num_rows($result)>0){

              while($row=mysqli_fetch_assoc($result)){
                echo "<div class = 'offert meal'>";
                echo "<p>".$row['Nome']."</p>";
                echo "<p>".$row['Descrizione']."</p>";
                echo "<p>".$row['Prezzo']."€</p>";
                echo "</div>";
              }
        }
        ?>
      </div>

      <div class="col-4 bevande">
        <h3>Bevande</h3>
        <?php

          $query = "SELECT *
                    FROM listino
                    WHERE listino.Categoria ='Bevande'";
          $result = mysqli_query($conn,$query);

          if(mysqli_num_rows($result)>0){

              while($row=mysqli_fetch_assoc($result)){
                echo "<div class = 'offert drink'>";
                echo "<p>".$row['Nome']."</p>";
                echo "<p>".$row['Descrizione']."</p>";
                echo "<p>".$row['Prezzo']."€</p>";
                echo "</div>";
              }
        }
        $conn->close();
        ?>
      </div>
    </div>

  </body>
</html>
