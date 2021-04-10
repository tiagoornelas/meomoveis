<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "meomoveis";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
  die("Conexão com o banco de dados falhou: " . mysqli_connect_error());
}
