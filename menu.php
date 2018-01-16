<!DOCTYPE html>
<html lang="it">

  <head>
    <meta charset="utf-8">
    <title>SitoCibo</title>
    <link rel="icon" href="resources/favicon.ico" />
                  <style>
                    input[type=search] {
                        width: 130px;
                        box-sizing: border-box;
                        border: 2px solid #ccc;
                        border-radius: 4px;
                        font-size: 16px;
                        background-color: white;
                        background-image: url('resources/searchicon.png');
                        background-position: 10px 10px;
                        background-repeat: no-repeat;
                        padding: 12px 20px 12px 40px;
                        -webkit-transition: width 0.4s ease-in-out;
                        transition: width 0.4s ease-in-out;
                    }

                    input[type=search]:focus {
                        width: 100%;
                    }
                  </style>
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

    <h3>Cerca</h3>
    <form class="searchform" action="menu.php" method="post">
      <input type="search" name="search" value="" placeholder="Inserisci ricerca qui..">
      <input type="submit">
    </form>

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
