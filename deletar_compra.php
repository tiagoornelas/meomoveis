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

		$compraID = filter_input(INPUT_GET, 'compraID', FILTER_SANITIZE_NUMBER_INT);
		$termo_da_pesquisa = $_GET['compraID'];
		$conteudo_pesquisa = "select * from vendas where compraID = '$termo_da_pesquisa'";
		$sql = $conteudo_pesquisa;
		$search = mysqli_query($conn,$sql);
		$numero_produtos = mysqli_num_rows($search);

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
			$assistencia = $exibirResultados[13];}
		 ?>

	<div class="popupFixo">
		 <div class="miniPopupContent">
    <h1 class="tituloBanner">Deletar Compra</h1><br><br>
		<h3 class="aviso">
			<?php
				print "Tem certeza que quer deletar a compra $descricaoGeral inteira?";
			 ?>
		</h3><br>

 		<form class="form" method="post" action=<?php echo "includes/deletar_compra-inc.php?compraID=$compraID" ?>>
      <input id="botaoDeletar" class="botao" name="submit" type="submit" value="Deletar">
		</form>
      <button id="botaoCancelarDeletar" class="botaoSair"><a href=<?php echo "visualizar_compra.php?compraID=$compraID" ?> class="hideLink">Cancelar</a></button>
			</div>
		</div>

				<?php

							$cpf = filter_input(INPUT_GET, 'compraID', FILTER_SANITIZE_NUMBER_INT);
							$termo_da_pesquisa = $_GET['compraID'];
							$conteudo_pesquisa = "select * from vendas where compraID = '$termo_da_pesquisa'";
							$sql = $conteudo_pesquisa;
							$search = mysqli_query($conn,$sql);
							$numero_produtos = mysqli_num_rows($search);

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
								$assistencia = $exibirResultados[13];}

								 echo "<div id='visualizarCompra'><h1 class='tituloPopup'>Visualizar Compra</h1><br><br>";
								 echo "<h2><b class='negrito'>Cliente: </b><a class='hideLinkVisualizarCompra' href='visualizar_cliente.php?cpf=$clienteCPF'>$cliente</a></h2><br>";
								 echo "<h2><b class='negrito'>ID da Compra: </b>$compraID</h2><br>";
								 echo "<h2><b class='negrito'>Data da Compra: </b>$dataVenda</h2><br>";
							 ?>
								 <button id="sair" class="botaoSair"><a href=<?php echo "visualizar_cliente.php?cpf=$clienteCPF" ?> class="hideLink">Deletar</a></button>
								 <button id="sair" class="botao"><a href=<?php echo "visualizar_cliente.php?cpf=$clienteCPF" ?> class="hideLink">Voltar</a></button>

								 <table style='text-align:center'>
						 			<tr>
						 				<th style="width:40%">Produto</th>
						 				<th>Fornecedor</th>
						 				<th>Pedido</th>
						 				<th>Retira</th>
										<th>Entrega</th>
						 				<th>Assistência</th>
										<th></th>
						 			</tr>
						 				<?php
										$cpf = filter_input(INPUT_GET, 'compraID');
										$termo_da_pesquisa = $_GET['compraID'];
										$conteudo_pesquisa = "select * from vendas where compraID=$termo_da_pesquisa";
										$sql = $conteudo_pesquisa;
										$search = mysqli_query($conn,$sql);
										$numero_produtos = mysqli_num_rows($search);

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

						 						 print "<td>$produto</td>";
						 						 print "<td>$fornecedor</td>";
												if ($pedido > 0) {
													print "<td><img class='botaoImgTabela' src='img/cancel.png'></td>";
												} else {
													print "<td><a href='gerar_pedido.php?id=$ID'><img class='botaoImgTabela' src='img/check2.png'></td>";
												}
												if ($retira > 0) {
													print "<td><img class='botaoImgTabela' src='img/cancel.png'></td>";
												} else {
													print "<td><a href='gerar_retira.php?id=$ID'><img class='botaoImgTabela' src='img/check2.png'></td>";
												}
												if ($entrega > 0) {
													print "<td><img class='botaoImgTabela' src='img/cancel.png'></td>";
												} else {
													print "<td><a href='gerar_entrega.php?id=$ID'><img class='botaoImgTabela' src='img/check2.png'></td>";
												}
												if ($assistencia > 0) {
													print "<td><img class='botaoImgTabela' src='img/cancel.png'></td></tr>";
												} else {
													print "<td><a href='gerar_assistencia.php?id=$ID'><img class='botaoImgTabela' src='img/check2.png'></a></td></tr>";
												}
										 	}
						 				 ?>
						 			</table>
								</div>
	</main>
</body>
