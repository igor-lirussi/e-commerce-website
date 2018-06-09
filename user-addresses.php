<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <title>Indirizzo Utenti</title>
    <link rel="icon" href="resources/favicon.ico" />
    <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">

  </head>

  <body>
    <header>
      <a href="home.php">
      <h1>Yook!</h1>
      </a>
      <h2>Posizione Utenti</h2>
    </header>


    <?php
      include 'connection.php';


      // Set the active MySQL database

      $db_selected = mysqli_select_db($conn, $dbname);
      if (!$db_selected) {
        die ('Can\'t use db : ' . mysql_error());
      }

      // Select all the rows in the markers table

      $query = "SELECT * FROM members WHERE 1";
      $result = mysqli_query($conn, $query);
      if (!$result) {
        die('Invalid query: ' . mysql_error());
      }

      // Start XML file
      $xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><users></users>');

      while($row = mysqli_fetch_array($result)){
        $marker = $xml->addChild("user");
        $marker->addAttribute("id", $row['id'] );
        $marker->addAttribute("punti", $row['PuntiAccumulati'] );
        $marker->addAttribute("address", $row['Indirizzo'] );
        $marker->addAttribute("surname", $row['Cognome'] );
        $marker->addAttribute("name", $row['Nome'] );
      }
      //salvo l'xml nella stringa
      $notformattedXML = $xml->asXML();
      //formatto bene xml
      $dom = new DOMDocument();
      $dom->loadXML($notformattedXML);
      $dom->formatOutput = true;
      $formattedXML = $dom->saveXML();

      //per il debug posso stampare direttamente nel codice della pagina l'XML
      //echo $formattedXML;

      //scrivo l'xml nel file
      $fp = fopen("users.xml", "w+");
      if(!$fp) die ("Errore nell'operazione con il file xml");

      fwrite($fp, $formattedXML);
      fclose($fp);
    ?>



    <div id="io" class="center"><h3>Indirizzo residenza degli utenti</h3></div>
    <div id="map"></div>





            <script>
            //customLabel non usato ma in caso è qui
            var customLabel = {
              restaurant: {
                label: 'R'
              },
              bar: {
                label: 'B'
              }
            };
            // script per la mappa
            var map;
            var pos;
              function initMap() {

                var infoWindow = new google.maps.InfoWindow; //le infowindow verranno modificate per ogni posto in seguito
                // posto principale
                pos = {lat: 44.1383845, lng: 12.2433957 };
                // creo mapp
                map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 15,//minimo 18 per avere il tilt
                  center: pos,
                  streetViewControl: false, //niente omino street view
                  mapTypeId: 'hybrid', //solo ibrida o satellite per il tilt
                  tilt: 45, //45 quando possibile

                });
                // creo il marker della base
                var markerbase = new google.maps.Marker({
                  position: pos,
                  map: map,
                  title: "Negozio",
                  animation: google.maps.Animation.BOUNCE,
                  icon: './resources/flag.png'
                });
                markerbase.setVisible(true);




                downloadUrl('users.xml', function(data) {
                  var geocoder = new google.maps.Geocoder();
                  var xml = data.responseXML;
                  var markers = xml.documentElement.getElementsByTagName('user');
                  //ciclo i markers della mappa
                  Array.prototype.forEach.call(markers, function(markerElem) {
                    //ottengo per ognuno i dati
                    var name = markerElem.getAttribute('name');
                    var surname = markerElem.getAttribute('surname');
                    var address = markerElem.getAttribute('address');
                    var id = markerElem.getAttribute('id');
                    //infoWindow
                    var infowincontent = document.createElement('div');
                    var strong = document.createElement('strong');
                    strong.textContent = name + " " + surname
                    infowincontent.appendChild(strong);
                    infowincontent.appendChild(document.createElement('br'));
                    var text = document.createElement('text');
                    text.textContent = address
                    infowincontent.appendChild(text);
                    //FUNZIONE Geocode
                    function geocodeAddress(geocoder, address) {
                      geocoder.geocode({'address': address}, function(results, status) {
                        if (status === 'OK') {
                            //se riesce a fare il geocoding mette il marker nella mappa
                            var marker = new google.maps.Marker({
                              map: map,
                              animation: google.maps.Animation.DROP,
                              title: "Fai click per info",
                              position:  results[0].geometry.location
                              //label: id
                            });
                            //al marker collego la infoWindow
                            marker.addListener('click', function() {
                              infoWindow.setContent(infowincontent);
                              infoWindow.open(map, marker);
                            });
                            return;
                        } else {
                          alert('Geocode was not successful for the following reason: ' + status);
                        }
                      });
                    }

                    //geocode address
                    geocodeAddress(geocoder, address);

                    //aspetta
                    var milliseconds = 250;
                    var start = new Date().getTime();
                    for (var i = 0; i < 1e7; i++) {
                      if ((new Date().getTime() - start) > milliseconds){
                        break;
                      }
                    }

                  });

                });

              } //fine init map




              //FUNZIONE PER LA ROBA XML
              function doNothing() {};
              function downloadUrl(url,callback) {
                   var request = window.ActiveXObject ?
                       new ActiveXObject('Microsoft.XMLHTTP') :
                       new XMLHttpRequest;
                   request.onreadystatechange = function() {

                     if (request.readyState == 4) {
                       request.onreadystatechange = doNothing;
                       callback(request, request.status);
                     }
                   };

                   request.open('GET', url, true);
                   request.send(null);
                  }



            </script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBinnhjlVy7a2RxTETHiw0LrCByGnrZKnQ&libraries=places&callback=initMap"
                    async defer></script>




    <footer>
      <address>
            <p>
                Copyright 2018 <strong>Yook S.r.l.</strong><br>
                Piazza Fabbri n.5, Cesena 47521 (FC), Italia<br>
                <a href="mailto:info@Yook.it">info@Yook.it</a>
            </p>
            <p>
                P.Iva: 02684269693 - REA: FC-526419
                <br>
                Cap. Soc. 10.000€ e riserve in conto capitale per un totale di 100.000€ interamente versati.
            </p>
            <p>
                <a id="footer_InfoLegali" href="info_legali.html">Info Legali</a> | <a id="footer_PrivacyPolicy" href="privacy_policy.html">Privacy</a>
            </p>
      </address>
    </footer>
  </body>
</html>
