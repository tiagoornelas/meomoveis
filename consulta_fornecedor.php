<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">

<head>

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Assistant&display=swap"
			rel="stylesheet">
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<title>Meo Móveis</title>

			<?php
			require_once 'includes/dbh-inc.php';
		  require_once 'includes/functions-inc.php';

			if (isset($_GET["search"])) {
				$pesquisa_realizada = true;
				$termo_da_pesquisa = $_GET['search'];
				$conteudo_pesquisa = "SELECT * from fornecedores where empresa like
					'%$termo_da_pesquisa%' ORDER BY empresa ASC";
				}
				else {
				$pesquisa_realizada = false;
				$conteudo_pesquisa = "SELECT * from fornecedores ORDER BY empresa ASC";
			}

			$sql = $conteudo_pesquisa;
			$search = mysqli_query($conn,$sql);
		  $numero_fornecedores = mysqli_num_rows($search);
			 ?>

</head>
	<body>
	 <main>
		 <?php include('elements/cabecalho.php');
 				 	include('elements/barraLateral.php');
 				?>

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
								?>
							</h3>
						</div>
						<div id="searchboxConsultas">
									<section>
									<form class="form" method="post" action="includes/consulta_fornecedor-inc.php">
										<input name="pesquisa" type="text" maxlength="255" placeholder="Nome do Fornecedor"><br>
									</div>
										<input id="botaoConsulta" name="submit" type="image" src="img/search.png">
										<a href="cadastro_fornecedor.php"><img id="botaoCadastro" src="img/add-person.png"></a>
									</form>

									<?php
										if (isset($_GET["error"])) {
											if ($_GET["error"] == "emptyInput") {
												echo "<h1 class='aviso'>Preencha pelo menos um campo!</h1>";
											}
											if ($_GET["error"] == "moreThanOneInput") {
												echo "<h1 class='aviso'>Preencha somente um dos campos!</h1>";
											}
											if ($_GET["error"] == "stmtFailed") {
												echo "<h1 class='aviso'>Não consegui te conectar!</h1>";
											}
											if ($_GET["error"] == "none") {
												echo "<h1 class='aviso'>Pesquisa realizada.</h1>";
											}
											if ($_GET["error"] == "edited") {
												echo "<h1 class='aviso'>Registro editado com sucesso.</h1>";
											}
											if ($_GET["error"] == "deleted") {
												echo "<h1 class='aviso'>Registro deletado com sucesso.</h1>";
											}
											if ($_GET["error"] == "deletenotpossible") {
												echo "<h1 class='aviso'>Não foi possível deletar o registro.</h1>";
											}
											if ($_GET["error"] == "providerWithData") {
												echo "<h1 class='aviso'>Não é possível deletar fornecedor com vendas.</h1>";
											}
										}
									 ?>
									</section>
									<table>
										<tr>
											<th></th>
											<th></th>
											<th style="width:40%">Empresa</th>
											<th style="width:40%">Representante</th>
											<th>Retira</th>
											<th>Vendedor</th>
										</tr>
											<?php
												 while($exibirResultados = mysqli_fetch_array($search)) {
													 $id = $exibirResultados[0];
													 $empresa = $exibirResultados[1];
													 $representante = $exibirResultados[2];
													 $telefone_da_empresa = $exibirResultados[3];
													 $celular_do_vendedor = $exibirResultados[4];

													 print "<td><a class='hideLinkSymbol' href='editar_fornecedor.php?id=$id'>&#x270E;</a></td>";
													 print "<td><a class='hideLinkSymbol' id='deleteButton' href='deletar_fornecedor.php?id=$id'>&#128465;</a></td>";
													 print "<td><b><a href='visualizar_fornecedor.php?id=$id'>$empresa</a></b></td>";
													 print "<td><i>$representante</i></td>";
													 print "<td>$telefone_da_empresa</td>";
													 print "<td>$celular_do_vendedor</td></tr>";
												 }
											 ?>
										</table>
									</main>
</body>
