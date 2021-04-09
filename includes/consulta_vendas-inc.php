<?php

session_start();

  require_once 'dbh-inc.php';
  require_once 'functions-inc.php';

    $pesquisa_realizada = true;
    $termo_da_pesquisa1 = $_POST['dataInicio'];
    $termo_da_pesquisa2 = $_POST['dataFim'];
    $conteudo_pesquisa = "SELECT * from vendas where dataVenda >= '$termo_da_pesquisa1' and
            dataVenda <= '$termo_da_pesquisa2' ORDER BY dataVenda DESC LIMIT 50";

  $sql = $conteudo_pesquisa;
  $search = mysqli_query($conn,$sql);
  $numero_clientes = mysqli_num_rows($search);

  header("location: /consulta_vendas.php?start=$termo_da_pesquisa1&end=$termo_da_pesquisa2");
  exit();

?>
