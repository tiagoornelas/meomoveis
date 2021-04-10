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
					<h1 class="titulosSismeo">Ranking de Compras</h1><br><br>
					<h3 class="legendaConsultas">Top 10 clientes em valor de compras.</h3></div>
	<div>
		<table style='text-align:center'>
			<tr>
				<th>CPF</th>				
				<th>Cliente</th>				
				<th>Compras</th>
			</tr>
				<?php
					 $conteudo_pesquisa = "SELECT Cliente, ClienteCPF, debito,
										        SUM(debito) as 'somaDebito'
												    FROM lancamentos GROUP BY ClienteCPF
																 ORDER BY somaDebito DESC LIMIT 10";	
					 
					 $sql = $conteudo_pesquisa;
					 $search = mysqli_query($conn,$sql);

					 while($exibirResultados = mysqli_fetch_array($search)) {
						 $cliente = $exibirResultados[0];
						 $clienteCPF = $exibirResultados[1];
						 $compras = $exibirResultados[3];

 						 print "<tr><td>$clienteCPF</td>";
						 print "<td>$cliente</td>";
    				    print "<td><i>R$ ".number_format($compras, 2, ',', '.')."</i></td></tr>";
					 }
				 ?>
			</table>
	</main>
</body>
