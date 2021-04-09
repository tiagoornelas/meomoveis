<?php

session_start();
date_default_timezone_set('America/Sao_Paulo');

  $empresa = $_POST["empresa"];
  $representante = $_POST["representante"];
  $telefone_da_empresa = $_POST["telefone_da_empresa"];
  $celular_do_vendedor = $_POST["celular_do_vendedor"];
  $criador = $_SESSION["usuario"];
  $criacao = date('d/m/Y h:i:s a', time());

  require_once 'dbh-inc.php';
  require_once 'functions-inc.php';

  if (emptyInputCadFornecedor($empresa, $representante, $celular_do_vendedor) != false) {
    header("location: /cadastro_fornecedor.php?error=emptyInput");
    exit();
  }
  if (alreadyRegisteredCadFornecedor($conn, $empresa, $telefone_da_empresa) != false) {
    header("location: /cadastro_fornecedor.php?error=alreadyRegistered");
    exit();
  }

  createFornecedor($conn, $empresa, $representante, $telefone_da_empresa,
    $celular_do_vendedor, $criador, $criacao);
