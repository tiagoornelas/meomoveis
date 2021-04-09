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
<main>
		<?php

    require_once 'includes/dbh-inc.php';
    require_once 'includes/functions-inc.php';

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $termo_da_pesquisa = $_GET['id'];
    $conteudo_pesquisa = "select * from clientes where id=$id";
    $sql = $conteudo_pesquisa;
    $search = mysqli_query($conn,$sql);
    $numero_clientes = mysqli_num_rows($search);

    while($exibirResultados = mysqli_fetch_array($search)) {
      $id = $exibirResultados[0];
      $cpf = $exibirResultados[1];
      $nome = $exibirResultados[2];
      $referencia = $exibirResultados[3];
      $telefone = $exibirResultados[4];
      $endereco = $exibirResultados[5];}

			if (isset($_GET["search"])) {
				$pesquisa_realizada = true;
				$termo_da_pesquisa = $_GET['search'];
				$conteudo_pesquisa = "SELECT * from clientes where cpf like
					'%$termo_da_pesquisa%' or nome like '%$termo_da_pesquisa%' or
					referencia like '%$termo_da_pesquisa%'";
				}
				else {
				$pesquisa_realizada = false;
				$conteudo_pesquisa = "SELECT * from clientes";
			}

			$sql = $conteudo_pesquisa;
			$search = mysqli_query($conn,$sql);
			$numero_clientes = mysqli_num_rows($search);
		 ?>

		 <div class="popupFixo">
		     <div class="miniPopupContent">
			    <h1 class="tituloBanner">Gerar Entrega</h1><br><br>
					<h3 class="aviso">
						<?php
						$cpf = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
						$termo_da_pesquisa = $_GET['id'];
						$conteudo_pesquisa = "select * from vendas where id = '$termo_da_pesquisa'";
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

							print "Você quer gerar necessidade de entrega para o produto $produto?"; }
						 ?>
					</h3><br>

			 		<form class="form" method="post" action=<?php echo "includes/gerar_entrega-inc.php?id=$id" ?>>

			      <input id="botaoDeletar" class="botao" name="submit" type="submit" value="Gerar">
			 		</form>
			      <button id="botaoCancelarDeletar" class="botaoSair"><a href="<?php echo "visualizar_compra.php?compraID=$compraID"; ?>" class="hideLink">Cancelar</a></button>
						<a href="<?php echo "visualizar_compra.php?compraID=$compraID"; ?>"><img src="img/close.png" class="close"></a>
				</div>
			</div>
			<body>
			<?php include('elements/cabecalho.php');
						include('elements/barraLateral.php'); ?>
		</div>
	</main>
</body>
