<?php
  include 'functions.php';
  include 'connection.php';

  sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
  /*controllo che ci siano i dati, la password non ha il nome del form ma nome "p" creato dalla funzione di hashing*/
  if(isset($_POST['mail'], $_POST['p'])) {
    // Recupero tutti i dati di registrazione
    $zero = 0;
    $name = $_POST['nome'];
    $surname = $_POST['cognome'];
    $username = strtolower($name."_".$surname);
    $email = $_POST['mail'];
    $indir = $_POST['indirizzo'];
    $pagamento = $_POST['pagamento'];
    $numeroCarta = $_POST['numeroCarta'];
    $scadenza = $_POST['scadenza'];
    $cvv = $_POST['cvv'];
    $numeroMat = $_POST['numeroMat'];
    // Recupero la password criptata dal form di inserimento (ha nome p perchè è stato creato un elemento nascosto).
    $password = $_POST['p'];
    // Crea una chiave casuale
    $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
    // Crea una password usando la chiave appena creata.
    $password = hash('sha512', $password.$random_salt);
    // Inserisci a questo punto il codice SQL per eseguire la INSERT nel tuo database
    // Assicurati di usare statement SQL 'prepared'.

    if ($insert_stmt = $conn->prepare("INSERT INTO members ( nome, cognome, username, email, password, salt, indirizzo, TipoPagamento, NumeroCarta, Scadenza, CVV, NumeroMatricola)
                                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
      $insert_stmt->bind_param('ssssssssisii', $name, $surname, $username, $email, $password, $random_salt, $indir, $pagamento, $numeroCarta, $scadenza, $cvv, $numeroMat);
      // Esegui la query ottenuta.
      $insert_stmt->execute();
      header('Location: ./accedi.php?register=0');
    } else {
      echo 'errore di connessione database';
    }
  } else {
   // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Non sono stati passati tutti i parametri.';
  }


?>
