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
  $id = $exibirResultados[0];
  $cpf = $exibirResultados[4];
  $descricaoGeral = $exibirResultados[6];
  $parcelaN = $exibirResultados[7];
  $parcelaT = $exibirResultados[8];
  $valorParcela = $exibirResultados[9];
  $dataDeb = $exibirResultados[10];
  $valorPago = $exibirResultados[11];
  $dataCred = $exibirResultados[12];

  $cpf = $_GET["cpf"];
  $previous = $valorPago;
  $payID = $_GET["pay"];
  $data = $_POST["data"];
  $valorPago = $_POST["valor"];
  $pagamentoTotal = (floatval($valorPago) + floatval($previous));

  if ($pagamentoTotal == $valorParcela) {

  $queryUpdate = $conn->query("update lancamentos set dataCred='$data', credito='$pagamentoTotal' where ID=$payID");
  $affected_rows = mysqli_affected_rows($conn);

    header("location: /visualizar_cliente.php?cpf=$cpf");
    exit();
} if ($pagamentoTotal<$valorParcela) {

  $queryUpdate = $conn->query("update lancamentos set credito='$pagamentoTotal' where ID=$payID");
  $affected_rows = mysqli_affected_rows($conn);

    header("location: /visualizar_cliente.php?cpf=$cpf");
    exit();
}  if ($pagamentoTotal>$valorParcela) {
    header("location: /receber_pagamento.php?cpf=$cpf&pay=$id&error=overpay");
    exit();
}
