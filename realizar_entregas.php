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
															clientes.telefone, clientes.ENDERECO
														FROM vendas
														RIGHT JOIN clientes
														ON vendas.clienteCPF = clientes.CPF
														where vendas.ID = '$termo_da_pesquisa'
														AND entrega = '1'";
			$sql = $conteudo_pesquisa;
			$search = mysqli_query($conn,$sql);
		  $numero_entregas = mysqli_num_rows($search);

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
				 <h1 class="tituloBanner">Realizar Entrega</h1><br><br>
				 <h3 class="aviso">
					 <?php
						 print "Você realizou o entrega de $produto?";
						?>
				 </h3><br>

				 <form class="form" method="post" action=<?php echo "includes/realizar_entregas-inc.php?id='$id'" ?>>

					 <input id="botaoDeletar" class="botao" name="submit" type="submit" value="Realizei">
				 </form>
					 <button id="botaoCancelarDeletar" class="botaoSair"><a href="logistica_entregas.php" class="hideLink">Cancelar</a></button>
			 </div>
		 </div>
	 <div id="dashConsultaCliente">
				<div class="titulo">
					<h1 class="titulosSismeo">Logística: Entregas</h1><br><br>
					</div>
					<div id="searchboxConsultas">
								<section>
								<form class="form" method="post" action="includes/logistica_entregas-inc.php">

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

								<th style="width:20%">Cliente</th>
								<th style="width:10%">Fornecedor</th>
								<th style="width:30%">Produto</th>
								<th style="width:30%">Endereço</th>
								<th style="width:10%"></th>
							</tr>
								<?php

										 print "<td><a href='visualizar_cliente.php?cpf=$cpf'><b>$cliente</b></a></td>";
										 print "<td>$fornecedor</td>";
										 print "<td>$produto</td>";
										 print "<td>$endereco</td>";										 

										 if ($whatsapp > 0) {
											 print "<td><a href='realizar_entregas.php?id=$id'><img class='botaoImgTabela' src='img/check.png'></a>
											 <a href='https://api.whatsapp.com/send?phone=55$whatsapp
											 &text=Olá%2C%20cliente!%20O%20seu%20produto%20$produto%20PRODUTO%20está%20pronto%20para%20entrega.%20Podemos%20agendar%3F' target='_blank'>
											 <img class='botaoImgTabela' src='img/whatsapp-cliente.png'></a></td></tr>";
										 } else {
										 		print "<td><a href='cadastro_cliente.php'><img class='botaoImgTabela' src='img/check.png'></a></td></tr>";
										}

								 ?>
							</table>
	</main>
</body>
