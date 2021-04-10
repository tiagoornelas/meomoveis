
<?php

  require_once 'dbh-inc.php';

  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  $queryDelete = $conn->query("UPDATE vendas SET entrega = 0 where ID = $id");

  $affected_rows = mysqli_affected_rows($conn);

  if ($affected_rows>0) {
    header("location: /logistica_entregas.php?error=changed");
    exit();
  }
  else {
    header("location: /logistica_entregas.php?error=changenotpossible");
    exit();
  }
?>
