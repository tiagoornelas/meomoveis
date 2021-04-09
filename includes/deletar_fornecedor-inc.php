<?php

  require_once 'dbh-inc.php';

  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  $queryDelete = $conn->query("delete from fornecedores where id=$id");

  $affected_rows = mysqli_affected_rows($conn);

  if ($affected_rows>0) {
    header("location: /consulta_fornecedor.php?error=deleted");
    exit();
  }
  else {
    header("location: /consulta_fornecedor.php?error=deletenotpossible");
    exit();
  }
