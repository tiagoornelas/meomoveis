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

			$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
			$termo_da_pesquisa = $_GET['id'];
			$conteudo_pesquisa = "SELECT vendas.ID, vendas.compraID, vendas.dataVenda, vendas.loja, vendas.cliente,
															vendas.clienteCPF, vendas.descricaoGeral, vendas.fornecedor, vendas.produto,
															fornecedores.celular_do_vendedor
														FROM vendas
														RIGHT JOIN fornecedores
														ON vendas.fornecedor = fornecedores.empresa
														where vendas.ID = '$termo_da_pesquisa'
														AND pedido = '1'";
			$sql = $conteudo_pesquisa;
			$search = mysqli_query($conn,$sql);
		  $numero_pedidos = mysqli_num_rows($search);

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
			}
			 ?>

</head>
<body>
 <main>
		<?php include('elements/cabecalho.php');
				 	include('elements/barraLateral.php');
		?>

		<div class="popupFixo">
				<div class="miniPopupContent">
				 <h1 class="tituloBanner">Realizar Pedido</h1><br><br>
				 <h3 class="aviso">
					 <?php
						 print "Você realizou o pedido de $produto?";
						?>
				 </h3><br>

				 <form class="form" method="post" action=<?php echo "includes/realizar_pedidos-inc.php?id='$id'" ?>>

					 <input id="botaoDeletar" class="botao" name="submit" type="submit" value="Realizei">
				 </form>
					 <button id="botaoCancelarDeletar" class="botaoSair"><a href="logistica_pedidos.php" class="hideLink">Cancelar</a></button>
			 </div>
		 </div>
	 <div id="dashConsultaCliente">
				<div class="titulo">
					<h1 class="titulosSismeo">Logística: Pedidos</h1><br><br>
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
										if ($_GET["error"] == "edited") {
											echo "<h1 class='aviso'>Registro editado com sucesso.</h1>";
										}
										if ($_GET["error"] == "changed") {
											echo "<h1 class='aviso'>Registro deletado com sucesso.</h1>";
										}
										if ($_GET["error"] == "changenotpossible") {
											echo "<h1 class='aviso'>Não foi possível deletar o registro.</h1>";
										}
									}
								 ?>
								 <div class='caixaDeBotao2'>
										 <button class="botao3"><a href="logistica_pedidos.php" class="hideLink">Pedidos</a></button>
										 <button class="botao3"><a href="logistica_retiras.php" class="hideLink">Retiras</a></button>
										 <button class="botao3"><a href="logistica_entregas.php" class="hideLink">Entregas</a></button>
										 <button class="botao3"><a href="logistica_assistencias.php" class="hideLink">Assistências</a></button>
								 </div>
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

										 print "<td>$compraID</td>";
										 print "<td><b>$venda</b></td>";
										 print "<td><i>$loja</i></td>";
										 print "<td><a href='visualizar_cliente.php?cpf=$cpf'><b>$cliente</b></a></td>";
										 print "<td>$fornecedor</td>";
										 print "<td>$produto</td>";

										 if ($whatsapp > 0) {
											 print "<td><a href='cadastro_cliente.php'><img class='botaoImgTabela' src='img/check.png'></a>
											 <a href='https://web.whatsapp.com/send?phone=55$whatsapp
											 &text=Pedido%20da%20*Martins%20e%20Ornelas%20LTDA*%0A----------------------------------------------
											 %0ACliente%3A%20$cliente%0AFornecedor%3A%20$fornecedor%0AProduto%3A%20*$produto*' target='_blank'>
											 <img class='botaoImgTabela' src='img/whatsapp.png'></a></td></tr>";

										 } else {
										 		print "<td><a href='cadastro_cliente.php'><img class='botaoImgTabela' src='img/check.png'></a></td></tr>";
										}

								 ?>
							</table>
	</main>
</body>
