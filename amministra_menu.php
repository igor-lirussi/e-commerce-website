<!DOCTYPE html>
<html lang="it">

  <head>
  </script>
    <meta charset="utf-8">
    <title>Yook</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
    <!-- per il pulsante bollicinoso, in fondo alla pagina c'è lo script -->
    <link rel="stylesheet" type="text/css" title="stylesheet" href="./css/bubbly.css">
    <!-- per input text figo -->
    <link rel="stylesheet" type="text/css" title="stylesheet" href="./css/inp_text.css">
    <!-- per le figurine/carte -->
    <link rel="stylesheet" type="text/css" title="stylesheet" href="./css/food_figure.css">
    <!-- per hamburger menu -->
    <link rel="stylesheet" href="css/hamburger.css">
    <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
    <script src="js/hamburger.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
      $(document).ready(function(){
        $(".nascondi").hide();
      });
    </script>
    <link rel="icon" href="resources/favicon.ico" />
  </head>

  <body>
    <!-- il not-footer serve per il footer statico -->
    <div id="not-footer">
      <?php
        include 'functions.php';
        include 'connection.php';
        sec_session_start();
        if(login_check($conn) == true) {
          if($_SESSION['username'] == "admin_admin"){
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


      <header>
        <a href="home.php">
        <h1>Yook!</h1>
        </a>
        <h2>Amministra menù</h2>
      </header>

      <div class="row listino">
        <div class="col-4 pastiVeloci">
          <h3>Pasti Veloci</h3>
          <?php
            $query = "SELECT * FROM listino WHERE listino.Categoria ='Pasti Veloci'";
            if($result = $conn->query($query)){
              while($row = $result->fetch_row()){
          ?>
                <div class = 'figurina'>
                  <section class='movie_image'>
                      <img class='movie_poster' src = "<?php echo $row[5] ?>"> <!--la variabile row, che contiene riga per riga, ad ogni iterazione, il risultato della query, è un vettore i cui indici sono le colonne della tabella (quella indicata nella query) con indice a partire da 0-->
                  </section>  <!--es: nella tabella listino la colonna con indice 0 è "Codice", con indice 1 è "Nome" ecc.. (vedi phpMyAdmmin per l'ordine delle colonne)-->
                  <section class='center_fig'>
                    <div class='about_movie'>
                      <h3><?php echo $row[1] ?></h3>
                      <div class='movie_info'>
                        <p><?php echo $row[4] ?>€</p>
                      </div>
                      <div class='movie_desc'>
                        <p><?php echo $row[3] ?></p>
                      </div>
                      <!-- <form action='delete.php' method='post'> -->
                        <div class = 'nascondi'>
                          <input type = 'text' id = 'cod' value = <?php echo $row[0] ?> >
                        </div>
                        <button class='bubbly-button' onclick="$.post('delete.php, {cod: $.('#cod')}');">Cancella prodotto</button> <!--DA SISTEMARE -->
                      <!-- </form> -->
                    </div>
                  </section>
                </div>
          <?php
              }
          ?>
                <div class = 'figurina'>
                  <form action='insert.php' method='post' enctype='multipart/form-data'>
                    <section class='movie_image'>
              	       <input name='image' type='file' value = 'Inserisci immagine'>
                    </section>
                    <section class='center_fig'>
                      <div class='about_movie'>
                       <div class='cont_inp'><span><input class='gate' type = 'text' name = 'nomeInserito' placeholder = 'Inserisci nome prodotto'><label for='class'>Nome</label></span></div>
                       <div class='cont_inp'><span><input class='gate' type = 'text' name = 'categInserita' placeholder = 'Inserisci categoria prodotto'><label for='class'>Categoria</label></span></div>
                       <div class='cont_inp'><span><textarea class='gate' rows='4' cols='50' name = 'descInserita' placeholder = 'Inserisci descrizione prodotto'></textarea></span></div>
                       <div class='cont_inp'><span><input class='gate' type = 'number' name = 'prezzoInserito' placeholder = 'Inserisci prezzo prodotto'><?php echo "€" ?><label for='class'>Prezzo</label></span></div>
                       <input name= 'invia' type='submit' value='Aggiungi prodotto'>
                     </div>
                    </section>
                  </form>
                 </div>
          <?php
            } else {
              echo "Nessun dato trovato";
            }
          ?>
        </div>

        <div class="col-4 primi">
          <h3>Primi</h3>
          <?php
            $query = "SELECT * FROM listino WHERE listino.Categoria ='Primi'";
            if($result = $conn->query($query)){
              while($row = $result->fetch_row()){
          ?>
          <div class = 'figurina'>
            <section class='movie_image'>
                <img class='movie_poster' src = "<?php echo $row[5] ?>"> <!--la variabile row, che contiene riga per riga, ad ogni iterazione, il risultato della query, è un vettore i cui indici sono le colonne della tabella (quella indicata nella query) con indice a partire da 0-->
            </section>  <!--es: nella tabella listino la colonna con indice 0 è "Codice", con indice 1 è "Nome" ecc.. (vedi phpMyAdmmin per l'ordine delle colonne)-->
            <section class='center_fig'>
              <div class='about_movie'>
                <h3><?php echo $row[1] ?></h3>
                <div class='movie_info'>
                  <p><?php echo $row[4] ?>€</p>
                </div>
                <div class='movie_desc'>
                  <p><?php echo $row[3] ?></p>
                </div>
                <form action='delete.php' method='post'>
                  <div class = 'nascondi'>
                    <input type = 'text' name = 'cod' value = <?php echo $row[0] ?> >
                  </div>
                  <input type='submit' value='Cancella prodotto'>
                </form>
              </div>
            </section>
          </div>
    <?php
        }
    ?>
          <div class = 'figurina'>
            <form action='insert.php' method='post' enctype='multipart/form-data'>
              <section class='movie_image'>
                 <input name='image' type='file' value = 'Inserisci immagine'>
              </section>
              <section class='center_fig'>
                <div class='about_movie'>
                 <div class='cont_inp'><span><input class='gate' type = 'text' name = 'nomeInserito' placeholder = 'Inserisci nome prodotto'><label for='class'>Nome</label></span></div>
                 <div class='cont_inp'><span><input class='gate' type = 'text' name = 'categInserita' placeholder = 'Inserisci categoria prodotto'><label for='class'>Categoria</label></span></div>
                 <div class='cont_inp'><span><textarea class='gate' rows='4' cols='50' name = 'descInserita' placeholder = 'Inserisci descrizione prodotto'></textarea></span></div>
                 <div class='cont_inp'><span><input class='gate' type = 'number' name = 'prezzoInserito' placeholder = 'Inserisci prezzo prodotto'><?php echo "€" ?><label for='class'>Prezzo</label></span></div>
                 <input name= 'invia' type='submit' value='Aggiungi prodotto'>
               </div>
              </section>
            </form>
           </div>
           <?php
            } else {
              echo "Nessun dato trovato";
            }
            ?>
        </div>

        <div class="col-4 bevande">
          <h3>Bevande</h3>
          <?php
            $query = "SELECT * FROM listino WHERE listino.Categoria ='Bevande'";
            if($result = $conn->query($query)){
              while($row = $result->fetch_row()){
          ?>
                <div class = 'figurina'>
                  <section class='movie_image'>
                      <img class='movie_poster' src = "<?php echo $row[5] ?>"> <!--la variabile row, che contiene riga per riga, ad ogni iterazione, il risultato della query, è un vettore i cui indici sono le colonne della tabella (quella indicata nella query) con indice a partire da 0-->
                  </section>  <!--es: nella tabella listino la colonna con indice 0 è "Codice", con indice 1 è "Nome" ecc.. (vedi phpMyAdmmin per l'ordine delle colonne)-->
                  <section class='center_fig'>
                    <div class='about_movie'>
                      <h3><?php echo $row[1] ?></h3>
                      <div class='movie_info'>
                        <p><?php echo $row[4] ?>€</p>
                      </div>
                      <div class='movie_desc'>
                        <p><?php echo $row[3] ?></p>
                      </div>
                      <form action='delete.php' method='post'>
                        <div class = 'nascondi'>
                          <input type = 'text' name = 'cod' value = <?php echo $row[0] ?> >
                        </div>
                        <input type='submit' value='Cancella prodotto'>
                      </form>
                    </div>
                  </section>
                </div>
          <?php
              }
          ?>
                <div class = 'figurina'>
                  <form action='insert.php' method='post' enctype='multipart/form-data'>
                    <section class='movie_image'>
              	       <input name='image' type='file' value = 'Inserisci immagine'>
                    </section>
                    <section class='center_fig'>
                      <div class='about_movie'>
                       <div class='cont_inp'><span><input class='gate' type = 'text' name = 'nomeInserito' placeholder = 'Inserisci nome prodotto'><label for='class'>Nome</label></span></div>
                       <div class='cont_inp'><span><input class='gate' type = 'text' name = 'categInserita' placeholder = 'Inserisci categoria prodotto'><label for='class'>Categoria</label></span></div>
                       <div class='cont_inp'><span><textarea class='gate' rows='4' cols='50' name = 'descInserita' placeholder = 'Inserisci descrizione prodotto'></textarea></span></div>
                       <div class='cont_inp'><span><input class='gate' type = 'number' name = 'prezzoInserito' placeholder = 'Inserisci prezzo prodotto'><?php echo "€" ?><label for='class'>Prezzo</label></span></div>
                       <input name= 'invia' type='submit' value='Aggiungi prodotto'>
                     </div>
                    </section>
                  </form>
                 </div>
          <?php
            } else {
              echo "Nessun dato trovato";
            }
          } else {
            header("Location: ./home.php");
          }
          $conn->close();
        } else {
           echo 'You are not authorized to access this page, please login. <br/>';
        }
          ?>
        </div>
      </div>
      <script>
        $(document).ready(function(){
          $("#nascondi").hide();
        });
      </script>
      <form class="" action="amministra.php" method="post">
        <input type="submit" name="sm" value="Salva modifiche">
      </form>
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
