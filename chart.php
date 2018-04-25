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
      <a href="home.html">
      <h1>Yook!</h1>
      </a>
      <h2>Make it Yours.</h2>
      <nav>
      <ul>
        <li><a href="ourFood.html">Il nostro cibo</a></li>
        <li><a href="ourStory.html">La nostra storia</a></li>
        <li><a href="#">Location</a></li>
        <li><a href="#">Contattaci</a></li>
      </ul>
      </nav>
    </header>



    <div class="row">
      <!-- Identify the chart. -->
        <div id="firstChart"/>
    </div>
    <a href="amministra.php">Torna alla pagina iniziale</a>
    <!-- fine non footer -->
    </div>
    <footer>
      <address>
            <p>
                Copyright 2018 <strong>Yook S.r.l.</strong><br>
                Via Albert Einstein n. 3, 48018 Faenza (RA)<br>
                <a href="mailto:info@Yook.it">info@Yook.it</a>
            </p>
            <p>
                P.Iva: 02684269693 - REA: RA-526419
                <br>
                Cap. Soc. 10.000€ e riserve in conto capitale per un totale di 101.000€ interamente versati.
            </p>
            <p>
                <a id="footer_InfoLegali" href="info_legali.html">Info Legali</a> | <a id="footer_PrivacyPolicy" href="privacy_policy.html">Privacy</a>
            </p>
      </address>
    </footer>

  </body>

<script type="text/javascript">

google.charts.load('current', {packages: ['corechart'], 'language': 'it'});
   google.charts.setOnLoadCallback(drawChart);

   function drawChart() {
     // Define the chart to be drawn.
     var data = new google.visualization.DataTable();
     data.addColumn('string', 'Name');
     data.addColumn('number', 'Points');
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
              ."'".$user['surname']." id:".$user['id']."'"  //qui stringa
              .","
              .$user['punti'] //qui valore
              ."]);";
          }
      ?>


     // Set chart options
           var options = {'title':'Points of people registered in this site',
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
