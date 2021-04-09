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

		$pesquisa_realizada = true;
		// PESQUISA RECEBIVEIS DO MÊS
		$conteudo_pesquisa = "SELECT SUM(Debito)
			FROM lancamentos
			WHERE MONTH(DataDeb) = MONTH(CURRENT_DATE)";

	$sql = $conteudo_pesquisa;
	$search = mysqli_query($conn,$sql);

	while($exibirResultados = mysqli_fetch_array($search)) {
		$aReceberEsteMes = $exibirResultados[0]; }

	// PESQUISA RECEBIDOS NO MÊS
	$conteudo_pesquisa = "SELECT SUM(Credito)
		FROM lancamentos
		WHERE MONTH(DataCred) = MONTH(CURRENT_DATE)";

$sql = $conteudo_pesquisa;
$search = mysqli_query($conn,$sql);

while($exibirResultados = mysqli_fetch_array($search)) {
	$recebidosEsteMes = $exibirResultados[0]; }

		// PESQUISA RECEBIVEIS DO DIA
		$conteudo_pesquisa = "SELECT SUM(Debito)
			FROM lancamentos
			WHERE DAY(DataDeb) = DAY(CURRENT_DATE)";

	$sql = $conteudo_pesquisa;
	$search = mysqli_query($conn,$sql);

	while($exibirResultados = mysqli_fetch_array($search)) {
		$aReceberEsteDia = $exibirResultados[0];}

		// PESQUISA VENDAS DO MÊS
		$conteudo_pesquisa = "SELECT SUM(preco)
			FROM vendas
			WHERE MONTH(dataVenda) = MONTH(CURRENT_DATE)";

	$sql = $conteudo_pesquisa;
	$search = mysqli_query($conn,$sql);

	while($exibirResultados = mysqli_fetch_array($search)) {
		$vendasMes = $exibirResultados[0];}

		// PESQUISA VENDAS DO MÊS NO SITE
		$conteudo_pesquisa = "SELECT SUM(preco)
			FROM vendas
			WHERE MONTH(dataVenda) = MONTH(CURRENT_DATE)
			AND loja = 'SITE'";

		$sql = $conteudo_pesquisa;
		$search = mysqli_query($conn,$sql);

		while($exibirResultados = mysqli_fetch_array($search)) {
		$vendasMesSite = $exibirResultados[0];}


	 // PESQUISA PEDIDOS PENDENTES
	 $conteudo_pesquisa = "SELECT SUM(pedido)
		 FROM vendas";

 $sql = $conteudo_pesquisa;
 $search = mysqli_query($conn,$sql);

 while($exibirResultados = mysqli_fetch_array($search)) {
	 $pedidosPendentes = $exibirResultados[0];}

	 // PESQUISA RETIRAS PENDENTES
	 $conteudo_pesquisa = "SELECT SUM(retira)
		 FROM vendas";

	$sql = $conteudo_pesquisa;
	$search = mysqli_query($conn,$sql);

	while($exibirResultados = mysqli_fetch_array($search)) {
	 $retirasPendentes = $exibirResultados[0];}

	 // PESQUISA ENTREGAS PENDENTES
	 $conteudo_pesquisa = "SELECT SUM(entrega)
		 FROM vendas";

	$sql = $conteudo_pesquisa;
	$search = mysqli_query($conn,$sql);

	while($exibirResultados = mysqli_fetch_array($search)) {
	 $entregasPendentes = $exibirResultados[0];}

	 // PESQUISA ASSISTENCIAS PENDENTES
	 $conteudo_pesquisa = "SELECT SUM(assistencia)
		 FROM vendas";

	$sql = $conteudo_pesquisa;
	$search = mysqli_query($conn,$sql);

	while($exibirResultados = mysqli_fetch_array($search)) {
	 $assistenciasPendentes = $exibirResultados[0];}

	?>

</head>

<body>

<?php include('elements/cabecalho.php') ?>
<?php include('elements/barraLateral.php') ?>

