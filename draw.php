<!DOCTYPE html>
<html lang="it">

  <head>
  </script>
    <meta charset="utf-8">
    <title>Yook - Personalizza</title>
    <link rel="icon" href="resources/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </script>
    <script>
      $(document).ready(function(){
        $(".nascondi").hide();
      });
    </script>
  </head>

  <body>

    <!-- il not-footer serve per il footer statico -->
    <div id="not-footer">

    <header>
      <a href="home.php">
      <h1>Yook!</h1>
      </a>
      <h2>Disegna la tua pizza!</h2>
    </header>


<div class="row">
  <div class="col-8">
    <h3>Canvas:</h3>
    <canvas id="myCanvas" width="500" height="500"
    style="border:1px solid #d3d3d3;">
    Your browser does not support the HTML5 canvas tag.
    </canvas>
    <button type="button" name="" onclick="inizializePizza()">Reset</button>
  </div>

  <div class="col-4">
    <h3>Scegli condimento</h3>
    <select>
      <option value="volvo">Salsa</option>
      <option value="saab">Salame</option>
      <option value="opel">Funghi</option>
      <option value="audi">Pomodorini</option>
    </select>

    <p>Salsa di pomodoro</p>
    <img id="salsa" width="100" height="100" src="./resources/immaginiCibi/condimenti pizza/salsapomodoro.png" alt="Salsa">
    <p>Funghi</p>
    <img id="funghi" width="100" height="100" src="./resources/immaginiCibi/condimenti pizza/fungo.png" alt="Mashroom">
    <p>Salame</p>
    <img id="salame" width="100" height="100" src="./resources/immaginiCibi/condimenti pizza/salame2.png" alt="Salame">
    <p>Pomodorini</p>
    <img id="pomodori" width="100" height="100" src="./resources/immaginiCibi/condimenti pizza/pomodorino.png" alt="Pomodorini">
    <p>Peperoni</p>
    <img id="peperoni" width="100" height="100" src="./resources/immaginiCibi/condimenti pizza/peperone.png" alt="Peperoni">
    <p>Patate al forno</p>
    <img id="patforno" width="100" height="100" src="./resources/immaginiCibi/condimenti pizza/patata.png" alt="Patate al forno">
    <p>Patate fritte</p>
    <img id="patfritte" width="100" height="100" src="./resources/immaginiCibi/condimenti pizza/patatina.png" alt="Patate fritte">
    <p>Zucchine</p>
    <img id="zucchine" width="100" height="100" src="./resources/immaginiCibi/condimenti pizza/zucchina.png" alt="Zucchine">
    <p>Cipolla</p>
    <img id="cipolla" width="100" height="100" src="./resources/immaginiCibi/condimenti pizza/cipolla.png" alt="Cipolla">
    <p>Salsiccia</p>
    <img id="salsiccia" width="100" height="100" src="./resources/immaginiCibi/condimenti pizza/salsiccia.png" alt="Salsiccia">
    <div class="nascondi">
      <img id="impasto" width="100" height="100" src="./resources/immaginiCibi/condimenti pizza2/impasto.png" alt="Impasto">
    </div>
  </div>
</div>

    <script>
    var canvas = document.getElementById('myCanvas');
    var ctx = canvas.getContext('2d');
    window.onload = function() {
        inizializePizza();
        var salsa = document.getElementById("salsa");
        var funghi = document.getElementById("funghi");
        var salame = document.getElementById("salame");
        var pomodori = document.getElementById("pomodori");
        var peperoni = document.getElementById("peperoni");
        var patforno = document.getElementById("patforno");
        var patfritte = document.getElementById("patfritte");
        var zucchine = document.getElementById("zucchine");
        var cipolla = document.getElementById("cipolla");
        var salsiccia = document.getElementById("salsiccia");
        $(document).ready(function(){
          $("#salsa").click(function(){

            ctx.fillStyle = 'darkred';
            ctx.beginPath();
            var radius = canvas.height/2-50;
            ctx.arc(canvas.width/2, canvas.height/2, radius, 0, Math.PI*2, 0);
            ctx.fill();

          });
          $("#funghi").click(function(){
          // ctx.globalCompositeOperation = "source-over";
          ctx.drawImage(funghi, 177, 135, 30, 30);
          ctx.drawImage(funghi, 235, 278, 30, 30);
          ctx.drawImage(funghi, 260, 105, 30, 30);
          ctx.drawImage(funghi, 217, 172, 30, 30);
          ctx.drawImage(funghi, 340, 200, 30, 30);
          ctx.drawImage(funghi, 330, 140, 30, 30);
          ctx.drawImage(funghi, 330, 248, 30, 30);
          ctx.drawImage(funghi, 280, 219, 30, 30);
          ctx.drawImage(funghi, 170, 200, 30, 30);
          ctx.drawImage(funghi, 217, 238, 30, 30);
          ctx.drawImage(funghi, 270, 158, 30, 30);
          });
          $("#salame").click(function(){
          // ctx.globalCompositeOperation = "source-over";
          ctx.drawImage(salame, 207, 1555, 30, 30);
          ctx.drawImage(salame, 265, 298, 30, 30);
          ctx.drawImage(salame, 290, 125, 30, 30);
          ctx.drawImage(salame, 247, 192, 30, 30);
          ctx.drawImage(salame, 370, 220, 30, 30);
          ctx.drawImage(salame, 360, 160, 30, 30);
          ctx.drawImage(salame, 360, 268, 30, 30);
          ctx.drawImage(salame, 310, 239, 30, 30);
          ctx.drawImage(salame, 200, 220, 30, 30);
          ctx.drawImage(salame, 247, 258, 30, 30);
          ctx.drawImage(salame, 300, 178, 30, 30);
          });
          $("#pomodori").click(function(){
          // ctx.globalCompositeOperation = "source-over";
          ctx.drawImage(salame, 117, 95, 30, 30);
          ctx.drawImage(salame, 175, 238, 30, 30);
          ctx.drawImage(salame, 200, 65, 30, 30);
          ctx.drawImage(salame, 157, 132, 30, 30);
          ctx.drawImage(salame, 280, 160, 30, 30);
          ctx.drawImage(salame, 270, 100, 30, 30);
          ctx.drawImage(salame, 270, 208, 30, 30);
          ctx.drawImage(salame, 220, 179, 30, 30);
          ctx.drawImage(salame, 110, 160, 30, 30);
          ctx.drawImage(salame, 157, 198, 30, 30);
          ctx.drawImage(salame, 210, 118, 30, 30);
          });
        });

    };

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
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            var sfondo = document.getElementById("impasto");
            ctx.drawImage(sfondo, 0, 0, canvas.width, canvas.height);
          }



          canvas.addEventListener('click', function(evt) {
            var mousePos = getMousePos(canvas, evt);
            var message = 'Mouse position: ' + mousePos.x + ',' + mousePos.y;
            //writeMessage(canvas, message);

            var salame = document.getElementById("salame");
            var lato = 60;
            ctx.drawImage(salame, mousePos.x - lato/2, mousePos.y - lato/2, lato, lato);

          }, false);

    </script>

  </div>
  <footer>
    <?php
      include 'footer.php';
      print_footer();
    ?>
  </footer>
</body>

</html>
