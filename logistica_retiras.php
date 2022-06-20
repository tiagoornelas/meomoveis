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
																fornecedores.celular_do_vendedor, fornecedores.telefone_da_empresa, DateDiff(vendas.dataVenda, CURRENT_DATE()) as 'Atraso'
															FROM vendas
															RIGHT JOIN fornecedores
															ON vendas.fornecedor = fornecedores.empresa
															where fornecedor like '%$termo_da_pesquisa%'
		      										AND retira = '1' ORDER BY vendas.fornecedor ASC";
				}
				else {
				$pesquisa_realizada = false;
				$conteudo_pesquisa = "SELECT vendas.ID, vendas.compraID, vendas.dataVenda, vendas.loja, vendas.cliente,
																vendas.clienteCPF, vendas.descricaoGeral, vendas.fornecedor, vendas.produto,
																fornecedores.celular_do_vendedor, fornecedores.telefone_da_empresa, DateDiff(vendas.dataVenda, CURRENT_DATE()) as 'Atraso'
															FROM vendas
															RIGHT JOIN fornecedores
															ON vendas.fornecedor = fornecedores.empresa
															WHERE retira = '1' ORDER BY vendas.fornecedor ASC";
			}

			$sql = $conteudo_pesquisa;
			$search = mysqli_query($conn,$sql);
		  $numero_retiras = mysqli_num_rows($search);
			 ?>

</head>
<body>
 <main>
		<?php include('elements/cabecalho.php');
				 	include('elements/barraLateral.php');
		?>

	 <div id="dashConsultaCliente">
				<div class="titulo">
					<h1 class="titulosSismeo">Logística: Retiras</h1><br><br>
					<h3 class="legendaConsultas">
						<?php
							if ($numero_retiras == 1) { /*Apenas para controle de plural */
								print "Apenas $numero_retiras retira pendente.";
							}
							else if ($numero_retiras == 0) {
								print "Nenhuma retira pendente.";
							}
							else {
								print "$numero_retiras retiras pendentes.";
							}
						?>
					</h3>
					</div>
					<div id="searchboxConsultas">
								<section>
								<form class="form" method="post" action="includes/logistica_retiras-inc.php">

									<input name="pesquisa" type="text" maxlength="255" placeholder="Fornecedor">
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
											echo "<h1 class='aviso'>Retira realizada com sucesso.</h1>";
										}
										if ($_GET["error"] == "changenotpossible") {
											echo "<h1 class='aviso'>Não foi possível editar o registro.</h1>";
										}
									}
								 ?>
							</section>
						<table>
							<tr>
								<th style="width:10%">Ordem</th>
								<th style="width:10%">Fornecedor</th>								
								<th style="width:25%">Cliente</th>
								<th style="width:30%">Produto</th>
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
										 $whatsappEmpresa = $exibirResultados[10];
										 $atraso = (-1 * $exibirResultados[11]);

										 print "<td></td>";										 
										 print "<td>$fornecedor</td>";
										 print "<td><a href='visualizar_cliente.php?cpf=$cpf'><b>$cliente</b></a></td>";
										 print "<td>$produto</td>";
										 print "<td class='vermelho'>$atraso</td>";

										 if ($whatsapp > 0 && $whatsappEmpresa > 0) {
											 print "<td><a href='realizar_retiras.php?id=$id'><img class='botaoImgTabela' src='img/check.png'></a>
											 <a href='https://api.whatsapp.com/send?phone=55$whatsappEmpresa
											 &text=Tenho%20um%20pedido%20de%20$produto%20aí%20com%20vocês%20pendente%20de%20retirada%2C%20poderia%20ver%20para%20mim%20se%20já%20está%20disponível%3F%0AA%20minha%20razão%20social%20é%20Martins%20e%20Ornelas%20LTDA%0ACNPJ%2002.179.467%2F0001-76' target='_blank'>
											 <img class='botaoImgTabela' src='img/whatsapp-retira.png'></a>
											 <a href='https://api.whatsapp.com/send?phone=55$whatsapp
											 &text=Tenho%20um%20pedido%20de%20$produto%20aí%20com%20vocês%20pendente%20de%20retirada%2C%20poderia%20ver%20para%20mim%20se%20já%20está%20disponível%3F%0AA%20minha%20razão%20social%20é%20Martins%20e%20Ornelas%20LTDA%0ACNPJ%2002.179.467%2F0001-76' target='_blank'>
											 <img class='botaoImgTabela' src='img/whatsapp-vendedor.png'></a></td></tr>";

										} elseif ($whatsapp > 0 && $whatsappEmpresa <= 0) {
											print "<td><a href='realizar_retiras.php?id=$id'><img class='botaoImgTabela' src='img/check.png'></a>
											<a href='https://api.whatsapp.com/send?phone=55$whatsapp
											&text=Tenho%20um%20pedido%20de%20$produto%20aí%20com%20vocês%20pendente%20de%20retirada%2C%20poderia%20ver%20para%20mim%20se%20já%20está%20disponível%3F%0AA%20minha%20razão%20social%20é%20Martins%20e%20Ornelas%20LTDA%0ACNPJ%2002.179.467%2F0001-76' target='_blank'>
											<img class='botaoImgTabela' src='img/whatsapp-vendedor.png'></a></td></tr>";
										} elseif ($whatsapp <= 0 && $whatsappEmpresa > 0) {
											print "<td><a href='realizar_retiras.php?id=$id'><img class='botaoImgTabela' src='img/check.png'></a>
											<a href='https://api.whatsapp.com/send?phone=55$whatsappEmpresa
											&text=Tenho%20um%20pedido%20de%20$produto%20aí%20com%20vocês%20pendente%20de%20retirada%2C%20poderia%20ver%20para%20mim%20se%20já%20está%20disponível%3F%0AA%20minha%20razão%20social%20é%20Martins%20e%20Ornelas%20LTDA%0ACNPJ%2002.179.467%2F0001-76' target='_blank'>
											<img class='botaoImgTabela' src='img/whatsapp-retira.png'></a></td></tr>";
										 } else {
										 		print "<td><a href='cadastro_cliente.php'><img class='botaoImgTabela' src='img/check.png'></a></td></tr>";
										}
										}
								 ?>
							</table>
	</main>
</body>