<div class="popupFixoPosition">
	 <div class="vendaExpressaPopupContent">
	<h1 id="tituloVendaExpressa" class="tituloBanner">Venda Expressa</h1><br><br>

	<form method="post"
			action="includes/venda_expressa-inc.php">

		<label for="data">Data</label><br>
		<input class="popupInput" name="data"
					type="date" required><br>
		<label for="produto">Produto</label><br>
		<input class="popupInput" onkeyup="
				var start = this.selectionStart;
				var end = this.selectionEnd;
				this.value = this.value.toUpperCase();
				this.setSelectionRange(start, end);" name="produto"
					type="text" placeholder="Insira o Produto vendido aqui." pattern="[A-Z0-9\s]+" required><br>
		<label for="preco">Preço</label><br>
		<input class="popupInput" name="preco"
					type="number" step="0.01" placeholder="Insira o preço de venda aqui." required><br>
				<br>
		<input class="botao" name="submit" type="submit" value="Registrar">
		 <a href="sismeo.php"><img src="img/close.png" class="close"></a>
	</form>
	<div id="avisoVendaExpressa">
		<?php
			if (isset($_GET["error"])) {
				if ($_GET["error"] == "emptyInput") {
					echo "<h1 class='aviso'>Você esqueceu de preencher todos os campos!</h1>";
				}
				if ($_GET["error"] == "stmtFailed") {
					echo "<h1 class='aviso'>Não consegui te conectar!</h1>";
				}
				if ($_GET["error"] == "none") {
					echo "<h1 class='aviso'>Venda registrada com sucesso!</h1>";
				}
			}
		 ?>
	 </div>
		</div>
	</div>

 		 <main>
			  <iframe id="grafico" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vR5BdFBs_GDEi0-ybTb0HAGM2uBoBNHQJI-diClxMdbeVEGVbUpgdvJenYevHclt-7Gcabu3bbPOZaN/pubchart?oid=973862488&amp;format=interactive"></iframe>
					<div id="VendasDash" class="titulo">
							<table id="tabelaVendasDash" style='width: 25vmax;'>
								<h1 class="titulosDash"><a class="titulosDashHideLink" href='consulta_vendas.php'>Vendas</a>
									<button id="botaoVenda" class="botao" style="background-image: linear-gradient(to right, #62CED1, #5DC771);"><a href="venda_expressa.php" class="hideLink">Venda Expressa</a></button></h1><br>
								<th style='width: 40%'></th>
								<th style='width: 30%'></th>
								<?php
								    $porcentagemSite = intval(($vendasMesSite/$vendasMes)*100);
										print "<tr><td><b class='negrito'>Recebíveis do Dia</b></td><td>R$ " . number_format($aReceberEsteDia, 2, ',', '.') . "</td></tr>";
										print "<tr><td><b class='negrito'>Recebíveis do Mês</b></td><td>R$ " . number_format($aReceberEsteMes, 2, ',', '.') . "</td></tr>";
										if ($aReceberEsteMes > 0) {
										print "<tr><td><b class='negrito'>Entradas do Mês</b></td><td>R$ " . number_format($aReceberEsteMes, 2, ',', '.') . "</td></tr>";
										} else {
											print "<tr><td><b class='negrito'>Recebidos no Mês</b></td><td>R$ 0,00 (0%)</td></tr>";
										}
										print "<tr><td><b class='negrito'>Vendas do Mês</b></td><td>R$ " . number_format($vendasMes, 2, ',', '.') . "</td></tr>";
										if ($vendasMes > 0) {
										print "<tr><td><b class='negrito'>Vendas do Site</b></td><td>R$ " . number_format($vendasMesSite, 2, ',', '.') . " (" . $porcentagemSite . "%)</td></tr>";
										} else {
											print "<tr><td><b class='negrito'>Vendas do Site</b></td><td>R$ 0,00 (0%)</td></tr>";
										}
								?>

					</div>
									<div class="titulo">
										<table id="tabelaLogisticaDash">
											<h1 id="tituloLogistica" class="titulosDash"><a class="titulosDashHideLink" href='logistica_pedidos.php'>Logística</a></h1><br>
											<th><b class='negrito'>Pedidos</b></th>
											<th><b class='negrito'>Retiras</b></th>
											<th><b class='negrito'>Entregas</b></th>
											<th><b class='negrito'>Assistências</b></th>
											<?php
											print "<tr><td style='text-align: center'>$pedidosPendentes</td>";
											print "<td style='text-align: center'>$retirasPendentes</td>";
											print "<td style='text-align: center'>$entregasPendentes</td>";
											print "<td style='text-align: center'>$assistenciasPendentes</td></tr>";
											?>
									</table>
								</div>
				<div>

								 <article id="articleDash1" class='DashCaixa'>
									 		<h1 class="titulosDash">Cobrança</h1><br><br>
										<div id="tabelaBotaoDash">
										 <button class="botao" style="background:#F2940C"><a href="cobranca.php?late=5" class="hideLink">Atrasados 5d</a></button>
										 <button class="botao" style="background:#DB6300"><a href="cobranca.php?late=30" class="hideLink">Atrasados 30d</a></button><br>
										 <button class="botao" style="background:#F2520C"><a href="cobranca.php?late=90" class="hideLink">Atrasados 90d</a></button>
										 <button class="botao" style="background:#E82F0C"><a href="cobranca.php?" class="hideLink">Atrasados 90d+</a></button>
									 </div>
								 </article>
				</div>
								 <article id="articleDash2" class='DashCaixa'>
									 		<h1 class="titulosDash">Rankings</h1><br><br>
										<div id="tabelaBotaoDash">
										 <button class="botao" style="background:#62CED1"><a href="ranking_pontuais.php" class="hideLink">Mais Pontuais</a></button>
										 <button class="botao" style="background:#61BBA5"><a href="ranking_npontuais.php" class="hideLink">Menos Pontuais</a></button><br>
										 <button class="botao" style="background:#62D196"><a href="ranking_compras.php" class="hideLink">Compras</a></button>
										 <button class="botao" style="background:#5DC771"><a href="ranking_divida.php" class="hideLink">Dívida</a></button>
									 </div>
								 </article>

								 <article id="articleDash3" class='DashCaixa'>
											<h1 class="titulosDash">Extra</h1><br><br>
										<div id="tabelaBotaoDash">
										 <button class="botao" style="background:#C13FD4"><a href="https://docs.google.com/spreadsheets/d/1LXF9FsTZUDK4Fzm7THSDfFQyhgNIj9B7/edit?rtpof=true#gid=179895687" target='_blank' class="hideLink">Preços</a></button>
										 <button class="botao" style="background:#8C43BD"><a href="https://docs.google.com/spreadsheets/d/1pC5eURGA5ZLeKROah4Hz0gLF9IJ6yiac9i5LK427Tt8/edit?usp=drive_web&ouid=110296138011875641975" target='_blank' class="hideLink">Operação Ubá</a></button><br>
										 <button class="botao" style="background:#703FD4"><a href="https://docs.google.com/spreadsheets/d/1czy_uO3vPrhsHY_uPF4eYDqHhW1YzEnf3nJgiiq8ULI/edit?usp=drive_web&ouid=110296138011875641975" target='_blank' class="hideLink">Planilha Meo</a></button>
										 <button class="botao" style="background:#443CC9"><a href="https://www.bibliaon.com/versiculo_do_dia/" target='_blank' class="hideLink">Versículo do Dia</a></button>
									 </div>
								 </article>
		  </main>
</body>