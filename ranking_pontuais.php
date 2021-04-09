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
	  ?>
	 <div id="dashConsultaCliente">
				<div class="titulo">
					<h1 class="titulosSismeo">Ranking de Pontualidade</h1><br><br>
					<h3 class="legendaConsultas">Top 10 mais pontuais.</h3></div>
	<div>
		<table style='text-align:center'>
			<tr>
				<th>CPF</th>				
				<th>Cliente</th>
				<th>Pontualidade</th>
			</tr>
				<?php
					 $conteudo_pesquisa = "SELECT Cliente, ClienteCPF, DataDeb, DataCred,
										        IFNULL(AVG(DateDiff(DataDeb, DataCred)), 0) as 'Pontualidade'
												    FROM lancamentos GROUP BY ClienteCPF
																 ORDER BY Pontualidade DESC LIMIT 10";	
					 
					 $sql = $conteudo_pesquisa;
					 $search = mysqli_query($conn,$sql);

					 while($exibirResultados = mysqli_fetch_array($search)) {
						 $cliente = $exibirResultados[0];
						 $clienteCPF = $exibirResultados[1];
						 $pontualidade = $exibirResultados[4];

						 print "<tr><td>$clienteCPF</td>";
 						 print "<td>$cliente</td>";
                			if ($pontualidade <= '-30') {
                				print "<td class=vermelho>".number_format($pontualidade, 2, ',', '.')."</td></tr>";
                			} elseif ($pontualidade < '0' && $pontualidade > '-30') {
                				print "<td class=amarelo>".number_format($pontualidade, 2, ',', '.')."</td></tr>";
                			} elseif ($pontualidade >= '0') {
                				print "<td class=verde>".number_format($pontualidade, 2, ',', '.')."</td></tr>";
                				}
					 }
				 ?>
			</table>
	</main>
</body>
