<?php

session_start();

  require_once 'dbh-inc.php';
  require_once 'functions-inc.php';

    $pesquisa_realizada = true;
    $termo_da_pesquisa = $_POST['pesquisa'];
    $conteudo_pesquisa = "SELECT * from vendas where fornecedor like '%$termo_da_pesquisa%'
      and pedido like '1'";

  $sql = $conteudo_pesquisa;
  $search = mysqli_query($conn,$sql);
  $numero_pedidos = mysqli_num_rows($search);

  header("location: /logistica_pedidos.php?search=$termo_da_pesquisa");
  exit();

?>
