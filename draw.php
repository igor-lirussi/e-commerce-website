<!DOCTYPE html>
<html lang="it">

  <head>
    <meta charset="utf-8">
    <title>Yook - Personalizza</title>
    <link rel="icon" href="resources/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- per il radio button con le immagini, serve anche jquery -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="css/radio_img.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- per il pulsante bollicinoso, in fondo alla pagina c'è lo script -->
    <link rel="stylesheet" type="text/css" title="stylesheet" href="./css/bubbly.css">
    <!-- per input text figo -->
    <link rel="stylesheet" type="text/css" title="stylesheet" href="./css/inp_text.css">
    <script>
      $(document).ready(function(){
        $(".nascondi").hide();
      });
    </script>
  </head>

  <body>
    <?php
      include 'functions.php';
      include 'connection.php';
      error_reporting(~E_WARNING);
      sec_session_start();  //chiama inizia sessione
      if(login_check($conn) == true) {
     ?>

    <!-- il not-footer serve per il footer statico -->
    <div id="not-footer">

    <header>
      <a href="home.php">
      <h1>Yook!</h1>
      </a>
      <h2>Disegna la tua pizza!</h2>
    </header>


<div class="row easy3sfondo">

  <div class="col-6 allcenter">
    <h3>La tua pizza:</h3>
    Prezzo: <span id="price">0</span> €
    </br>
    <!-- cavas con pizza -->
    <canvas id="myCanvas" width="500" height="500" style="border:0px solid #d3d3d3;">Your browser does not support the HTML5 canvas tag.</canvas>
    <br>
    <!-- input nome pizza -->
    <div class='cont_inp'><span><input class='gate' id='pac-input' width="10%" type='text' placeholder='Inserisci nome' /><label for='class'>Nome Pizza</label></span></div>
    <!-- pulsanti scelta -->
    <button class="bubbly-button"type="button" name="" onclick=" window.location.replace('menu.php');">Torna Indietro</button>
    <button class="bubbly-button"type="button" name="" onclick="inizializePizza()">Reset</button>
    <button class="bubbly-button"type="button" name="" onclick="salva()">Salva</button>
    <br>
    <!-- immagine vecchia piiza -->
    <div id="vecchia-pizza" style="display:none;">
      <br>
      La tua pizza corrente:
      <img id="canvasimg" >
    </div>
  </div>

  <div class="col-6 allcenter">
    <h3>Scegli gli ingredienti</h3>

    <h4>Salsa di pomodoro</h4>
    <section>
      <div>
        <input type="radio" id="control_01POM" name="select" value="disPOM">
        <label for="control_01POM">
          Disegna <br>
          <i class="fas fa-pencil-alt"></i>
        </label>
      </div>
      <div>
        <input type="radio" id="control_02POM" name="select" value="fill">
        <label for="control_02POM">
          Riempi <br>
          <i class="fab fa-gratipay"></i>
        </label>
      </div>
    </section>

    <h4>Mozzarella</h4>
    <section>
      <div>
        <input type="radio" id="control_01MOZ" name="select" value="disMOZ">
        <label for="control_01MOZ">
          Disegna <br>
          <i class="fas fa-pencil-alt"></i>
        </label>
      </div>
      <div>
        <input type="radio" id="control_02MOZ" name="select" value="fill">
        <label for="control_02MOZ">
          Riempi <br>
          <i class="fab fa-gratipay"></i>
        </label>
      </div>
    </section>

    <h4>Condimenti</h4>
    <!-- riga 1 -->
    <section>
      <div>
        <input type="radio" id="control_01" name="select" value="asparago" checked>
        <label for="control_01">
          Asparago
          <img id="asparago" width="100%" height="100" src="./resources/immaginiCibi/condimenti_pizza/asparago.png"  >
        </label>
      </div>
      <div>
        <input type="radio" id="control_02" name="select" value="cipolla">
        <label for="control_02">
          Cipolla
          <img id="cipolla" width="100%" height="100" src="./resources/immaginiCibi/condimenti_pizza/cipolla.png"  >
        </label>
      </div>
      <div>
        <input type="radio" id="control_03" name="select" value="fungo">
        <label for="control_03">
          Fungo
          <img id="fungo" width="100%" height="100" src="./resources/immaginiCibi/condimenti_pizza/fungo.png"  >
        </label>
      </div>
      <div>
        <input type="radio" id="control_04" name="select" value="gambero">
        <label for="control_04">
          Gambero
          <img id="gambero" width="100%" height="100" src="./resources/immaginiCibi/condimenti_pizza/gambero.png"  >
        </label>
      </div>
    </section>
    <!-- riga 2 -->
    <section>
      <div>
        <input type="radio" id="control_05" name="select" value="mais">
        <label for="control_05">
          Mais
          <img id="mais" width="100%" height="100" src="./resources/immaginiCibi/condimenti_pizza/mais.png"  >
        </label>
      </div>
      <div>
        <input type="radio" id="control_06" name="select" value="noce">
        <label for="control_06">
          noce
          <img id="noce" width="100%" height="100" src="./resources/immaginiCibi/condimenti_pizza/noce.png"  >
        </label>
      </div>
      <div>
        <input type="radio" id="control_07" name="select" value="oliva">
        <label for="control_07">
          oliva
          <img id="oliva" width="100%" height="100" src="./resources/immaginiCibi/condimenti_pizza/oliva.png"  >
        </label>
      </div>
      <div>
        <input type="radio" id="control_08" name="select" value="patata">
        <label for="control_08">
          patata
          <img id="patata" width="100%" height="100" src="./resources/immaginiCibi/condimenti_pizza/patata.png"  >
        </label>
      </div>
    </section>
    <!-- riga 3 -->
    <section>
      <div>
        <input type="radio" id="control_09" name="select" value="patatina">
        <label for="control_09">
          patatina
          <img id="patatina" width="100%" height="100" src="./resources/immaginiCibi/condimenti_pizza/patatina.png"  >
        </label>
      </div>
      <div>
        <input type="radio" id="control_10" name="select" value="peperone">
        <label for="control_10">
          peperone
          <img id="peperone" width="100%" height="100" src="./resources/immaginiCibi/condimenti_pizza/peperone.png"  >
        </label>
      </div>
      <div>
        <input type="radio" id="control_11" name="select" value="pomodorino">
        <label for="control_11">
          pomodorino
          <img id="pomodorino" width="100%" height="100" src="./resources/immaginiCibi/condimenti_pizza/pomodorino.png"  >
        </label>
      </div>
      <div>
        <input type="radio" id="control_12" name="select" value="radicchio">
        <label for="control_12">
          radicchio
          <img id="radicchio" width="100%" height="100" src="./resources/immaginiCibi/condimenti_pizza/radicchio.png"  >
        </label>
      </div>
    </section>
    <!-- riga 4 -->
    <section>
      <div>
        <input type="radio" id="control_13" name="select" value="rucola">
        <label for="control_13">
          rucola
          <img id="rucola" width="100%" height="100" src="./resources/immaginiCibi/condimenti_pizza/rucola.png"  >
        </label>
      </div>
      <div>
        <input type="radio" id="control_14" name="select" value="salame">
        <label for="control_14">
          salame
          <img id="salame" width="100%" height="100" src="./resources/immaginiCibi/condimenti_pizza/salame.png"  >
        </label>
      </div>
      <div>
        <input type="radio" id="control_15" name="select" value="salsiccia">
        <label for="control_15">
          salsiccia
          <img id="salsiccia" width="100%" height="100" src="./resources/immaginiCibi/condimenti_pizza/salsiccia.png"  >
        </label>
      </div>
      <div>
        <input type="radio" id="control_16" name="select" value="zucchina">
        <label for="control_16">
          zucchina
          <img id="zucchina" width="100%" height="100" src="./resources/immaginiCibi/condimenti_pizza/zucchina.png"  >
        </label>
      </div>
    </section>

    <div class="nascondi">
      <img id="impasto" width="100" height="100" src="./resources/immaginiCibi/condimenti_pizza/impasto.png" >
      <img id="salsa_piena" width="100" height="100" src="./resources/immaginiCibi/condimenti_pizza/salsa_piena.png" >
      <img id="mozza_piena" width="100" height="100" src="./resources/immaginiCibi/condimenti_pizza/mozza_piena.png" >
    </div>

  </div>
</div>



    <script>
          var canvas = document.getElementById('myCanvas');
          var ctx = canvas.getContext('2d');
          var price = 0;
          //per il disegno
          var mousePressed = false;
          var lastX, lastY;

          window.onload = function() {
              inizializePizza();

                //per i riempimenti
                $("#control_02POM").click(function(){
                  var salsa_piena = document.getElementById("salsa_piena");
                  ctx.drawImage(salsa_piena, 0, 0, canvas.width, canvas.height);
                  aggiungi_prezzo("salsa_piena");
                });

                $("#control_02MOZ").click(function(){
                  var mozza_piena = document.getElementById("mozza_piena");
                  ctx.drawImage(mozza_piena, 0, 0, canvas.width, canvas.height);
                  aggiungi_prezzo("mozza_piena");
                });

                //per il disegno
                $('#myCanvas').mousedown(function (e) {
                    mousePressed = true;
                    Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, false);
                });

                $('#myCanvas').mousemove(function (e) {
                    if (mousePressed) {
                      //solo se è selezionata il disegna pomodoro o Mozzarella
                      if ($('input[name=select]:checked').val() == "disPOM" || $('input[name=select]:checked').val() == "disMOZ") {
                          Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, true);
                          aggiungi_prezzo("salsa");
                      }

                    }
                });

                $('#myCanvas').mouseup(function (e) {
                    mousePressed = false;
                });

                $('#myCanvas').mouseleave(function (e) {
                    mousePressed = false;
                });

          };

          function Draw(x, y, isDown) {
              if (isDown) {
                  ctx.beginPath();
                  //se pomodoro
                  if ($('input[name=select]:checked').val() == "disPOM") {
                    ctx.strokeStyle = "rgba(155, 0, 0, 1)";
                    ctx.lineWidth = 52;
                  } else { //Mozzarella
                    ctx.strokeStyle = "rgba(255, 255, 255, 1)";
                    ctx.lineWidth = 32;
                  }
                  ctx.lineJoin = "round";
                  ctx.moveTo(lastX, lastY);
                  ctx.lineTo(x, y);
                  ctx.closePath();
                  ctx.stroke();
              }
              lastX = x; lastY = y;
          }

          function writeMessage(canvas, message) {
            var ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.font = '18pt Calibri';
            ctx.fillStyle = 'black';
            ctx.fillText(message, 10, 25);
          }

          function getMousePos(canvas, evt) {
            var rect = canvas.getBoundingClientRect();
            return {
              x: parseInt( evt.clientX - rect.left ),
              y: parseInt( evt.clientY - rect.top )
            };
          }

          function inizializePizza() {
            ctx.save(); // save current state
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            var sfondo = document.getElementById("impasto");
            ctx.drawImage(sfondo, 0, 0, canvas.width, canvas.height);
            price = 4.00; //Prezzo di partenza
            document.getElementById("price").innerHTML = price;
          }

          function salva() {
            //piglio l'immagine dal canvas
            var dataURL = canvas.toDataURL();
            //ajax a me stesso immagine, prezzo, nome
            $.post( "draw.php", { image_pizza_pers : dataURL, price_pizza_pers : price.toFixed(2) , name_pizza_pers : document.getElementById('pac-input').value } , function(){ window.location.replace('menu.php'); } );
            //parte che riceve dati lato server
            <?php
              if (isset($_POST['image_pizza_pers'])) {
                $_SESSION["pizza_pers"]["image"] = $_POST['image_pizza_pers'];
              }
              if (isset($_POST['price_pizza_pers'])) {
                $_SESSION["pizza_pers"]["price"] = $_POST['price_pizza_pers'];
              }
              if (isset($_POST['name_pizza_pers'])) {
                $_SESSION["pizza_pers"]["name"] = $_POST['name_pizza_pers'];
              }
            ?>
          }

          <?php if (isset($_SESSION["pizza_pers"])) { ?>
            //mostro la pizza se ce ne ha una in sessione
            document.getElementById("canvasimg").src = "<?php echo $_SESSION["pizza_pers"]["image"]; ?>";
            document.getElementById("vecchia-pizza").style.display = "inline";
          <?php } ?>


          function lato_ingrediente( ingrediente_pass ) {
            var lato;
            switch (ingrediente_pass) {
              case "asparago":
                lato = 90;
                break;
              case "radicchio":
                lato = 100;
                break;
              default: lato = 60;
            }
            return lato;
          }


          function aggiungi_prezzo( ingrediente_pass ) {
            var sovrapprezzo;
            switch (ingrediente_pass) {
              case "salsa":
                sovrapprezzo = 0.001;
                break;
              case "gambero":
              case "noce":
                sovrapprezzo = 0.50;
                break;
              case "mais":
              case "salsiccia":
              case "rucola":
              case "zucchina":
              case "oliva":
                sovrapprezzo = 0.05;
                break;
              case "salsa_piena":
              case "mozza_piena":
                sovrapprezzo = 0.50;
                break;
              default: sovrapprezzo = 0.10;
            }
            // somma prezzo
            price = (price*1000 + sovrapprezzo*1000)/1000;
            //aggiorno Prezzo
            document.getElementById("price").innerHTML = price.toFixed(2);
          }

          //AL CLICK SULLA PIZZA PER INGREDIENTI
          canvas.addEventListener('click', function(evt) {
            //se sono selezionati gli ingredienti
            if ($('input[name=select]:checked').val() != "disPOM" &&
                  $('input[name=select]:checked').val() != "disMOZ" &&
                    $('input[name=select]:checked').val() != "fill") {
              var mousePos = getMousePos(canvas, evt);
              //var message = 'Mouse position: ' + mousePos.x + ',' + mousePos.y;
              //writeMessage(canvas, message);
              var nome_ingrediente = $('input[name=select]:checked').val();
              var ingrediente = document.getElementById(nome_ingrediente);
              aggiungi_prezzo(nome_ingrediente);
              //disegno cosa centrata sul mouse
              var lato = lato_ingrediente(nome_ingrediente);
              ctx.save(); // save current state
              ctx.translate(mousePos.x, mousePos.y);
              ctx.rotate(Math.floor(Math.random() * 360) ); // rotate (non serve la mousePos perchè l'ho già traslata prima)
              //se non facevo la traslazione prima usavo:
              //ctx.drawImage(ingrediente, mousePos.x - lato/2, mousePos.y - lato/2, lato, lato);
              ctx.drawImage(ingrediente, -lato/2,  -lato/2, lato, lato);
              ctx.restore(); // restore original states (no rotation etc)
            }
          }, false);

    </script>


    <!-- script per pulsante bollicinoso -->
    <script src="js/bubbly.js"></script>



  </div>
  <footer>
    <?php
      include 'footer.php';
      print_footer();
    ?>
  </footer>
  
  <?php
  //alternativa alla pagina
  } else {
     echo 'You are not authorized to access this page, please login. <br/>';
     echo "<a href='accedi.php'>Accedi</a>";
  }
  ?>
</body>

</html>
