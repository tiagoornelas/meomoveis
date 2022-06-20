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
				<th></th>
			</tr>
				<?php
					 $conteudo_pesquisa = "SELECT lancamentos.ParcelaN, lancamentos.ParcelaT, lancamentos.descricaoGeral, lancamentos.debito, lancamentos.credito, lancamentos.cliente, lancamentos.clienteCPF, lancamentos.dataDeb, lancamentos.dataCred, lancamentos.compraID, lancamentos.dataVenda, lancamentos.ID, clientes.TELEFONE
												    FROM lancamentos INNER JOIN clientes ON lancamentos.clienteCPF = clientes.CPF WHERE lancamentos.dataDeb = CURRENT_DATE";
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
						if ($whatsapp > 0) {
							print "<td><a href='https://api.whatsapp.com/send?phone=55$whatsapp
							&text=Olá%2C%20cliente!%20Este%20é%20uma%20mensagem%20automática%20para%20te%20lembrar%20que%20hoje%20é%20a%20data%20de%20vencimento%20da%20sua%20parcela%20no%20valor%20de%20R%24%20$valor%20.%20Aguardamos%20você%20na%20loja%20e%20caso%20precise%20de%20ajuda%20para%20efetuar%20o%20pagamento%2C%20podemos%20passar%20conta%20para%20transferência%2C%20PIX%20ou%20boleto%20bancário.%20Obrigado!' target='_blank'>
							<img class='botaoImgTabela' src='img/whatsapp-cliente.png'></a></td></tr>"; }
				}
				 ?>
			</table>
	</main>
</body>
