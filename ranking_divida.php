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
					<h1 class="titulosSismeo">Ranking de Dívidas</h1><br><br>
					<h3 class="legendaConsultas">Top 10 devedores.</h3></div>
	<div>
		<table style='text-align:center'>
			<tr>
				<th>CPF</th>				
				<th>Cliente</th>				
				<th>Compras</th>
			</tr>
				<?php
					 $conteudo_pesquisa = "SELECT Cliente, ClienteCPF, IFNULL(debito,0), IFNULL(credito, 0),
										        SUM(IFNULL(debito,0))-SUM(IFNULL(credito, 0)) as 'saldo'
												    FROM lancamentos GROUP BY ClienteCPF
																 ORDER BY saldo DESC LIMIT 10";	
					 
					 $sql = $conteudo_pesquisa;
					 $search = mysqli_query($conn,$sql);

					 while($exibirResultados = mysqli_fetch_array($search)) {
						 $cliente = $exibirResultados[0];
						 $clienteCPF = $exibirResultados[1];
						 $saldo = $exibirResultados[4];

 						 print "<tr><td>$clienteCPF</td>";
						 print "<td>$cliente</td>";
    				    print "<td class='vermelho'><i>R$ ".number_format($saldo, 2, ',', '.')."</i></td></tr>";
					 }
				 ?>
			</table>
	</main>
</body>
