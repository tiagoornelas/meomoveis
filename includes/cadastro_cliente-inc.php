<?php

session_start();
date_default_timezone_set('America/Sao_Paulo');

if (isset($_POST["submit"])) { /*verificando se o usuário veio pelo form*/

  $cpf = $_POST["cpf"];
  $nome = $_POST["nome"];
  $referencia = $_POST["referencia"];
  $telefone = $_POST["telefone"];
  $endereco = $_POST["endereco"];
  $criador = $_SESSION["usuario"];
  $criacao = date('d/m/Y h:i:s a', time());

  require_once 'dbh-inc.php';
  require_once 'functions-inc.php';

  if (emptyInputCadCliente($cpf, $nome, $telefone, $endereco) != false) {
    header("location: /cadastro_cliente.php?error=emptyInput");
    exit();
  }
  if (alreadyRegisteredCadCliente($conn, $cpf, $nome) != false) {
    header("location: /cadastro_cliente.php?error=alreadyRegistered");
    exit();
  }
    if (validaCPF($cpf) == false) {
    header("location: /cadastro_cliente.php?error=invalidCPF");
    exit();
  }

  createClient($conn, $cpf, $nome, $referencia, $telefone, $endereco, $criador,
    $criacao);

} else {
  header("location: /index.php");
}
