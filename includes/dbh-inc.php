<?php

$serverName = "localhost";
$dBUsername = "u573611555_tiago";
$dBPassword = "2#tPfvjvZcA";
$dBName = "u573611555_meomoveis";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
  die("Conexão com o banco de dados falhou: " . mysqli_connect_error());
}
