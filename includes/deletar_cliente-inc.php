
<?php

  require_once 'dbh-inc.php';

  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  $queryDelete = $conn->query("delete from clientes where id=$id");
  $affected_rows = mysqli_affected_rows($conn);

  if ($affected_rows>0) {
    header('Location: /consulta_cliente.php?error=deleted');
    exit();
  }
  else {
    header('Location: /consulta_cliente.php?error=deletenotpossible');
    exit();
  }
?>