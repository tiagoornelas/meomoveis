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

<!-- CABEÇALHO -->
<?php include('elements/cabecalho.php') ?>

	<main> <!-- 1 - Banner Imagem -->
		<div id="banner_de_cima">
			<img width=100% src="img/banner_de_cima.jpg">
		</div>

									<!-- 2 - LISTA DE FORNECEDORES -->
		<div id="listaFornecedores">
			<ul class="margemDeLista">
				<li class="inline"><img class="fornecedor"
							src="img/lopas.jpg"></li>
				<li class="inline"><img class="fornecedor"
							src="img/valdemoveis.jpg"></li>
				<li class="inline"><img class="fornecedor"
							src="img/bianchi.png"></li>
				<li class="inline"><img class="fornecedor"
							src="img/salleto.jpg"></li>
				<li class="inline"><img class="fornecedor"
							src="img/kaiki.jpg"></li>
				<li class="inline"><img class="fornecedor"
							src="img/benetil.jpg"></li>
				<li class="inline"><img class="fornecedor"
							src="img/carioca.jpg"></li>
				<li class="inline"><img class="fornecedor"
							src="img/tcil.png"></li>
			</ul>
		</div>
	 							<!-- 3 - BANNER PRINCIPAL -->
								<!-- 3.1 - Ícone de Chave no Banner Principal -->
			<div id="banner">
				<img id="chave" src="img/tools.jpg" align="left">
								<!-- 3.2 - Imagem da Direita do Banner Principal -->
				<img id="pixelart_sfg" src="img/meomoveis_sfg.jpg" align="right">
									<!-- 3.3 - Texto do Banner -->
				<h1 class="tituloBanner">
					único site da região que<br></h1>
				<h2 id="subtituloBanner">
					entrega e monta!</h2>
			</div>
									<!-- 4 - CATEGORIAS -->
			<div>
				<h1 id="tituloCategoria">o que você está precisando?</h1>
				<ul id="listaCategorias">
					<li class="inline"><img class="categorias"
								src="img/cat_cozinha.jpg"></li>
					<li class="inline"><img class="categorias"
								src="img/cat_sala_de_estar.jpg"></li>
					<li class="inline"><img class="categorias"
								src="img/cat_quarto.jpg"></li>
					<li class="inline"><img class="categorias"
								src="img/cat_escritorio.jpg"></li>
					<li class="inline"><img class="categorias"
								src="img/cat_sala_de_jantar.jpg"></li>
					<li class="inline"><img class="categorias"
								src="img/cat_quarto_infantil.jpg"></li>
				</ul>
			</div>
	</main>
		<!-- RODAPÉ -->
		<?php include('elements/rodape.php') ?>
</body>
