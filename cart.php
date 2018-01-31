<?php
  include 'connection.php';
  include 'functions.php';
  sec_session_start();
  print_r($_SESSION['cart']);
  print_r($_SESSION);
?>
<a href="menu.php">Torna al menu</a>
