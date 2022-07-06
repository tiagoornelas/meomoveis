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
    	
    include('elements/cabecalho.php');
    include('elements/barraLateral.php');

		$pesquisa_realizada = true;
		// PESQUISA CRÉDITOS DO MÊS
		$conteudo_pesquisa = "SELECT SUM(Debito)
			FROM lancamentos
			WHERE MONTH(DataDeb) = MONTH(CURRENT_DATE) AND YEAR(DataDeb) = YEAR(CURRENT_DATE)";

	$sql = $conteudo_pesquisa;
	$search = mysqli_query($conn,$sql);

	while($exibirResultados = mysqli_fetch_array($search)) {
		$aReceberEsteMes = $exibirResultados[0]; }

	// PESQUISA CREDITADOS DO MÊS
	$conteudo_pesquisa = "SELECT SUM(Credito)
    FROM lancamentos
    WHERE MONTH(DataDeb) = MONTH(CURRENT_DATE) AND YEAR(DataDeb) = YEAR(CURRENT_DATE)";

$sql = $conteudo_pesquisa;
$search = mysqli_query($conn,$sql);

while($exibirResultados = mysqli_fetch_array($search)) {
	$recebidosEsteMes = $exibirResultados[0]; }

		// PESQUISA CRÉDITOS DO DIA
		$conteudo_pesquisa = "SELECT SUM(debito)
			FROM lancamentos
			WHERE DataDeb = CURRENT_DATE";

	$sql = $conteudo_pesquisa;
	$search = mysqli_query($conn,$sql);

	while($exibirResultados = mysqli_fetch_array($search)) {
		$aReceberEsteDia = $exibirResultados[0];}
		
		// PESQUISA CREDITADOS DO DIA
		$conteudo_pesquisa = "SELECT SUM(Credito)
		FROM lancamentos
		WHERE DataDeb = CURRENT_DATE";
	
	$sql = $conteudo_pesquisa;
	$search = mysqli_query($conn,$sql);
	
	while($exibirResultados = mysqli_fetch_array($search)) {
	$recebidosEsteDia = $exibirResultados[0]; }

		// PESQUISA VENDAS DO MÊS
		$conteudo_pesquisa = "SELECT SUM(preco)
			FROM vendas
			WHERE MONTH(dataVenda) = MONTH(CURRENT_DATE) AND YEAR(dataVenda) = YEAR(CURRENT_DATE)";

	$sql = $conteudo_pesquisa;
	$search = mysqli_query($conn,$sql);

	while($exibirResultados = mysqli_fetch_array($search)) {
		$vendasMes = $exibirResultados[0];}

    // PESQUISA VENDAS DO MÊS NA MATRIZ
    $conteudo_pesquisa = "SELECT SUM(preco)
    FROM vendas
    WHERE MONTH(dataVenda) = MONTH(CURRENT_DATE) AND YEAR(dataVenda) = YEAR(CURRENT_DATE)
    AND loja = 'MATRIZ'";
    
    $sql = $conteudo_pesquisa;
    $search = mysqli_query($conn,$sql);
    
    while($exibirResultados = mysqli_fetch_array($search)) {
    $vendasMesMatriz = $exibirResultados[0];}

    // PESQUISA VENDAS DO MÊS EM FERVEDOURO
    $conteudo_pesquisa = "SELECT SUM(preco)
    FROM vendas
    WHERE MONTH(dataVenda) = MONTH(CURRENT_DATE) AND YEAR(dataVenda) = YEAR(CURRENT_DATE)
    AND loja = 'FERVEDOURO'";
    
    $sql = $conteudo_pesquisa;
    $search = mysqli_query($conn,$sql);
    
    while($exibirResultados = mysqli_fetch_array($search)) {
    $vendasMesFervedouro = $exibirResultados[0];}

		// PESQUISA ADIMPLÊNCIA, ROI E LUCRO ESTIMADO
		$conteudo_pesquisa = "SELECT 
          FORMAT(SUM(credito) / SUM(debito) * 100,
              2) AS adimplencia,
          FORMAT(((SUM(credito) - ((SUM(debito) / 1.68) * 1.065)) / SUM(debito)) * 100,
              2) AS roiBruto,
          FORMAT((((SUM(credito) - ((SUM(debito) / 1.68) * 1.065))) / TIMESTAMPDIFF(MONTH,
                  '2021-04-01',
                  CURRENT_DATE)),
              2) AS lucroEstimadoMes
      FROM
          lancamentos
      WHERE
          dataDeb < CURRENT_DATE";

		$sql = $conteudo_pesquisa;
		$search = mysqli_query($conn,$sql);

		while($exibirResultados = mysqli_fetch_array($search)) {
		$adimplencia = $exibirResultados[0];
		$roiBruto = $exibirResultados[1];
		$lucroBrutoMes = $exibirResultados[2];}

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

		 <main>
			  <iframe id="grafico" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vR5BdFBs_GDEi0-ybTb0HAGM2uBoBNHQJI-diClxMdbeVEGVbUpgdvJenYevHclt-7Gcabu3bbPOZaN/pubchart?oid=1776382643&amp;format=interactive"></iframe>
					<div id="VendasDash" class="titulo">
							<table id="tabelaVendasDash" style='width: 25vmax;'>
								<h1 class="titulosDash"><a class="titulosDashHideLink" href='consulta_vendas.php'>Vendas</a>
									<button id="botaoVenda" class="botao" style="background-color: #167BC3;"><a href="venda_expressa.php" class="hideLink">Venda Expressa</a></button></h1><br>
								<th style='width: 40%'></th>
								<th style='width: 30%'></th>
								<?php
								    $porcentagemSite = intval(($vendasMesSite/$vendasMes)*100);
								    $porcentagemMatriz = intval(($vendasMesMatriz/$vendasMes)*100);
								    $porcentagemFervedouro = intval(($vendasMesFervedouro/$vendasMes)*100);
                    print "<tr><td><b class='negrito'>Adimplência</b></td><td>" . $adimplencia . " %</td></tr>";
                    print "<tr><td><b class='negrito'>ROI Bruto</b></td><td>" . $roiBruto . " %</td></tr>";
                    print "<tr><td><b class='negrito'>Média Lucro Bruto Mês</b></td><td>R$ " . $lucroBrutoMes . " %</td></tr>";
										print "<tr><td><b class='negrito'><a href='recebiveis_dia.php'>Créditos do Dia</a></b></td><td>R$ " . number_format($aReceberEsteDia, 2, ',', '.') . "</td></tr>";
										if ($recebidosEsteDia > 0) {
										print "<tr><td><b class='negrito'>Creditados do Dia</b></td><td>R$ " . number_format($recebidosEsteDia, 2, ',', '.') . "</td></tr>";
										} else {
											print "<tr><td><b class='negrito'>Creditados do Dia</b></td><td>R$ 0,00</td></tr>";
										}
										print "<tr><td><b class='negrito'>Créditos do Mês</b></td><td>R$ " . number_format($aReceberEsteMes, 2, ',', '.') . "</td></tr>";
										if ($recebidosEsteMes > 0) {
										print "<tr><td><b class='negrito'>Creditados do Mês</b></td><td>R$ " . number_format($recebidosEsteMes, 2, ',', '.') . "</td></tr>";
										} else {
											print "<tr><td><b class='negrito'>Creditados do Mês</b></td><td>R$ 0,00</td></tr>";
										}
                    if ($vendasMes > 0) {
                      print "<tr><td><b class='negrito'>Vendas do Mês</b></td><td>R$ " . number_format($vendasMes, 2, ',', '.') . "</td></tr>";
                    } else {
                      print "<tr><td><b class='negrito'>Vendas do Mês</b></td><td>R$ 0,00</td></tr>";
                    }
                    if ($vendasMesMatriz > 0) {
                      print "<tr><td><b class='negrito'>Vendas da Matriz</b></td><td>R$ " . number_format($vendasMesMatriz, 2, ',', '.') . " (" . $porcentagemMatriz . "%)</td></tr>";
                    } else {
                      print "<tr><td><b class='negrito'>Vendas da Matriz</b></td><td>R$ 0,00 (0%)</td></tr>";
                    }
                    if ($vendasMesFervedouro > 0) {
                      print "<tr><td><b class='negrito'>Vendas de Fervedouro</b></td><td>R$ " . number_format($vendasMesFervedouro, 2, ',', '.') . " (" . $porcentagemFervedouro . "%)</td></tr>";
                    } else {
                      print "<tr><td><b class='negrito'>Vendas de Fervedouro</b></td><td>R$ 0,00 (0%)</td></tr>";
                    }
								?>

					</div>
									<div class="titulo">
										<table id="tabelaLogisticaDash">
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
										 <button class="botao" style="background:#E82F0C"><a href="cobranca.php?" class="hideLink">Atrasados Geral</a></button>
									 </div>
								 </article>
				</div>
								 <article id="articleDash2" class='DashCaixa'>
									 		<h1 class="titulosDash">Rankings</h1><br><br>
										<div id="tabelaBotaoDash">
										 <button class="botao" style="background:#62CED1"><a href="ranking_pontuais.php" class="hideLink">Mais Pontuais</a></button>
										 <button class="botao" style="background:#167BC3"><a href="ranking_npontuais.php" class="hideLink">Menos Pontuais</a></button><br>
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

								 <article id="articleDash4" class='DashCaixa'>
										<div id="tabelaBotaoDash">
											<h1><b class='negrito'>Versão</b></h1>
										 <h2>Sismeo v0.3 Beta</h2>
										 <h2>Tiago Martins Ornelas</h2>
									 </div>
								 </article>
		  </main>
</body>
