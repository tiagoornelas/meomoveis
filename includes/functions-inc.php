<?php

function emptyInputCadCliente($cpf, $nome, $telefone, $endereco) {
  $result;
  if (empty($cpf) || empty($nome) || empty($telefone) || empty($endereco)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function emptyInputVendaExpressa($data, $produto, $preco) {
  $result;
  if (empty($data) || empty($produto) || empty($preco)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function emptyInputCadFornecedor($empresa, $representante, $celular_do_vendedor) {
  $result;
  if (empty($empresa) || empty($representante) || empty($celular_do_vendedor)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function emptyInputSearchCliente($cpf, $nome, $referencia) {
  $result;
  if (empty($cpf) && empty($nome) && empty($referencia)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function moreThanOneInputSearchCliente($cpf, $nome, $referencia) {
  $result;
  if (empty($cpf) && empty($nome) && empty($referencia)) {
    $result = false;
  }
  else if (empty($cpf) && empty($nome)){
    $result = false;
  }
  else if (empty($nome) && empty($referencia)){
    $result = false;
  }
  else if (empty($cpf) && empty($referencia)){
    $result = false;
  }
  else {
    $result = true;
  }
  return $result;
}

function alreadyRegisteredCadCliente($conn, $cpf, $nome) {

  $sql = "SELECT * FROM clientes WHERE CPF = ? OR NOME = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: /cadastro_cliente.php?error=stmtFailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $cpf, $nome);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if (mysqli_fetch_assoc($resultData)) {
    $result = true;
    return $result;
  }
  else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function alreadyRegisteredCadFornecedor($conn, $empresa, $telefone_da_empresa) {

  $sql = "SELECT * FROM fornecedores WHERE empresa = ? OR telefone_da_empresa = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: /cadastro_fornecedor.php?error=stmtFailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "ss", $empresa, $telefone_da_empresa);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if (mysqli_fetch_assoc($resultData)) {
    $result = true;
    return $result;
  }
  else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function createClient($conn, $cpf, $nome, $referencia, $telefone, $endereco,
  $criador, $criacao) {

  $sql = "INSERT INTO clientes (CPF, NOME, REFERENCIA, TELEFONE,
    ENDERECO, CRIADOR, CRIACAO) VALUES (?, ?, ?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: /cadastro_cliente.php?error=stmtFailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "sssssss", $cpf, $nome, $referencia, $telefone,
    $endereco, $criador, $criacao);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: /cadastro_cliente.php?error=none");
  exit();
}

function criarVendaExpressa($conn, $compraID, $data, $loja, $produto, $preco,
          $pedido, $retira, $entrega, $assistencia) {

  $sql = "INSERT INTO vendas (compraID, dataVenda, loja, produto,
    preco, pedido, retira, entrega, assistencia) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: /venda_expressa.php?error=stmtFailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "sssssiiii", $compraID, $data, $loja, $produto, $preco,
            $pedido, $retira, $entrega, $assistencia);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: /venda_expressa.php?error=none");
  exit();
}

function createFornecedor($conn, $empresa, $representante, $telefone_da_empresa,
  $celular_do_vendedor, $criador, $criacao) {

  $sql = "INSERT INTO fornecedores (empresa, representante, telefone_da_empresa,
    celular_do_vendedor, criador, criacao) VALUES (?, ?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: /cadastro_fornecedor.php?error=stmtFailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ssssss", $empresa, $representante, $telefone_da_empresa,
    $celular_do_vendedor, $criador, $criacao);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: /cadastro_fornecedor.php?error=none");
  exit();
}

function emptyInputLogin($usuario, $senha) {
  $result;
  if (empty($usuario) || empty($senha)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function userExists($conn, $usuario) {

  $sql = "SELECT * FROM usuarios WHERE username = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: /login.php?error=stmtFailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $usuario);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  }
  else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function loginUser($conn, $usuario, $senha) {
  $usuarioExists = userExists($conn, $usuario);

  if ($usuarioExists === false) {
    header("location: /login.php?error=wrongLogin");
    exit();
  }

  $senhaDB = $usuarioExists["password"];

  if ($senha !== $senhaDB) {
    header("location: /login.php?error=wrongLogin");
    exit();
  }
  else if ($senha === $senhaDB) {
    session_start();
    $usuario = $usuarioExists["username"];
    $_SESSION["usuario"] = $usuarioExists["username"];
    header('location: /sismeo.php');
    exit();
  }
}

function validaCPF($cpf) {
 
    // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;

}