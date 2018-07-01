<!DOCTYPE html>
<html lang="it">

  <head>
    <meta charset="utf-8">
    <title>Yook</title>
    <link rel="icon" href="resources/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
    <!--per le icone social uso font apposito-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- per la gallery -->
    <link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet">
    <link rel="stylesheet" href="css/squaredgallery.css">
    <!-- per il loader -->
    <link rel="stylesheet" href="css/loader.css">
    <!-- per il passaggio dei dati di accesso del guest -->
    <script type="text/javascript" src="./js/forms.js"></script>
    <script type="text/javascript" src="./js/sha512.js"></script>
    <!-- per hamburger menu -->
    <link rel="stylesheet" href="css/hamburger.css">
    <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
    <script src="js/hamburger.js"></script>
    <!-- per le notifiche -->
    <link rel="stylesheet" href="css/animate.css">
    <script src="./js/sweetalert2.all.js"></script>
  </head>

  <body onload="lateFunction()">
    <!-- caricamento -->
    <div id="cooking">
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div id="area">
        <div id="sides">
          <div id="pan"></div>
          <div id="handle"></div>
        </div>
        <div id="pancake">
          <div id="pastry"></div>
        </div>
        Cooking in progress...
      </div>
    </div>

    <!-- inizio corpo del sito, displayed dopo il loading-->
