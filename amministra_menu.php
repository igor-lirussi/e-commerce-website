<!DOCTYPE html>
<html lang="it">

  <head>
    <meta charset="utf-8">
    <title>Yook - Amministra Menu</title>
    <link rel="icon" href="resources/logo.png" />
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
                <div class='figurina'>
                  <section class='movie_image'>
                      <img class='movie_poster' src="<?php echo $row[5] ?>"> <!--la variabile row, che contiene riga per riga, ad ogni iterazione, il risultato della query, è un vettore i cui indici sono le colonne della tabella (quella indicata nella query) con indice a partire da 0-->
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
                <div class='figurina'>
                  <form action='insert.php' method='post' enctype='multipart/form-data'>
                    <section class='movie_image'>
                      <div class="center">
                        </br>
                        <!-- immagine che al click fa click sull'elemento inputfile nascosto, poi ne prende il valore, ci toglie la parte del percorso e lo inserisce in un div per mostrare il nome del file -->
                        <img class='movie_poster' onclick="$('#inp_file_pasti').click(); " src="./resources/amministrazione/mini-allega.gif">
                        <input name='image' type='file' id="inp_file_pasti" style="display:none" value='Inserisci immagine' onchange=" $('#des_file_pasti').text( $(this).val().split(/(\\|\/)/g).pop() ); " >
                        <div id="des_file_pasti" style="color:white">Allegare immagine</div>
                      </div>
                    </section>
                    <section class='center_fig'>
                      <div class='about_movie'>
                       <div class='cont_inp'><span><input class='gate' type='text' name='nomeInserito' placeholder='Inserisci nome prodotto'><label for='class'>Nome</label></span></div>
                       <div class='cont_inp'><span><input class='gate' type='text' name='categInserita' value="Pasti Veloci" placeholder='Inserisci categoria prodotto'><label for='class'>Categoria</label></span></div>
                       <div class='cont_inp'><span><textarea class='gate' rows='4' cols='50' name='descInserita' placeholder='Inserisci descrizione prodotto'></textarea></span></div>
                       <div class='cont_inp'><span><input class='gate' type='number' name='prezzoInserito' placeholder='Inserisci prezzo prodotto'><label for='class'>Prezzo</label></span></div>
                       <button class='bubbly-button'>Aggiungi prodotto</button>
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
            <div class='figurina'>
              <section class='movie_image'>
                  <img class='movie_poster' src="<?php echo $row[5] ?>"> <!--la variabile row, che contiene riga per riga, ad ogni iterazione, il risultato della query, è un vettore i cui indici sono le colonne della tabella (quella indicata nella query) con indice a partire da 0-->
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
          <div class='figurina'>
            <form action='insert.php' method='post' enctype='multipart/form-data'>
              <section class='movie_image'>
                <div class="center">
                  </br>
                  <!-- immagine che al click fa click sull'elemento inputfile nascosto, poi ne prende il valore, ci toglie la parte del percorso e lo inserisce in un div per mostrare il nome del file -->
                  <img class='movie_poster' onclick="$('#inp_file_primi').click(); " src="./resources/amministrazione/mini-allega.gif">
                  <input name='image' type='file' id="inp_file_primi" style="display:none" value='Inserisci immagine' onchange=" $('#des_file_primi').text( $(this).val().split(/(\\|\/)/g).pop() ); " >
                  <div id="des_file_primi" style="color:white">Allegare immagine</div>
                </div>
              </section>
              <section class='center_fig'>
                <div class='about_movie'>
                 <div class='cont_inp'><span><input class='gate' type='text' name='nomeInserito' placeholder='Inserisci nome prodotto'><label for='class'>Nome</label></span></div>
                 <div class='cont_inp'><span><input class='gate' type='text' name='categInserita' value="Primi" placeholder='Inserisci categoria prodotto'><label for='class'>Categoria</label></span></div>
                 <div class='cont_inp'><span><textarea class='gate' rows='4' cols='50' name='descInserita' placeholder='Inserisci descrizione prodotto'></textarea></span></div>
                 <div class='cont_inp'><span><input class='gate' type='number' name='prezzoInserito' placeholder='Inserisci prezzo prodotto'><label for='class'>Prezzo</label></span></div>
                 <button class='bubbly-button'>Aggiungi prodotto</button>
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
            <div class='figurina'>
              <section class='movie_image'>
                  <img class='movie_poster' src="<?php echo $row[5] ?>"> <!--la variabile row, che contiene riga per riga, ad ogni iterazione, il risultato della query, è un vettore i cui indici sono le colonne della tabella (quella indicata nella query) con indice a partire da 0-->
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
          <div class='figurina'>
            <form action='insert.php' method='post' enctype='multipart/form-data'>
              <section class='movie_image'>
                <div class="center">
                  </br>
                  <!-- immagine che al click fa click sull'elemento inputfile nascosto, poi ne prende il valore, ci toglie la parte del percorso e lo inserisce in un div per mostrare il nome del file -->
                  <img class='movie_poster' onclick="$('#inp_file_bev').click(); " src="./resources/amministrazione/mini-allega.gif">
                  <input name='image' type='file' id="inp_file_bev" style="display:none" value='Inserisci immagine' onchange=" $('#des_file_bev').text( $(this).val().split(/(\\|\/)/g).pop() ); " >
                  <div id="des_file_bev" style="color:white">Allegare immagine</div>
                </div>
              </section>
              <section class='center_fig'>
                <div class='about_movie'>
                 <div class='cont_inp'><span><input class='gate' type='text' name='nomeInserito' placeholder='Inserisci nome prodotto'><label for='class'>Nome</label></span></div>
                 <div class='cont_inp'><span><input class='gate' type='text' name='categInserita' value="Bevande" placeholder='Inserisci categoria prodotto'><label for='class'>Categoria</label></span></div>
                 <div class='cont_inp'><span><textarea class='gate' rows='4' cols='50' name='descInserita' placeholder='Inserisci descrizione prodotto'></textarea></span></div>
                 <div class='cont_inp'><span><input class='gate' type='number' name='prezzoInserito' placeholder='Inserisci prezzo prodotto'><label for='class'>Prezzo</label></span></div>
                 <button class='bubbly-button'>Aggiungi prodotto</button>
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

      <div class="row listino center">
        <form class="" action="amministra.php" method="post">
          <button class="btn third">Salva modifiche</button>
        </form>
      </div>

    </div>
    <footer>
      <?php
        include 'footer.php';
        print_footer();
      ?>
    </footer>
  </body>
</html>
