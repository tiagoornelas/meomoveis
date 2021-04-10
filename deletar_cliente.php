<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">

<head>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Assistant&display=swap"
			rel="stylesheet">
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<title>Meo Móveis</title>
</head>
<body>
<?php include('elements/cabecalho.php');
			include('elements/barraLateral.php');
?>
<main>
		<?php

    require_once 'includes/dbh-inc.php';
    require_once 'includes/functions-inc.php';

    
    /* VERIFICAR DADOS DO CLIENTE */

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $termo_da_pesquisa = $_GET['id'];
    $conteudo_pesquisa = "select * from clientes where id=$id";
    $sql = $conteudo_pesquisa;
    $search = mysqli_query($conn,$sql);
    $numero_clientes = mysqli_num_rows($search);

    while($exibirResultados = mysqli_fetch_array($search)) {
      $id = $exibirResultados[0];
      $cpf = $exibirResultados[1];
      $nome = $exibirResultados[2];
      $referencia = $exibirResultados[3];
      $telefone = $exibirResultados[4];
      $endereco = $exibirResultados[5];}

    /* VERIFICAR SE O CLIENTE TEM VENDAS E LANCAMENTOS */
    
    $conteudo_pesquisa = "select * from lancamentos where clienteCPF = $cpf";
    $sql = $conteudo_pesquisa;
    $search = mysqli_query($conn,$sql);
    $numero_lancamentos = mysqli_num_rows($search);
    if ($numero_lancamentos > 0 ) {
        header('location: consulta_cliente.php?error=clientWithData');
        exit();
    } else {
    

			if (isset($_GET["search"])) {
				$pesquisa_realizada = true;
				$termo_da_pesquisa = $_GET['search'];
				$conteudo_pesquisa = "SELECT * from clientes where cpf like
					'%$termo_da_pesquisa%' or nome like '%$termo_da_pesquisa%' or
					referencia like '%$termo_da_pesquisa%'";
				}
				else {
				$pesquisa_realizada = false;
				$conteudo_pesquisa = "SELECT * from clientes";
			}

			$sql = $conteudo_pesquisa;
			$search = mysqli_query($conn,$sql);
			$numero_clientes = mysqli_num_rows($search);
		 ?>

		 <div class="popupFixo">
		     <div class="miniPopupContent">
			    <h1 class="tituloBanner">Deletar Cliente</h1><br><br>
					<h3 class="aviso">
						<?php
							print "Tem certeza que quer deletar $nome?";
						 ?>
					</h3><br>

			 		<form class="form" method="post" action=<?php echo "includes/deletar_cliente-inc.php?id=$id" ?>>

			      <input id="botaoDeletar" class="botao" name="submit" type="submit" value="Deletar">
			 		</form>
			      <button id="botaoCancelarDeletar" class="botaoSair"><a href="consulta_cliente.php" class="hideLink">Cancelar</a></button>
						<a href="consulta_cliente.php"><img src="img/close.png" class="close"></a>
				</div>
			</div>
			<div id="dashConsultaCliente">
	 				<div class="titulo">
	 					<h1 class="titulosSismeo">Consultar Clientes</h1><br><br>
							<h3 class="legendaConsultas">
								<?php
								if ($pesquisa_realizada == true) {
									if ($numero_clientes == 1) { /*Apenas para controle de plural */
										print "Apenas $numero_clientes cliente encontrado.";
									}
									else if ($numero_clientes == 0) {
										print "Nenhum cliente encontrado.";
									}
									else {
										print "$numero_clientes clientes encontrados.";
									}
								}
								else {
									if ($numero_clientes == 1) { /*Apenas para controle de plural */
										print "Apenas $numero_clientes cliente registrado no total.";
									}
									else if ($numero_clientes == 0) {
										print "Nenhum cliente registrado no total.";
									}
									else {
										print "$numero_clientes clientes registrados no total.";
									}
								}
    }
								?>
							</h3>
	 					</div>
	 							<?php include('elements/background_consulta_clientes_popup.php'); ?>
	</main>
</body>
