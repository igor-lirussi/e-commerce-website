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
    <!-- per debug -->
    <script src="js/post_function.js">

    </script>
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


       <!-- menu hamburger -->
        <div  class="open">
       	<span class="cls"></span>
       	<span>
       		<ul class="sub-menu ">
       			<li>
              <div class="saluto">Ciao Admin</title></div>
       			</li>
       			<li>
       				<p>Da qui puoi impostare i cibi che verranno visualizzati nel menu</p>
       			</li>
       			<li>
       				<a href="./logout.php" title="">Logout</a>
       			</li>
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
        <h2>Modifica il menù</h2>
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
                      <button class='bubbly-button' onclick="post('delete.php', {cod : <?php echo $row[0] ?> });">Cancella prodotto</button>
                    </div>
                  </section>
                </div>
          <?php
              }
          ?>
                <!-- per l'aggiunta  -->
                <div class = 'figurina'>
                  <form action='insert.php' method='post' enctype='multipart/form-data'>
                    <section class='movie_image'>
              	       <input name='image' type='file' value='Inserisci immagine'>
                    </section>
                    <section class='center_fig'>
                      <div class='about_movie'>
                       <div class='cont_inp'><span><input class='gate' type = 'text' name = 'nomeInserito' placeholder = 'Inserisci nome prodotto'><label for='class'>Nome</label></span></div>
                       <div class='cont_inp'><span><input class='gate' type = 'text' name = 'categInserita' placeholder = 'Inserisci categoria prodotto'><label for='class'>Categoria</label></span></div>
                       <div class='cont_inp'><span><textarea class='gate' rows='4' cols='50' name = 'descInserita' placeholder = 'Inserisci descrizione prodotto'></textarea></span></div>
                       <div class='cont_inp'><span><input class='gate' type = 'number' name = 'prezzoInserito' placeholder = 'Inserisci prezzo prodotto'><?php echo "€" ?><label for='class'>Prezzo</label></span></div>
                       <button class='bubbly-button' >Aggiungi prodotto</button>
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
                      <button class='bubbly-button' onclick="post('delete.php', {cod : <?php echo $row[0] ?> });">Cancella prodotto</button>
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
                      <button class='bubbly-button' onclick="post('delete.php', {cod : <?php echo $row[0] ?> });">Cancella prodotto</button>
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
