<?php

if (isset($_POST['submit'])) {
  $usuario = $_POST['usuario'];
  $senha = $_POST['senha'];

  require_once 'dbh-inc.php';
  require_once 'functions-inc.php';

  if (emptyInputLogin($usuario, $senha) != false) {
    header("location: /login.php?error=emptyInput");
    exit();
  }

  loginUser($conn, $usuario, $senha);
    session_start();
}
else {
  header("location: /index.php");
  exit();
}
