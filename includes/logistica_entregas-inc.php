<?php

session_start();

  require_once 'dbh-inc.php';
  require_once 'functions-inc.php';

    $pesquisa_realizada = true;
    $termo_da_pesquisa = $_POST['pesquisa'];
    $conteudo_pesquisa = "SELECT * from vendas where cliente like '%$termo_da_pesquisa%'
      and entrega like '1'";

  $sql = $conteudo_pesquisa;
  $search = mysqli_query($conn,$sql);
  $numero_entregas = mysqli_num_rows($search);

  header("location: /logistica_entregas.php?search=$termo_da_pesquisa");
  exit();

?>
