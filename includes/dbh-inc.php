<?php

$serverName = "localhost";
$dBUsername = "u573611555_tiago";
$dBPassword = "@&kgI2@aT0";
$dBName = "u573611555_meomoveis";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
  die("Conexão com o banco de dados falhou: " . mysqli_connect_error());
}
