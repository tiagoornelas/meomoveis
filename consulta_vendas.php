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

			if (isset($_GET["start"])) {
				$pesquisa_realizada = true;
				$termo_da_pesquisa1 = $_GET['start'];
				$termo_da_pesquisa2 = $_GET['end'];
				$conteudo_pesquisa = "SELECT * from vendas where dataVenda > '$termo_da_pesquisa1' and dataVenda < '$termo_da_pesquisa2'
				 	ORDER BY dataVenda DESC LIMIT 50";
				}
				else {
				$pesquisa_realizada = false;
				$conteudo_pesquisa = "SELECT * from vendas ORDER BY dataVenda DESC LIMIT 50";
			}

			$sql = $conteudo_pesquisa;
			$search = mysqli_query($conn,$sql);
		  $numero_vendas = mysqli_num_rows($search);
			 ?>

</head>
<body>
 <main>
		<?php include('elements/cabecalho.php');
				 	include('elements/barraLateral.php');
		?>

	 <div id="dashConsultaCliente">
				<div class="titulo">
					<h1 class="titulosSismeo">Consultar Vendas</h1><br><br>
					<h3 class="legendaConsultas">
						<?php
						if ($pesquisa_realizada == true) {
							if ($numero_vendas == 1) { /*Apenas para controle de plural */
								print "Apenas $numero_vendas venda encontrada.";
							}
							else if ($numero_vendas == 0) {
								print "Nenhuma venda encontrada.";
							}
							else {
								print "$numero_vendas vendas encontrados. (mostra máx. 50)";
							}
						}
						else {
							if ($numero_vendas == 1) { /*Apenas para controle de plural */
								print "Apenas $numero_vendas venda registrado no total.";
							}
							else if ($numero_vendas == 0) {
								print "Nenhuma venda registrada no total.";
							}
							else {
								print "$numero_vendas vendas registradas no total. (mostra máx. 50)";
							}
						}
						?>
					</h3>
					</div>
					<div id="searchboxConsultas">
								<section>
								<form class="form" method="post" action="includes/consulta_vendas-inc.php">

									<input name="dataInicio" type="date" maxlength="255">   <input name="dataFim" type="date" maxlength="255">
					</div>
									<input id="botaoConsulta" name="submit" type="image" src="img/search.png">
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
									}
								 ?>
							</section>
						<table>
							<tr>
								<th></th>
								<th style="width:10%">Data</th>
								<th style="width:40%">Cliente</th>
								<th style="width:40%">Produto</th>
								<th>Fornecedor</th>
								<th style="width:20%">Valor</th>
							</tr>
								<?php

								while($exibirResultados = mysqli_fetch_array($search)) {
									$ID = $exibirResultados[0];
									$compraID = $exibirResultados[1];
									$dataVenda = $exibirResultados[2];
									$loja = $exibirResultados[3];
									$cliente = $exibirResultados[4];
									$clienteCPF = $exibirResultados[5];
									$descricaoGeral = $exibirResultados[6];
									$fornecedor = $exibirResultados[7];
									$produto = $exibirResultados[8];
									$preco = $exibirResultados[9];
									$pedido = $exibirResultados[10];
									$retira = $exibirResultados[11];
									$entrega = $exibirResultados[12];
									$assistencia = $exibirResultados[13];

										 print "<td><a class='hideLinkSymbol' id='deleteButton' href='deletar_compra.php?compraID=$compraID'>&#128465;</a></td>";
										 print "<td>$dataVenda</td>";
										 if (empty($cliente)) {
											 	print "<td><i>Venda Expressa</i></a></td>";
										 } else {
										 		print "<td><a href='visualizar_cliente.php?cpf=$clienteCPF'><b>$cliente</b></a></td>";
										}
										 print "<td><a href='visualizar_compra.php?compraID=$compraID'>$produto</td>";
										 print "<td>$fornecedor</td>";
										 print "<td>R$ " . number_format($preco, 2, ',', '.') . "</td></tr>";
									 }
								 ?>
							</table>
	</main>
</body>
