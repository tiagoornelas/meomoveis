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
				$conteudo_pesquisa = "SELECT vendas.ID, vendas.compraID, vendas.dataVenda, vendas.loja, vendas.cliente,
																vendas.clienteCPF, vendas.descricaoGeral, vendas.fornecedor, vendas.produto,
																clientes.telefone, DateDiff(vendas.dataVenda, CURRENT_DATE()) as 'Atraso'
															FROM vendas
															RIGHT JOIN clientes
															ON vendas.clienteCPF = clientes.CPF
															where cliente like '%$termo_da_pesquisa%'
		      										AND assistencia = '1'";
				}
				else {
				$pesquisa_realizada = false;
				$conteudo_pesquisa = "SELECT vendas.ID, vendas.compraID, vendas.dataVenda, vendas.loja, vendas.cliente,
																vendas.clienteCPF, vendas.descricaoGeral, vendas.fornecedor, vendas.produto,
																clientes.telefone, DateDiff(vendas.dataVenda, CURRENT_DATE()) as 'Atraso'
															FROM vendas
															RIGHT JOIN clientes
															ON vendas.clienteCPF = clientes.CPF
															WHERE assistencia = '1';";
			}

			$sql = $conteudo_pesquisa;
			$search = mysqli_query($conn,$sql);
		  $numero_assistencias = mysqli_num_rows($search);
			 ?>

</head>
<body>
 <main>
		<?php include('elements/cabecalho.php');
				 	include('elements/barraLateral.php');
		?>

	 <div id="dashConsultaCliente">
				<div class="titulo">
					<h1 class="titulosSismeo">Logística: Assistências</h1><br><br>
					<h3 class="legendaConsultas">
						<?php
							if ($numero_assistencias == 1) { /*Apenas para controle de plural */
								print "Apenas $numero_assistencias assistência pendente.";
							}
							else if ($numero_assistencias == 0) {
								print "Nenhuma assistência pendente.";
							}
							else {
								print "$numero_assistencias assistências pendentes.";
							}
						?>
					</h3>
					</div>
					<div id="searchboxConsultas">
								<section>
								<form class="form" method="post" action="includes/logistica_assistencias-inc.php">

									<input name="pesquisa" type="text" maxlength="255" placeholder="Cliente">
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
										if ($_GET["error"] == "changed") {
											echo "<h1 class='aviso'>Assistência realizada com sucesso.</h1>";
										}
										if ($_GET["error"] == "changenotpossible") {
											echo "<h1 class='aviso'>Não foi possível editar o registro.</h1>";
										}
									}
								 ?>
							</section>
						<table>
							<tr>
								<th style="width:10%">Loja</th>
								<th style="width:30%">Cliente</th>
								<th style="width:10%">Fornecedor</th>
								<th style="width:30%">Produto</th>
								<th style="width:10%"></th>
								<th style="width:10%"></th>
								
							</tr>
								<?php
									 while($exibirResultados = mysqli_fetch_array($search)) {
										 $id = $exibirResultados[0];
										 $compraID = $exibirResultados[1];
										 $venda = $exibirResultados[2];
										 $loja = $exibirResultados[3];
										 $cliente = $exibirResultados[4];
										 $fornecedor = $exibirResultados[7];
										 $produto = $exibirResultados[8];
										 $cpf = $exibirResultados[5];
										 $whatsapp = $exibirResultados[9];
										 $atraso = (-1* $exibirResultados[10]);

										 print "<td><i>$loja</i></td>";
										 print "<td><a href='visualizar_cliente.php?cpf=$cpf'><b>$cliente</b></a></td>";
										 print "<td>$fornecedor</td>";
										 print "<td>$produto</td>";
										 print "<td class='vermelho'>$atraso</td>";

										 if ($whatsapp > 0) {
											 print "<td><a href='realizar_assistencias.php?id=$id'><img class='botaoImgTabela' src='img/check.png'></a>
											 <a href='https://api.whatsapp.com/send?phone=55$whatsapp
											 &text=Olá%2C%20cliente!%20Temos%20uma%20assistência%20técnica%20do%20produto%20$produto%20para%20realizar.%20Podemos%20agendar%3F' target='_blank'>
											 <img class='botaoImgTabela' src='img/whatsapp-cliente.png'></a></td></tr>";
										 } else {
										 		print "<td><a href='cadastro_cliente.php'><img class='botaoImgTabela' src='img/check.png'></a></td></tr>";
										}
										}
								 ?>
							</table>
	</main>
</body>
