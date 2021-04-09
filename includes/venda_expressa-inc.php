<?php

session_start();
date_default_timezone_set('America/Sao_Paulo');

if (isset($_POST["submit"])) { /*verificando se o usuário veio pelo form*/

  $compraID = date('dmYhis', time());
  $data = $_POST["data"];
  $loja = 'MATRIZ';
  $produto = $_POST["produto"];
  $preco = $_POST["preco"];
  $pedido = '0';
  $retira = '0';
  $entrega = '0';
  $assistencia = '0';


  require_once 'dbh-inc.php';
  require_once 'functions-inc.php';

  if (emptyInputVendaExpressa($data, $produto, $preco) != false) {
    header("location: /cadastro_cliente.php?error=emptyInput");
    exit();
  }

  criarVendaExpressa($conn, $compraID, $data, $loja, $produto, $preco,
            $pedido, $retira, $entrega, $assistencia);

} else {
  header("location: /index.php");
}
