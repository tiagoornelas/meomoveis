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
    
    /* VERIFICAR DADOS DO FORNECEDOR */

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $termo_da_pesquisa = $_GET['id'];
    $conteudo_pesquisa = "select * from fornecedores where id=$id";
    $sql = $conteudo_pesquisa;
    $search = mysqli_query($conn,$sql);
    $numero_fornecedores = mysqli_num_rows($search);

    while($exibirResultados = mysqli_fetch_array($search)) {
      $id = $exibirResultados[0];
      $empresa = $exibirResultados[1];
      $representante = $exibirResultados[2];
      $telefone_da_empresa = $exibirResultados[3];
      $celular_do_vendedor= $exibirResultados[4];}

    /* VERIFICAR SE O FORNECEDOR TEM VENDAS */
    $conteudo_pesquisa = "SELECT * FROM vendas WHERE fornecedor='$empresa'";
    $sql = $conteudo_pesquisa;
    $search = mysqli_query($conn,$sql);
    $numero_vendas = mysqli_num_rows($search);
    if ($numero_vendas > 0 ) {
        header('location: consulta_fornecedor.php?error=providerWithData');
        exit();
    } else {

			if (isset($_GET["search"])) {
				$pesquisa_realizada = true;
				$termo_da_pesquisa = $_GET['search'];
				$conteudo_pesquisa = "SELECT * from fornecedores where empresa like
					'%$termo_da_pesquisa%'";
				}
				else {
				$pesquisa_realizada = false;
				$conteudo_pesquisa = "SELECT * from fornecedores";
			}

			$sql = $conteudo_pesquisa;
			$search = mysqli_query($conn,$sql);
			$numero_fornecedores = mysqli_num_rows($search);
		 ?>

	<div class="popupFixo">
		 <div class="miniPopupContent">
    <h1 class="tituloBanner">Deletar Fornecedor</h1><br><br>
		<h3 class="aviso">
			<?php
				print "Tem certeza que quer deletar $empresa?";
			 ?>
		</h3><br>

 		<form class="form" method="post" action=<?php echo "includes/deletar_fornecedor-inc.php?id=$id" ?>>
      <input id="botaoDeletar" class="botao" name="submit" type="submit" value="Deletar">
		</form>
      <button id="botaoCancelarDeletar" class="botaoSair"><a href="consulta_fornecedor.php" class="hideLink">Cancelar</a></button>
			</div>
		</div>
		<div id="dashConsultaCliente">
				<div class="titulo">
					<h1 class="titulosSismeo">Consultar Fornecedores</h1><br><br>
					<h3 class="legendaConsultas">
						<?php
						if ($pesquisa_realizada == true) {
							if ($numero_fornecedores == 1) { /*Apenas para controle de plural */
								print "Apenas $numero_fornecedores fornecedor encontrado.";
							}
							else if ($numero_fornecedores == 0) {
								print "Nenhum fornecedor encontrado.";
							}
							else {
								print "$numero_fornecedores fornecedores encontrados.";
							}
						}
						else {
							if ($numero_fornecedores == 1) { /*Apenas para controle de plural */
								print "Apenas $numero_fornecedores fornecedor registrado no total.";
							}
							else if ($numero_fornecedores == 0) {
								print "Nenhum fornecedor registrado no total.";
							}
							else {
								print "$numero_fornecedores fornecedores registrados no total.";
							}
						}
    }
						?>
					</h3>
				</div>
		<?php include('elements/background_consulta_fornecedores_popup.php'); ?>
	</main>
</body>
