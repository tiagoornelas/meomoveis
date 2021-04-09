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
				$conteudo_pesquisa = "SELECT * from clientes where cpf like
					'%$termo_da_pesquisa%' or nome like '%$termo_da_pesquisa%' or
					referencia like '%$termo_da_pesquisa%' ORDER BY NOME ASC";
				}
				else {
				$pesquisa_realizada = false;
				$conteudo_pesquisa = "SELECT * from clientes ORDER BY NOME ASC";
			}

			$sql = $conteudo_pesquisa;
			$search = mysqli_query($conn,$sql);
		  $numero_clientes = mysqli_num_rows($search);
			 ?>

</head>
<body>
 <main>
		<?php include('elements/cabecalho.php');
				 	include('elements/barraLateral.php');
		?>

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
						?>
					</h3>
					</div>
					<div id="searchboxConsultas">
								<section>
								<form class="form" method="post" action="includes/consulta_cliente-inc.php">

									<input name="pesquisa" type="text" maxlength="255" placeholder="CPF / Nome / Referência">
					</div>
									<input id="botaoConsulta" name="submit" type="image" src="img/search.png">
									<a href="cadastro_cliente.php"><img id="botaoCadastro" src="img/add-person.png"></a>
								</form>

								<?php
									if (isset($_GET["error"])) {
										if ($_GET["error"] == "emptyInput") {
											echo "<h1 class='aviso'>Preencha pelo menos um campo!</h1>";
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
										if ($_GET["error"] == "purchaseDeleted") {
											echo "<h1 class='aviso'>Compra deletada com sucesso.</h1>";
										}
										if ($_GET["error"] == "purchaseNotDeleted") {
											echo "<h1 class='aviso'>Não foi possível deletar a compra.</h1>";
										}
										if ($_GET["error"] == "clientWithData") {
											echo "<h1 class='aviso'>Não é possível deletar clientes com compras ou lançamentos financeiros.</h1>";
										}
									}
								 ?>
							</section>
						<table>
							<tr>
								<th></th>
								<th></th>
								<th>CPF</th>
								<th style="width:40%">Nome</th>
								<th style="width:40%">Referência</th>
								<th>Telefone</th>
							</tr>
								<?php
									 while($exibirResultados = mysqli_fetch_array($search)) {
										 $id = $exibirResultados[0];
										 $cpf = $exibirResultados[1];
										 $nome = $exibirResultados[2];
										 $referencia = $exibirResultados[3];
										 $telefone = $exibirResultados[4];

										 print "<td><a class='hideLinkSymbol' href='editar_cliente.php?id=$id'>&#x270E;</a></td>";
										 print "<td><a class='hideLinkSymbol' id='deleteButton' href='deletar_cliente.php?id=$id'>&#128465;</a></td>";
										 print "<td>$cpf</td>";
										 print "<td><a href='visualizar_cliente.php?cpf=$cpf'><b>$nome</b></a></td>";
										 print "<td><i>$referencia</i></td>";
										 print "<td>$telefone</td></tr>";
									 }
								 ?>
							</table>
	</main>
</body>
