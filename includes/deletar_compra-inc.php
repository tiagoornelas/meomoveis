<?php

  require_once 'dbh-inc.php';

  $compraID = filter_input(INPUT_GET, 'compraID', FILTER_SANITIZE_NUMBER_INT);
  $queryDelete = $conn->query("DELETE from lancamentos where compraID=$compraID");
  $queryDelete2 = $conn->query("DELETE from vendas where compraID=$compraID");

  $affected_rows = mysqli_affected_rows($conn);

  if ($affected_rows>0) {
    header("location: /consulta_vendas.php?error=purchaseDeleted");
    exit();
  }
  else {
    header("location: /consulta_vendas.php?error=purchaseNotDeleted");
    exit();
  }
