<!DOCTYPE html>
<html lang="it">

  <head>
    <meta charset="utf-8">
    <title>Yook</title>
    <link rel="icon" href="resources/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
    <!-- per i grafici -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  </head>



  <body>

  <!-- il not-footer serve per il footer statico -->
  <div id="not-footer">

    <header>
      <a href="home.php">
      <h1>Yook!</h1>
      </a>
      <h2>Make it Yours.</h2>
      <p>Grafico degli utenti</p>
    </header>


    <div class="row">
      <!-- Identify the chart. -->
      <div id="firstChart"/>
    </div>
    <div class="row">
      <form class="" action="amministra.php" method="post" style="background-color:grey">
        <button class="btn third">Torna al pannello amministrazione</button>
      </form>
    </div>

    <!-- fine non footer -->
    </div>
    <footer>
      <?php
        include 'footer.php';
        print_footer();
      ?>
    </footer>

  </body>




  <script type="text/javascript">
    //script grafici google
    google.charts.load('current', {packages: ['corechart'], 'language': 'it'});
       google.charts.setOnLoadCallback(drawChart);

       function drawChart() {
         // Define the chart to be drawn.
         var data = new google.visualization.DataTable();
         data.addColumn('string', 'Nome');
         data.addColumn('number', 'Punti');
         //apro il php, da questo dovranno uscire solo righe: data.addRow([stringhere, valuehere]);
         <?php
              //carico l'xml
              $xml = simplexml_load_file("users.xml");
              //conto gli user per l'altezza del grafico
              echo "var my_height_graph = 60 * ".count($xml->user);
              // per ogni user stampo il comando di aggiungi riga
              foreach ($xml->user as $user) {
                echo "
                  data.addRow(["
                  ."'".$user['surname']." (id:".$user['id'].")'"  //qui stringa
                  .","
                  .$user['punti'] //qui valore
                  ."]);";
              }
          ?>


         // Set chart options
               var options = {title : "Seleziona un utente per più informazini.",
                              'height':my_height_graph,
                              animation:{
                                duration: 2000,
                                easing: 'out',
                                startup: true,
                              },
                              'colors': ['red','#004411'],
                              'legend':'bottom'};
         // Instantiate and draw the chart.
         var chart = new google.visualization.BarChart(document.getElementById('firstChart'));
         chart.draw(data, options);
       }
     </script>
</html>
