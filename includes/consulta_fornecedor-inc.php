<?php

session_start();

  require_once 'dbh-inc.php';
  require_once 'functions-inc.php';

    $pesquisa_realizada = true;
    $termo_da_pesquisa = $_POST['pesquisa'];
    $conteudo_pesquisa = "SELECT * from fornecedores where empresa like '%$termo_da_pesquisa%'";

  $sql = $conteudo_pesquisa;
  $search = mysqli_query($conn,$sql);
  $numero_fornecedores = mysqli_num_rows($search);

  header("location: /consulta_fornecedor.php?search=$termo_da_pesquisa");
  exit();

  ?>
