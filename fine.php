<!DOCTYPE html>
<html lang="it">

  <head>
    <meta charset="utf-8">
    <title>Yook - Ordine Completato</title>
    <link rel="icon" href="resources/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
    <!-- per barra progressi -->
    <link rel="stylesheet" type="text/css" title="stylesheet" href="./css/progress.css">
    <!-- per scontrino -->
    <link rel="stylesheet" type="text/css" title="stylesheet" href="./css/receipt.css">

  </head>

  <body>

    <!-- inizio corpo del sito, displayed dopo il loading-->
<div id="allpage">
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
       <h2>Make it Yours.</h2>
       <p>Il tuo ordine è stato accetato!</p>
     </header>


        <!-- barra progressi -->
        <div class="" style="background-color: white">
          <ul class="checkout-bar">
            <li class="visited">Menù</li>
            <li class="visited">Luogo Consegna</li>
            <li class="visited">Carrello</li>
            <li class="visited">Pagamento</li>
            <li class="last">Fine</li>
          </ul>
        </div>

    <div class = "row easy1sfondo allcenter">
        <br><br><br>
        <img src="./resources/menu/ordinecom.png" width="30%">

        <!-- scontrino -->
        <div class="scontrino">
        <section class="performance-facts">
          <div class="performance-facts__header">
            <h1 class="performance-facts__title">Riepilogo</h1>
            <p>ordine: <?php echo $_SESSION['num_ordine']; ?></p>
            <p class="small-info">Scontrino non valido ai fini fiscali</p><br>
          </div>
          <table class="performance-facts__table">
            <thead>
              <tr>
                <div class="small-info">
                  <p>date:  <?php echo date(' jS \of F Y h:i:s A'); ?></p>
                </div>
              </tr>
            </thead>
            <tbody>
              <tr>
                <br>  <b><?php echo $_SESSION['cibi_ordine']; ?></b>
              </tr>
            </tbody>
          </table>
          <p class="small-info"><br>Consegna in</p>
          <p class="small-info">*** <?php echo $_SESSION['indir_ordine']; ?> ***</br></br></p>

          <table class="performance-facts__table--small small-info">
            <thead>
              <tr>
                <td colspan="2"></td>
                <th>Sconto:</th>
                <th>&nbsp;</th>
                <th>Costo</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th colspan="2">Spese consgna</th>
                <td>Non previsto</td>
                <td></td>
                <td>0 €</td>
              </tr>
              <tr>
                <td class="blank-cell"></td>
                <th>-di cui speciali</th>
                <td>Non previsto</td>
                <td>&nbsp;</td>
                <td>0 €</td>
              </tr>
              <tr>
                <th colspan="2">Spese extra-rapido</th>
                <td>Non previsto</td>
                <td>&nbsp;</td>
                <td>0 €</td>
              </tr>
              <tr>
                <th colspan="2">Spese ZTL</th>
                <td>Non previsto</td>
                <td>&nbsp;</td>
                <td>0 €</td>
              </tr>
              <tr>
                <th colspan="3"> &nbsp; </th>
                <td> &nbsp;</td>
                <td>&nbsp; </td>
              </tr>
              <tr>
                <td class="blank-cell"></td>
                <th colspan="2"><b>Totale Spese consegna</b></th>
                <td>&nbsp;</td>
                <td><b>0 €</b></td>
              </tr>
              <tr>
                <td class="blank-cell"></td>
                <th colspan="2"><b>Totale Spese ordine</b></th>
                <td>&nbsp;</td>
                <td><b><?php echo $_SESSION['totale_ordine']; ?> €</b></td>
              </tr>
            </tbody>
          </table>

          <p>Totale: <?php echo $_SESSION['totale_ordine']; ?> €</p>

          <p class="small-info">
            <?php echo "</br>ID utente: ".$_SESSION['user_id']; ?>
          </p>
          <p class="small-info">
            <?php echo "</br>Punti attuali utente: ".$_SESSION['punti']; ?>
          </p>
          <p class="small-info text-center">------------------------------------------------------------</p>
          <p class="small-info text-center">&bull; Yook S.r.l. &bull;</p>
          <p class="small-info text-center">  P.Iva: 02684269693 <br>REA: RA-526419
          </p>

        </section>
      </div>
      <!-- fine scontrino -->
<br>

        <form class="" action="amministra.php" method="post">
          <button class="btn third">Torna alla home</button>
        </form>
    </div>



    <?php
    //alternativa alla pagina
    } else {
       echo 'You are not authorized to access this page, please login. <br/>';
       echo "<a href='accedi.php'>Accedi</a>";
    }
    ?>

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

</html>
