
<?php

  require_once 'dbh-inc.php';

  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  $queryDelete = $conn->query("UPDATE vendas SET pedido = 01 where id = $id");

  $affected_rows = mysqli_affected_rows($conn);
  header("location: /logistica_pedidos.php");
  exit();

?>
