<?php

$serverName = "localhost";
$dBUsername = "u573611555_tiago";
$dBPassword = "D6YT?juC*5zI";
$dBName = "u573611555_meomoveis";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
  die("Conexão com o banco de dados falhou: " . mysqli_connect_error());
}

# COLA PARA SERVIDOR HOSTINGER
#
# $serverName = "localhost";
# $dBUsername = "u573611555_tiago";
# $dBPassword = "D6YT?juC*5zI";
# $dBName = "u573611555_meomoveis";
#
# COLA PARA SERVIDOR LOCAL
#
# $serverName = "localhost";
# $dBUsername = "tiago";
# $dBPassword = "password";
# $dBName = "meomoveis";