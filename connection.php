<?php

  $servername = "localhost";
  $username = "sec_user";
  $password = "gtTsfOlrsGRi";
  $dbname = "databasesito";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

?>
