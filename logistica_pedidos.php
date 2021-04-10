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
																fornecedores.celular_do_vendedor
															FROM vendas
															RIGHT JOIN fornecedores
															ON vendas.fornecedor = fornecedores.empresa
															where fornecedor like '%$termo_da_pesquisa%'
		      										AND pedido = '1'";
				}
				else {
				$pesquisa_realizada = false;
				$conteudo_pesquisa = "SELECT vendas.ID, vendas.compraID, vendas.dataVenda, vendas.loja, vendas.cliente,
																vendas.clienteCPF, vendas.descricaoGeral, vendas.fornecedor, vendas.produto,
																fornecedores.celular_do_vendedor
															FROM vendas
															RIGHT JOIN fornecedores
															ON vendas.fornecedor = fornecedores.empresa
															WHERE pedido = '1';";
			}

			$sql = $conteudo_pesquisa;
			$search = mysqli_query($conn,$sql);
		  $numero_pedidos = mysqli_num_rows($search);
			 ?>

</head>
<body>
 <main>
		<?php include('elements/cabecalho.php');
				 	include('elements/barraLateral.php');
		?>

	 <div id="dashConsultaCliente">
				<div class="titulo">
					<h1 class="titulosSismeo">Logística: Pedidos</h1><br><br>
					<h3 class="legendaConsultas">
						<?php
							if ($numero_pedidos == 1) { /*Apenas para controle de plural */
								print "Apenas $numero_pedidos pedido pendente.";
							}
							else if ($numero_pedidos == 0) {
								print "Nenhum pedido pendente.";
							}
							else {
								print "$numero_pedidos pedidos pendentes.";
							}
						?>
					</h3>
					</div>
					<div id="searchboxConsultas">
								<section>
								<form class="form" method="post" action="includes/logistica_pedidos-inc.php">

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
											echo "<h1 class='aviso'>Pedido realizado com sucesso.</h1>";
										}
										if ($_GET["error"] == "changenotpossible") {
											echo "<h1 class='aviso'>Não foi possível editar o registro.</h1>";
										}
									}
								 ?>
							</section>
						<table>
							<tr>
								<th style="width:10%">ID Compra</th>
								<th style="width:10%">Venda</th>
								<th style="width:10%">Loja</th>
								<th style="width:20%">Cliente</th>
								<th style="width:10%">Fornecedor</th>
								<th style="width:30%">Produto</th>
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

										 print "<td>$compraID</td>";
										 print "<td><b>$venda</b></td>";
										 print "<td><i>$loja</i></td>";
										 print "<td><a href='visualizar_cliente.php?cpf=$cpf'><b>$cliente</b></a></td>";
										 print "<td>$fornecedor</td>";
										 print "<td>$produto</td>";

										 if ($whatsapp > 0) {
											 print "<td><a href='realizar_pedidos.php?id=$id'><img class='botaoImgTabela' src='img/check.png'></a>
											 <a href='https://web.whatsapp.com/send?phone=55$whatsapp
											 &text=Pedido%20da%20Martins%20e%20Ornelas%20LTDA%0A----------------------------------------------
											 %0ACliente%3A%20$cliente%0AFornecedor%3A%20$fornecedor%0AProduto%3A%20*$produto*' target='_blank'>
											 <img class='botaoImgTabela' src='img/whatsapp-vendedor.png'></a></td></tr>";

										 } else {
										 		print "<td><a href='cadastro_cliente.php'><img class='botaoImgTabela' src='img/check.png'></a></td></tr>";
										}
										}
								 ?>
							</table>
	</main>
</body>
