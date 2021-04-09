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
// PESQUISA DADOS DO CLIENTE //
    require_once 'includes/dbh-inc.php';
    require_once 'includes/functions-inc.php';
	  ?>
	 <div id="dashConsultaCliente">
				<div class="titulo">
					<h1 class="titulosSismeo">Relatório de Cobrança</h1><br><br>
					<h3 class="legendaConsultas">Margem de atraso com base no solicitado.</h3></div>
	<div>
		<table style='text-align:center'>
			<tr>
				<th>Parc.</th>
				<th style='width:15%'>Venc.</th>
				<th style='width:30%'>Cliente</th>
				<th style='width:30%'>Compra</th>
				<th style='width:15%'>Valor</th>
				<th style='width:15%'>Pago</th>
				<th>Atraso</th>
				<th></th>
			</tr>
				<?php
					 $late = filter_input(INPUT_GET, 'late', FILTER_SANITIZE_NUMBER_INT);
					 if(empty($late)) {
					 $conteudo_pesquisa = "SELECT lancamentos.ParcelaN, lancamentos.ParcelaT, lancamentos.descricaoGeral, lancamentos.debito, lancamentos.credito, lancamentos.cliente, lancamentos.clienteCPF, lancamentos.dataDeb, lancamentos.dataCred, lancamentos.compraID, lancamentos.dataVenda, lancamentos.ID, clientes.TELEFONE, DateDiff(DataDeb, CURRENT_DATE()) as 'Pontualidade'
												    FROM lancamentos INNER JOIN clientes ON lancamentos.clienteCPF = clientes.CPF WHERE DATEDIFF(DataDeb,CURRENT_DATE()) < 0 AND lancamentos.debito > IFNULL(lancamentos.credito, 0)
																 ORDER BY dataDeb ASC";
					 } elseif ($late == 5) {
					 $conteudo_pesquisa = "SELECT lancamentos.ParcelaN, lancamentos.ParcelaT, lancamentos.descricaoGeral, lancamentos.debito, lancamentos.credito, lancamentos.cliente, lancamentos.clienteCPF, lancamentos.dataDeb, lancamentos.dataCred, lancamentos.compraID, lancamentos.dataVenda, lancamentos.ID, clientes.TELEFONE, DateDiff(DataDeb, CURRENT_DATE()) as 'Pontualidade'
												    FROM lancamentos INNER JOIN clientes ON lancamentos.clienteCPF = clientes.CPF WHERE DATEDIFF(DataDeb,CURRENT_DATE()) >= -5 AND DATEDIFF(DataDeb,CURRENT_DATE()) < 0 AND lancamentos.debito > IFNULL(lancamentos.credito, 0)
																 ORDER BY dataDeb ASC";	
					 } elseif ($late == 30) {
					 $conteudo_pesquisa = "SELECT lancamentos.ParcelaN, lancamentos.ParcelaT, lancamentos.descricaoGeral, lancamentos.debito, lancamentos.credito, lancamentos.cliente, lancamentos.clienteCPF, lancamentos.dataDeb, lancamentos.dataCred, lancamentos.compraID, lancamentos.dataVenda, lancamentos.ID, clientes.TELEFONE, DateDiff(DataDeb, CURRENT_DATE()) as 'Pontualidade'
												    FROM lancamentos INNER JOIN clientes ON lancamentos.clienteCPF = clientes.CPF WHERE DATEDIFF(DataDeb,CURRENT_DATE()) >= -30 AND DATEDIFF(DataDeb,CURRENT_DATE()) < -5 AND lancamentos.debito > IFNULL(lancamentos.credito, 0)
																 ORDER BY dataDeb ASC";	
					 } elseif ($late == 90) {
					 $conteudo_pesquisa = "SELECT lancamentos.ParcelaN, lancamentos.ParcelaT, lancamentos.descricaoGeral, lancamentos.debito, lancamentos.credito, lancamentos.cliente, lancamentos.clienteCPF, lancamentos.dataDeb, lancamentos.dataCred, lancamentos.compraID, lancamentos.dataVenda, lancamentos.ID, clientes.TELEFONE, DateDiff(DataDeb, CURRENT_DATE()) as 'Pontualidade'
												    FROM lancamentos INNER JOIN clientes ON lancamentos.clienteCPF = clientes.CPF WHERE DATEDIFF(DataDeb,CURRENT_DATE()) >= -90 AND DATEDIFF(DataDeb,CURRENT_DATE()) < -30 AND lancamentos.debito > IFNULL(lancamentos.credito, 0)
																 ORDER BY dataDeb ASC";	
					 } else {
					     header('location: index.php');
					     exit();
					 }
					 
					 $sql = $conteudo_pesquisa;
					 $search = mysqli_query($conn,$sql);

					 while($exibirResultados = mysqli_fetch_array($search)) {
						 $parcelaN = $exibirResultados[0];
						 $parcelaT = $exibirResultados[1];
						 $vencimento = $exibirResultados[7];
						 $dataPagamento = $exibirResultados[8];
						 $descricao = $exibirResultados[2];
						 $valor = $exibirResultados[3];
						 $pagamento = $exibirResultados[4];
						 $compraID = $exibirResultados[9];
						 $payID = $exibirResultados[11];
						 $whatsapp = $exibirResultados[12];
						 $pontualidade = $exibirResultados[13];
						 $cliente = $exibirResultados[5];
						 $clienteCPF = $exibirResultados[6];
						 $valorRestante = $valor - $pagamento;

						 print "<td>$parcelaN/$parcelaT</td>";
						 print "<td>$vencimento</td>";
						 print "<td><a href='visualizar_cliente.php?cpf=$clienteCPF'><b>$cliente</b></a></td>";
						 print "<td><a href='visualizar_compra.php?compraID=$compraID'><b>$descricao</b></a></td>";
						 echo "<td><i>R$ " . number_format($valor, 2, ',', '.') . "</i></td>";
						 if ($pagamento <= 0) {
						     echo "<td><i></i></td>";
						 }
						 if ($pagamento > 0) {
						    echo "<td><i>R$ " . number_format($pagamento, 2, ',', '.') . "</i></td>";
						 }
							if ($pontualidade <= -30) {
								print "<td class=vermelho>$pontualidade</td>";
							} if ($pontualidade < 0 && $pontualidade > -30) {
								print "<td class=amarelo>$pontualidade</td>";
							} if ($pontualidade >= 0) {
								print "<td class=verde>$pontualidade</td>";
								}
						if ($whatsapp > 0) {
							print "<td><a href='https://web.whatsapp.com/send?phone=55$whatsapp
							&text=Olá%2C%20$cliente!%20Não%20consta%20no%20nosso%20sistema%20o%20pagamento%20da%20parcela%20*".$parcelaN."/".$parcelaT."*%20que%20está%20atrasada%20em%20*". (-1* $pontualidade) ."%20dias*%20%20no%20valor%20de%20*R$%20". number_format($valorRestante, 2, ',', '.') ."*.%0AO%20que%20podemos%20fazer%20para%20ajudá-lo%20a%20acertar%20este%20pagamento%3F%0ACaso%20já%20tenha%20efetuado%20o%20pagamento%2C%20gentileza%20nos%20avisar.' target='_blank'>
							<img class='botaoImgTabela' src='img/whatsapp-cliente.png'></a></td></tr>"; }
				}
				 ?>
			</table>
	</main>
</body>
