<!DOCTYPE html>
<html lang="it">

  <head>
    <meta charset="utf-8">
    <title>SitoCibo</title>
    <link rel="icon" href="resources/favicon.ico" />
  </head>

  <body>
    <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "databasesito";

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

    <h3>Pasti Veloci</h3>
    <div class="pastiVeloci">
      <?php

        $query = "SELECT *
                  FROM listino
                  WHERE listino.Categoria ='Pasti Veloci'";
        $result = mysqli_query($conn,$query);

        if(mysqli_num_rows($result)>0){

            while($row=mysqli_fetch_assoc($result)){
              echo "<p>".$row['Nome']."</p>";
              echo "<p>".$row['Descrizione']."</p>";
              echo "<p>".$row['Prezzo']."€</p>";
            }
      }
      ?>
    </div>

    <h3>Primi</h3>
    <div class="primi">
      <?php

        $query = "SELECT *
                  FROM listino
                  WHERE listino.Categoria ='Primi'";
        $result = mysqli_query($conn,$query);

        if(mysqli_num_rows($result)>0){

            while($row=mysqli_fetch_assoc($result)){
              echo "<p>".$row['Nome']."</p>";
              echo "<p>".$row['Descrizione']."</p>";
              echo "<p>".$row['Prezzo']."€</p>";
            }
      }
      ?>
    </div>

    <h3>Bevande</h3>
    <div class="bevande">
      <?php

        $query = "SELECT *
                  FROM listino
                  WHERE listino.Categoria ='Bevande'";
        $result = mysqli_query($conn,$query);

        if(mysqli_num_rows($result)>0){

            while($row=mysqli_fetch_assoc($result)){
              echo "<p>".$row['Nome']."</p>";
              echo "<p>".$row['Descrizione']."</p>";
              echo "<p>".$row['Prezzo']."€</p>";
            }
      }
      $conn->close();
      ?>
    </div>
  </body>
</html>
