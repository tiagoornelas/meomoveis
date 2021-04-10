<?php

session_start();
date_default_timezone_set('America/Sao_Paulo');

  $empresa = $_POST["empresa"];
  $representante = $_POST["representante"];
  $celular_do_vendedor = $_POST["celular_do_vendedor"];
  $telefone_da_empresa = $_POST["telefone_da_empresa"];
  $endereco = $_POST["endereco"];

  require_once 'dbh-inc.php';

  $queryUpdate = $conn->query("update fornecedores set representante='$representante', celular_do_vendedor='$celular_do_vendedor',
    telefone_da_empresa='$telefone_da_empresa' where empresa='$empresa'");
  $affected_rows = mysqli_affected_rows($conn);

  if ($affected_rows>0) {
    header("location: /consulta_fornecedor.php?error=edited");
    exit();
  }
  else {
    header("location: /editar_fornecedor.php?error=notpossible");
    exit();
  }
