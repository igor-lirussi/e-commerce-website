<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <title>Inserisci Indirizzo</title>
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
    <style>
      #locationField, #controls {
        position: relative;
        width: 480px;
      }
      #autocomplete {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 99%;
      }
      .label {
        text-align: right;
        font-weight: bold;
        width: 100px;
        color: #303030;
      }
      #address {
        border: 1px solid #000090;
        background-color: #f0f0ff;
        width: 480px;
        padding-right: 2px;
      }
      #address td {
        font-size: 10pt;
      }
      .field {
        width: 99%;
      }
      .slimField {
        width: 80px;
      }
      .wideField {
        width: 200px;
      }
      #locationField {
        height: 20px;
        margin-bottom: 2px;
      }
    </style>
  </head>

  <body>
    <header>
      <a href="home.html">
      <h1>Yook!</h1>
      </a>
      <h2>Inserisci Indirizzo</h2>
    </header>



    <div id="locationField">
      <input id="autocomplete" placeholder="Enter your address"
             onFocus="geolocate()" type="text"></input>
    </div>

    <script>

      var placeSearch, autocomplete;
      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
      </script>









    <?php
      $Address = "corso sozzi, cesena";
      $Address = urlencode($Address);
      $request_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=".$Address."&sensor=true";
      $xml = simplexml_load_file($request_url) or die("url not loading");
      $status = $xml->status;
      if ($status=="OK") {
          $Lat = $xml->result->geometry->location->lat;
          $Lon = $xml->result->geometry->location->lng;
          $LatLng = "$Lat,$Lon";
      }
    ?>

    <h3>Google Mappo</h3>
        <div id="map"></div>
        <script>
          function initMap() {
            var uluru = {lat: <?php echo $Lat; ?>, lng: <?php echo $Lon; ?>};
            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 19,//massimo 18 per il tilt
              center: uluru,
              streetViewControl: false, //niente omino street view
              mapTypeId: 'hybrid',
              tilt: 45, //45 quando possibile

            });
            var marker = new google.maps.Marker({
              position: uluru,
              map: map,
              title: "Lugo selezionato",
              animation: google.maps.Animation.BOUNCE,
              icon: 'http://127.0.0.1/repositocibo/resources/flag.png'
            });
          }
        </script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBinnhjlVy7a2RxTETHiw0LrCByGnrZKnQ&libraries=places&callback=initAutocomplete"
            async defer></script>





    <footer>
    <p>Posted by: </p>
    <p>Contact information: <a href="mailto:someone@example.com">
    someone@example.com</a>.</p>
    </footer>
  </body>
</html>
