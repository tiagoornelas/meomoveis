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
															clientes.telefone, clientes.ENDERECO, clientes.REFERENCIA, DateDiff(vendas.dataVenda, CURRENT_DATE()) as 'Atraso'
														FROM vendas
														RIGHT JOIN clientes
														ON vendas.clienteCPF = clientes.CPF
															where cliente like '%$termo_da_pesquisa%'
		      										AND entrega = '1'";
				}
				else {
				$pesquisa_realizada = false;
				$conteudo_pesquisa = "SELECT vendas.ID, vendas.compraID, vendas.dataVenda, vendas.loja, vendas.cliente,
															vendas.clienteCPF, vendas.descricaoGeral, vendas.fornecedor, vendas.produto,
															clientes.telefone, clientes.ENDERECO, clientes.REFERENCIA, DateDiff(vendas.dataVenda, CURRENT_DATE()) as 'Atraso'
														FROM vendas
														RIGHT JOIN clientes
														ON vendas.clienteCPF = clientes.CPF
															WHERE entrega = '1';";
			}

			$sql = $conteudo_pesquisa;
			$search = mysqli_query($conn,$sql);
		  $numero_entregas = mysqli_num_rows($search);
			 ?>

</head>
<body>
 <main>
		<?php include('elements/cabecalho.php');
				 	include('elements/barraLateral.php');
		?>

	 <div id="dashConsultaCliente">
				<div class="titulo">
					<h1 class="titulosSismeo">Logística: Entregas</h1><br><br>
					<h3 class="legendaConsultas">
						<?php
							if ($numero_entregas == 1) { /*Apenas para controle de plural */
								print "Apenas $numero_entregas entrega pendente.";
							}
							else if ($numero_entregas == 0) {
								print "Nenhuma entrega pendente.";
							}
							else {
								print "$numero_entregas entregas pendentes.";
							}
						?>
					</h3>
					</div>
					<div id="searchboxConsultas">
								<section>
								<form class="form" method="post" action="includes/logistica_entregas-inc.php">

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
											echo "<h1 class='aviso'>Entrega realizada com sucesso.</h1>";
										}
										if ($_GET["error"] == "changenotpossible") {
											echo "<h1 class='aviso'>Não foi possível editar o registro.</h1>";
										}
									}
								 ?>
							</section>
						<table>
							<tr>
								<th style="width:20%">Cliente</th>
								<th style="width:10%">Fornecedor</th>
								<th style="width:15%">Produto</th>
								<th style="width:20%">Endereço</th>
								<th style="width:20%">Referência</th>
								<th style="width:5%"></th>
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
										 $endereco = $exibirResultados[10];
										 $ref = $exibirResultados[11];
										 $atraso = (-1 * $exibirResultados[12]);

										 print "<td><a href='visualizar_cliente.php?cpf=$cpf'><b>$cliente</b></a></td>";
										 print "<td>$fornecedor</td>";
										 print "<td>$produto</td>";
										 print "<td>$endereco</td>";
										 print "<td>$ref</td>";
										 print "<td class='vermelho'>$atraso</td>";

										 if ($whatsapp > 0) {
											 print "<td><a href='realizar_entregas.php?id=$id'><img class='botaoImgTabela' src='img/check.png'></a>
											 <a href='https://api.whatsapp.com/send?phone=55$whatsapp
											 &text=Olá%2C%20cliente!%20O%20seu%20produto%20$produto%20está%20pronto%20para%20entrega.%20Podemos%20agendar%3F' target='_blank'>
											 <img class='botaoImgTabela' src='img/whatsapp-cliente.png'></a></td></tr>";
										 } else {
										 		print "<td><a href='cadastro_cliente.php'><img class='botaoImgTabela' src='img/check.png'></a></td></tr>";
										}
										}
								 ?>
							</table>
	</main>
</body>
