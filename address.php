<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <title>Yook</title>
    <link rel="icon" href="resources/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
    <!-- per la mappa -->
    <link rel="stylesheet" type="text/css" title="stylesheet" href="./css/map.css">
    <!-- per barra progressi -->
    <link rel="stylesheet" type="text/css" title="stylesheet" href="./css/progress.css">
    <!-- per il pulsante bollicinoso, in fondo alla pagina c'è lo script -->
    <link rel="stylesheet" type="text/css" title="stylesheet" href="./css/bubbly.css">
    <!-- per input text figo -->
    <link rel="stylesheet" type="text/css" title="stylesheet" href="./css/inp_text.css">
    <!-- per font icone -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <!-- per AJAX -->
    <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
  </head>

  <body>

  <!-- il not-footer serve per il footer statico -->
  <div id="not-footer">

    <?php
      include 'functions.php';
      include 'connection.php';
      error_reporting(~E_WARNING);
      sec_session_start();  //chiama inizia sessione
      if(login_check($conn) == true) {
     ?>

    <header>
      <a href="home.php">
      <h1>Yook!</h1>
      </a>
      <h2>Inserisci Indirizzo</h2>
      <p>Noi consegnamo senza spese aggiuntive!</p>
    </header>

        <!-- barra progressi -->
        <div class="" style="background-color: white">
          <ul class="checkout-bar">
            <li class="visited"><a href="menu.php">Menù</a></li>
            <li class="active">Luogo Consegna</li>
            <li class="">Carrello</li>
            <li class="">Pagamento</li>
            <li class="">Fine</li>
          </ul>
        </div>

      <?php         //prendo il POST dell'indirizzo consegna ordine
        if ( !empty($_SESSION['indir_ordine']) || !empty($_POST['indir_ordine']) ) { //se c'è uno o l'altro
          if ( !empty($_POST['indir_ordine']) ) {  //se c'è post
            $_SESSION['indir_ordine'] = $_POST['indir_ordine']; //imposto indirizzo consegna di sessione al POST passato
          }
        } else { //se non c'è l'indirizzo di consegna in sessione e nemmeno quello passato da POST
          $_SESSION['indir_ordine'] = $_SESSION['indirizzo']; //imposto indirizzo consegna di sessione a indirizzo utente
        }
      ?>



    <div class="row easy1sfondo">

      <div class="col-4 center">
        <!-- classe dove l'utente sceglie -->
        <div class="pac-card" id="pac-card">
          <div id="title">
          </br></br></br>
            Scegli luogo di consegna:
          </div>
          <!-- input -->
          <div id="pac-container">
            <div class='cont_inp'><span><input class='gate' id='pac-input' width="10%" type='text' placeholder='enter a location' /><label for='class'>Luogo</label></span></div>
            <!-- <input id="pac-input" type="text" placeholder="Enter a location"> -->
          </div>
          <!-- pulsante geolocalizzazione -->
          <button class="bubbly-button" onclick="geolocate()">Geo me <i class="fas fa-street-view"></i></button>
        </div>
        <!-- accuratezza stampata nel caso di geoloc -->
        <div id="accu"></div>
        <!-- pulsante consegna in questo luogo -->
        <br>e la modalità:
        <br>
        <button class="bubbly-button" onclick="consegna()"> Consegna qui <i class="fas fa-check-circle"></i></button>
        <button class="bubbly-button" onclick="insede()"> Ritiro in sede <i class="fas fa-map-marker-alt"></i></button>
      </div>

      <div class="col-8">
        <br><br><br>
        <!-- mappa verrà qui -->
        <div id="map"></div>
      </div>

    </div>

                <script>
                  //imposto input text all'indirizzo consegna di sessione   -->
                  document.getElementById('pac-input').value = '<?php echo $_SESSION['indir_ordine'] ?>';
                </script>


                <script>
                //FUNZIONE CHIAMATA ALLA PRESSIONE TASTO IN SEDE
                function insede() {
                  //uso il metodo post a me stesso con AJAX e poi passo a carrello
                  $.post('address.php', { indir_ordine : "Piazza Fabbri, 5, Cesena, FC, Italia" } , function(){ window.location.replace('cart.php'); });
                }

                //FUNZIONE CHIAMATA ALLA PRESSIONE TASTO CONSEGNA
                function consegna() {
                  if (!(document.getElementById('pac-input').value == "")) {
                    //uso il metodo post a me stesso con AJAX e poi passo a carrello
                    $.post('address.php', { indir_ordine : document.getElementById('pac-input').value } , function(){ window.location.replace('cart.php'); });
                  } else {
                    window.alert("Please set a place");
                  }
                }

                var map;
                  function initMap() {
                    var posrocca = {lat: 44.136503, lng: 12.240194};
                    map = new google.maps.Map(document.getElementById('map'), {
                      zoom: 18,//minimo 18 per avere il tilt
                      center: posrocca,
                      streetViewControl: false, //niente omino street view
                      mapTypeId: 'hybrid', //solo ibrida o satellite per il tilt
                      tilt: 45, //45 quando possibile

                    });
                    var marker = new google.maps.Marker({
                      position: posrocca,
                      map: map,
                      title: "Lugo selezionato per la consegna",
                      animation: google.maps.Animation.BOUNCE,
                      icon: './resources/flag.png'
                    });
                    marker.setVisible(false);

                    //SEZIONE AUTOCOMPLETE
                    var autocomplete = new google.maps.places.Autocomplete(document.getElementById('pac-input'));
                    var circle = new google.maps.Circle({
                                  center: posrocca,
                                  radius: 5000
                                });
                    autocomplete.setTypes(['address']);
                    // autocomplete.setComponentRestrictions(
                    //   {
                    //     ///country: 'IT'
                    //
                    //   });
                    autocomplete.setBounds(circle.getBounds());
                    //se true i suggerimenti sono esclusivamente delle restrizioni
                    autocomplete.setOptions({strictBounds: false});

                    // Bind the map's bounds (viewport) property to the autocomplete object,
                    // so that the autocomplete requests use the current map bounds for the
                    // bounds option in the request.
                    //suggerimenti in base alla mappa
                    //autocomplete.bindTo('bounds', map);

                    autocomplete.addListener('place_changed', function() {

                      marker.setVisible(true);
                      var place = autocomplete.getPlace();
                      if (!place.geometry) {
                        // User entered the name of a Place that was not suggested and
                        // pressed the Enter key, or the Place Details request failed.
                        window.alert("No details available for input: '" + place.name + "'");
                        return;
                      }

                      map.setCenter(place.geometry.location);
                      marker.setPosition(place.geometry.location);

                      var address = '';
                      if (place.address_components) {
                        address = [
                          (place.address_components[0] && place.address_components[0].short_name || ''),
                          (place.address_components[1] && place.address_components[1].short_name || ''),
                          (place.address_components[2] && place.address_components[2].short_name || '')
                        ].join(' ');
                      }

                    });


                  }

                  //FUNZIONE CHIAMATA ALLA PRESSIONE TASTO GEOLOCATION
                  function geolocate() {

                          // Try HTML5 geolocation.
                          if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(function(position) {
                              var pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                              };

                              //mostro accuratezza geolocalizzazione in un div
                              document.getElementById('accu').innerHTML = "Accuracy " + position.coords.accuracy + " m";

                              //provo reverse geocoding per avere anche l'indirizzo
                               var geocoder = new google.maps.Geocoder;
                               var latlng = {lat: position.coords.latitude, lng: position.coords.longitude};
                                 geocoder.geocode({'location': latlng}, function(results, status) {
                                   if (status === 'OK') {
                                     if (results[0]) {
                                       //setto
                                       document.getElementById('pac-input').value = results[0].formatted_address;
                                     } else {
                                       window.alert('No near address found');
                                     }
                                   } else {
                                     window.alert('near address searching failed due to: ' + status);
                                   }
                                 });

                              //creo l'infowindow
                              infoWindow = new google.maps.InfoWindow;
                              infoWindow.setPosition(pos);
                              infoWindow.setContent('Location found.');
                              infoWindow.open(map);
                              //centro la mappa sulla posizione
                              map.setCenter(pos);
                            }, function() {
                              handleLocationError(true, infoWindow, map.getCenter());
                            });
                          } else {
                            // Browser doesn't support Geolocation
                            handleLocationError(false, infoWindow, map.getCenter());
                          }
                        }

                        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                          infoWindow.setPosition(pos);
                          infoWindow.setContent(browserHasGeolocation ?
                                                'Error: The Geolocation service failed.' :
                                                'Error: Your browser doesn\'t support geolocation.');
                          infoWindow.open(map);
                        }


                </script>
        <!-- <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBinnhjlVy7a2RxTETHiw0LrCByGnrZKnQ&callback=initMap">
        </script> -->
        <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBinnhjlVy7a2RxTETHiw0LrCByGnrZKnQ&libraries=places&callback=initAutocomplete"
            async defer></script> -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBinnhjlVy7a2RxTETHiw0LrCByGnrZKnQ&libraries=places&callback=initMap"
                    async defer></script>

      <?php
      //alternativa alla pagina
      } else {
         echo 'You are not authorized to access this page, please login. <br/>';
         echo "<a href='accedi.php'>Accedi</a>";
      }
      ?>

      <!-- script per pulsante bollicinoso -->
      <script src="js/bubbly.js"></script>

    </div>
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
