<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">

<head>

	<title>Meo Móveis</title>

	<?php
    
	require_once 'includes/dbh-inc.php';
	require_once 'includes/functions-inc.php';


		// PESQUISA VENDAS DO MÊS
		$conteudo_pesquisa = "SELECT SUM(IFNULL(preco, 0))
			FROM vendas
			WHERE MONTH(dataVenda) = MONTH(CURRENT_DATE) AND YEAR(dataVenda) = YEAR(CURRENT_DATE)";

	$sql = $conteudo_pesquisa;
	$search = mysqli_query($conn,$sql);

	while($exibirResultados = mysqli_fetch_array($search)) {
		$vendasMes = $exibirResultados[0];}

		// PESQUISA VENDAS DO MÊS NO SITE
		$conteudo_pesquisa = "SELECT SUM(IFNULL(preco, 0))
			FROM vendas
			WHERE MONTH(dataVenda) = MONTH(CURRENT_DATE) AND YEAR(dataVenda) = YEAR(CURRENT_DATE)
			AND loja = 'SITE'";

		$sql = $conteudo_pesquisa;
		$search = mysqli_query($conn,$sql);

		while($exibirResultados = mysqli_fetch_array($search)) {
		$vendasMesSite = $exibirResultados[0];}
		
		// PESQUISA FRETE SITE
		$conteudo_pesquisa = "SELECT SUM(IFNULL(preco, 0))
			FROM vendas
			WHERE MONTH(dataVenda) = MONTH(CURRENT_DATE) AND YEAR(dataVenda) = YEAR(CURRENT_DATE)
			AND loja = 'SITE' AND produto = 'FRETE'";

		$sql = $conteudo_pesquisa;
		$search = mysqli_query($conn,$sql);

		while($exibirResultados = mysqli_fetch_array($search)) {
		$freteMesSite = $exibirResultados[0];}
		
				// PESQUISA FRETE MATRIZ
		$conteudo_pesquisa = "SELECT SUM(IFNULL(preco, 0))
			FROM vendas
			WHERE MONTH(dataVenda) = MONTH(CURRENT_DATE) AND YEAR(dataVenda) = YEAR(CURRENT_DATE)
			AND loja = 'MATRIZ' AND produto = 'FRETE'";

		$sql = $conteudo_pesquisa;
		$search = mysqli_query($conn,$sql);

		while($exibirResultados = mysqli_fetch_array($search)) {
		$freteMesMatriz = $exibirResultados[0];}

	?>

</head>

<body>
    <main>
        <table>
            <tr>
                <th>Vendas Totais</th>
                <th>Vendas Site</th>
                <th>Fretes Matriz</th>
                <th>Fretes Site</th>
            </tr>
            <tr>
                <?php
                echo "<td>".number_format($vendasMes,2,',','')."</td>";
                echo "<td>".number_format($vendasMesSite,2,',','')."</td>";
                echo "<td>".number_format($fretesMesMatriz,2,',','')."</td>";
                echo "<td>".number_format($fretesMesSite,2,',','')."</td>";
                ?>
            </tr>
        </table>
    </main>
</body>
