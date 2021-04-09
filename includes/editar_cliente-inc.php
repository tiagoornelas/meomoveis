<?php

session_start();
date_default_timezone_set('America/Sao_Paulo');

  $cpf = $_POST["cpf"];
  $nome = $_POST["nome"];
  $referencia = $_POST["referencia"];
  $telefone = $_POST["telefone"];
  $endereco = $_POST["endereco"];

  require_once 'dbh-inc.php';

  $queryUpdate = $conn->query("update clientes set nome='$nome', referencia='$referencia',
    telefone='$telefone', endereco='$endereco' where cpf='$cpf'");
  $affected_rows = mysqli_affected_rows($conn);
    

  if ($affected_rows>0) {
    header("location: /consulta_cliente.php?error=edited");
    exit();
  }
  else {
    header("location: /editar_cliente.php?error=notpossible");
    exit();
  }
