<!DOCTYPE html>
<html lang="it">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
    <title>SitoCibo</title>
    <link rel="icon" href="resources/favicon.ico" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
      <h2>Pagina di gestione degli ordini.</h2>
    </header>
      <?php
        $query = "SELECT * FROM ordini";
        if($result = $conn->query($query)){
          while($row = $result->fetch_row()){
      ?>
            <div class = 'row'>
              <table>
                <tr>
                  <td><?php echo $row[0] ?></td>
                  <td><?php echo $row[1] ?></td>
                  <td><?php echo $row[2] ?></td>
                  <td><?php echo $row[4] ?></td>
                  <td><button onclick="consegna(<?php echo $row[4] ?>)">Consegna Ordine</button></td>
                </tr>
              </table>
            </div>
      <?php
          }
        } else {
          echo "Nessun dato trovato";
        }
      ?>
       <script type="text/javascript">
           function consegna(id){
             alert("Ordine "+id+" consegnato!");
           }
       </script>
    <?php
      $conn->close();
      } else {
        echo 'You are not authorized to access this page, please login. <br/>';
      }
    ?>
  </body>
</html>
