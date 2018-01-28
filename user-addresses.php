<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <title>Indirizzo Utenti</title>
    <link rel="icon" href="resources/favicon.ico" />
    <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
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
      <a href="home.html">
      <h1>Yook!</h1>
      </a>
      <h2>Indirizzo Utenti</h2>
    </header>


    <?php
      include 'connection.php';


      // Set the active MySQL database

      $db_selected = mysqli_select_db($connection, $database);
      if (!$db_selected) {
        die ('Can\'t use db : ' . mysql_error());
      }

      // Select all the rows in the markers table

      $query = "SELECT * FROM utente_registrato WHERE 1";
      $result = mysqli_query($connection, $query);
      if (!$result) {
        die('Invalid query: ' . mysql_error());
      }

      // Start XML file
      $xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><users></users>');

      while($row = mysqli_fetch_array($result)){
        $marker = $xml->addChild("user");
        $marker->addAttribute("name", $row['Nome'] );
        $marker->addAttribute("surname", $row['Cognome'] );
        $marker->addAttribute("address", $row['Indirizzo'] );
      }
      //salvo l'xml nella stringa
      $notformattedXML = $xml->asXML();
      //formatto bene xml
      $dom = new DOMDocument();
      $dom->loadXML($notformattedXML);
      $dom->formatOutput = true;
      $formattedXML = $dom->saveXML();

      echo $formattedXML;
      //scrivo l'xml nel file
      $fp = fopen("user-addresses.xml", "w+");
      if(!$fp) die ("Errore nell'operazione con il file xml");

      fwrite($fp, $formattedXML);
      fclose($fp);
    ?>



    <h3><div id="io">
    Google Mappo e privacy utenti (sappiamo dove abitate)</div></h3>
    <div id="map"></div>





            <script>
            var customLabel = {
              restaurant: {
                label: 'R'
              },
              bar: {
                label: 'B'
              }
            };

            var map;
            var pos;
              function initMap() {

                var infoWindow = new google.maps.InfoWindow;
                pos = {lat: 44.137535, lng: 12.245450 };
                map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 15,//minimo 18 per avere il tilt
                  center: pos,
                  streetViewControl: false, //niente omino street view
                  mapTypeId: 'hybrid', //solo ibrida o satellite per il tilt
                  tilt: 45, //45 quando possibile

                });
                var markerbase = new google.maps.Marker({
                  position: pos,
                  map: map,
                  title: "Negozio",
                  animation: google.maps.Animation.BOUNCE,
                  icon: './resources/flag.png'
                });
                markerbase.setVisible(true);




                downloadUrl('user-addresses.xml', function(data) {
                  var geocoder = new google.maps.Geocoder();
                  var xml = data.responseXML;
                  var markers = xml.documentElement.getElementsByTagName('user');
                  //ciclo i markers della mappa
                  Array.prototype.forEach.call(markers, function(markerElem) {
                    //ottengo per ognuno i dati
                    var name = markerElem.getAttribute('name');
                    var surname = markerElem.getAttribute('surname');
                    var address = markerElem.getAttribute('address');
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
                              //label: icon.label
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
         <!-- <script async defer
         src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBinnhjlVy7a2RxTETHiw0LrCByGnrZKnQ&callback=initMap">
         </script> -->
         <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBinnhjlVy7a2RxTETHiw0LrCByGnrZKnQ&libraries=places&callback=initAutocomplete"
             async defer></script> -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBinnhjlVy7a2RxTETHiw0LrCByGnrZKnQ&libraries=places&callback=initMap"
                    async defer></script>




    <footer>
    <p>Posted by: </p>
    <p>Contact information: <a href="mailto:someone@example.com">
    someone@example.com</a>.</p>
    </footer>
  </body>
</html>