<div id="allpage" style="display:none">
  <!-- il not-footer serve per il footer statico -->
  <div id="not-footer">

    <?php
      include 'functions.php';
      include 'connection.php';
      error_reporting(~E_WARNING);
      sec_session_start();  //chiama inizia sessione
      if(login_check($conn) == true) {  //se loggato
     ?>

     <?php
     //faccio query per le informazioni dell'utente
       $query = "SELECT * FROM members WHERE id = '".$_SESSION['user_id']."'"; //con questa query seleziono tutti i dati dell'utente
       if($result = $conn->query($query)){ //se la query ha prodotto un risultato
         while($row = $result->fetch_row()) { //il risultato prodotto è un insieme di righe prelevate dal database. faccio la fetch del risultato e ogni riga, fintanto che ci sono righe, la analizzo mettendola nella variabile "row"
           //echo "Benvenuto ".$row[1]; //username c'è già dal login
           $_SESSION['nome'] = $row[1];
           $_SESSION['cognome'] = $row[2];
           $_SESSION['email'] = $row[4];
           $_SESSION['indirizzo'] = $row[7];
           $_SESSION['pagamento'] = $row[8];
           $_SESSION['carta'] = $row[9];
           $_SESSION['scadenza'] = $row[10];
           $_SESSION['cvv'] = $row[11];
           $_SESSION['punti'] = $row[14];
           //echo "<br>Dati in-sessione: ".$_SESSION['nome']." ".$_SESSION['cognome']." ".$_SESSION['email']." ".$_SESSION['indirizzo']." ";
           //echo "<br>Dati in-sessione: ".$_SESSION['pagamento']." ".$_SESSION['carta']." ".$_SESSION['scadenza']." ".$_SESSION['cvv']." ".$_SESSION['punti'];
         }
       } else {
         echo "Nessun dato sull' utente trovato";
       }
     ?>

     <!-- menu hamburger -->
      <div  class="open">
     	<span class="cls"></span>
     	<span>
     		<ul class="sub-menu ">
        <?php if ($_SESSION['nome'] != "guest") { ?>
     			<li>
            <div class="saluto"><?php echo "Ciao ".$_SESSION['nome'] ?></title></div>
     			</li>
     			<li>
     				<p><?php echo $_SESSION['punti']." punti" ?></p>
     			</li>
     			<li>
     				<a href="./logout.php" title="">Logout</a>
     			</li>
        <?php } else { ?>
          <li>
            <div class="saluto center">Come utente ospite non puoi accumulare punti e salvare i tuoi dati.</title></div>
          </li>
        <?php } ?>
     			<li>
     				<a href="./ourContacts.html" title="contact">Aiuto</a>
     			</li>
     		</ul>
     	</span>
     	<span class="cls"></span>
     </div>
     <?php
      }
      ?>


        <header>
          <a href="home.php">
          <h1>Yook!</h1>
          </a>
          <h2>Make it Yours.</h2>
          <nav>
          <ul>
            <li><a href="ourFood.html">Il nostro cibo</a></li>
            <li><a href="ourStory.html">La nostra storia</a></li>
            <li><a href="ourLocation.html">Location</a></li>
            <li><a href="ourContacts.html">Contattaci</a></li>
          </ul>
          </nav>
        </header>

        <div class="row" id="choice">
          <div class="col-6 left">
          <?php if(!isset($_SESSION['user_id'])) { ?>
            <form action="process_login.php" method="post">
               <input type="text" id="ema" name="email" value="guest@guest" style="display:none;"/></label>
               <input type="text" id="password" name="p" value="guest" style="display:none;"/></label>
              <!-- pulsante ordina al volo -->
              <button class='myButt three' onclick="formhash(this.form, this.form.password);">Ordina al volo</button>
            </form>
          <?php } else { ?>
              <form class="" action="menu.php" >
                <button class='myButt three'>&nbsp;&nbsp;&nbsp;&nbsp;Menu&nbsp;&nbsp;&nbsp;&nbsp;</button>
              </form>
          <?php } ?>
          </div>
          <div class="col-6 right">
            <form class="" action="accedi.php" >
              <button class='myButt three'>&nbsp;&nbsp;&nbsp;&nbsp;Accedi&nbsp;&nbsp;&nbsp;&nbsp;</button>
            </form>
          </div>
        </div>


    <div class = "row easy4sfondo">
      <div class="col-3 left social">
        <br>Social:<br/>
        <a href="https://www.facebook.com" class="fa fa-facebook"><div class="follow-desc">Facebook</div></a>
        <a href="https://twitter.com" class="fa fa-twitter"><div class="follow-desc">Twitter</div></a>
        <a href="https://www.instagram.com" class="fa fa-instagram"><div class="follow-desc">Instagram</div></a>
        <a href="https://www.youtube.com" class="fa fa-youtube"><div class="follow-desc">Youtube</div></a>
        <a href="https://plus.google.com" class="fa fa-google"><div class="follow-desc">Google Plus</div></a>
      </div>
      <div class="col-9 right gallery">
        <br>
        <div class="demo" >
          <div class="demo__help">
            I <a href="./ourFood.html">nostri piatti</a> in breve:
          </div>
          <div class="demo__gallery"></div>
        </div>
        <br>
        <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
        <script src="js/squaredgallery.js"></script>

      </div>
    </div>

    <div class="row">
      <div class="discover onions">
        <div class="card">
          <h2>Wow! This is GoodFood.</h2>
          <p><a href="ourStory.html">discover our tradition</a></p>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="discover loca">
        <div class="card">
          <h2>Near your heart.</h2>
          <p><a href="ourLocation.html">discover where you can find us.</a></p>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="discover people">
        <div class="card">
          <h2>Yook for You.</h2>
          <p><a href="ourContacts.html">discover how you can contact us.</a></p>
        </div>
      </div>
    </div>

    </div>
    <footer>
      <?php
        include 'footer.php';
        print_footer();
      ?>
    </footer>
  <!-- fine corpo del sito -->
  </div>
  </body>

  <!-- SCRIPT LOADER -->
  <script>
      var keyloop;
      //per il loader
      function loadedFunction() {
         document.getElementById("cooking").style.display = "none";
         document.getElementById("allpage").style.display = "block";
         <?php
           if(login_check($conn) == true) {  //se loggato
             if(!empty($_SESSION['num_ordine'])){ //se esiste la variabile di sessione relativa all'ordine
         ?>
        keyloop = setInterval(function(){ controlla_notifica(); }, 4000); //intervallo funzione controllo notifica
         <?php
             }
           }
          ?>
      }
      //ritarda il loader
      function lateFunction() {
        var myVar = setTimeout(loadedFunction, 3000);
      }

      function visualizza_notifica(){
        swal({
          position: 'top',
          type: 'success',
          title: 'Complimenti',
          text: 'Il tuo ordine è stato consegnato!',
          showConfirmButton: false,
          timer: 4000,
          costumClass: 'animate jackInTheBox',
          width: 600,
          padding: '3em',
          backdrop:`
            rgba(255,255,255,0.2)
            url("./resources/Fattorino.gif")
            center right
            no-repeat`
        });
      }

      function controlla_notifica(){
        $.ajax({
          url: "notification_check.php", //pagina php apposita che ritorna json dopo una query
          type: "post",
          dataType: 'json',
          success: function(data){
                      console.log(data.status);//se ricevo qualcosa, lo stampo
                      if(data.status == "Delivered"){
                        visualizza_notifica();   //se è consegnato visualizzo la notifica
                        clearInterval(keyloop); //fermo il ciclo
                      }
                    },
          error: function(data){
                    console.log("Fail");//se non ricevo nulla stampo fail
                  }
        });
      }
  </script>
  <noscript>
    <style>#cooking { display: none; } </style>
  </noscript>

</html>
