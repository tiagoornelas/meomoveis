<?php

session_start();
date_default_timezone_set('America/Sao_Paulo');

require_once 'dbh-inc.php';

$pay = filter_input(INPUT_GET, 'pay', FILTER_SANITIZE_NUMBER_INT);
$termo_da_pesquisa = $_GET['pay'];
$conteudo_pesquisa = "select * from lancamentos where id=$pay";
$sql = $conteudo_pesquisa;
$search = mysqli_query($conn,$sql);
$numero_clientes = mysqli_num_rows($search);

$exibirResultados = mysqli_fetch_array($search);
  $cpf = $exibirResultados[4];

  $payID = $_GET["pay"];

  $queryUpdate = $conn->query("update lancamentos set dataCred='', credito='' where ID=$payID");
  $affected_rows = mysqli_affected_rows($conn);

    header("location: /visualizar_cliente.php?cpf=$cpf");
    exit();
