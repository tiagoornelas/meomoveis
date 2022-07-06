<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">

<head>

	<title>Meo Móveis</title>

	<?php
    
	require_once 'includes/dbh-inc.php';
	require_once 'includes/functions-inc.php';

  // PESQUISA CUSTOS DO MÊS
  $conteudo_pesquisa = "SELECT 
        (SUM(preco) / 1.68) * 1.065 AS custoTotal
    FROM
        vendas
    WHERE
        MONTH(dataVenda) = MONTH(CURRENT_DATE)
            AND YEAR(dataVenda) = YEAR(CURRENT_DATE);";

  $sql = $conteudo_pesquisa;
  $search = mysqli_query($conn,$sql);

  while($exibirResultados = mysqli_fetch_array($search)) {
  $custoTotal = $exibirResultados[0];}

  // PESQUISA RECEBIVEIS / RECEBIDO MES
  $conteudo_pesquisa = "SELECT 
      dia,
      IFNULL(SUM(credito), 0) AS credito,
      IF(dia > CURRENT_DATE,
          NULL,
          SUM(debito)) AS debito,
      SUM(recebido) AS recebido
    FROM
      (SELECT 
          dataDeb AS dia,
              SUM(debito) AS debito,
              SUM(credito) AS credito,
              IF(dataDeb < CURRENT_DATE, 0, NULL) AS recebido
      FROM
          lancamentos
      WHERE
          MONTH(DataDeb) = MONTH(CURDATE())
              AND YEAR(DataDeb) = YEAR(CURDATE())
      GROUP BY DAY(dataDeb) UNION SELECT 
          dataCred AS dia,
              IF(dataCred < CURRENT_DATE, 0, NULL) AS debito,
              IF(dataCred < CURRENT_DATE, 0, NULL) AS credito,
              SUM(credito) AS recebido
      FROM
          lancamentos
      WHERE
          MONTH(DataCred) = MONTH(CURDATE())
              AND YEAR(DataCred) = YEAR(CURDATE())
      GROUP BY DAY(dataCred)) analiseMes
    GROUP BY analiseMes.dia";

	$sql = $conteudo_pesquisa;
	$search = mysqli_query($conn,$sql);
	?>

</head>

<body>
    <main>
        <table>
            <tr>
                <th>Data</th>
                <th>Crédito</th>
                <th>Creditado</th>
                <th>Efetivado no dia</th>
                <th>Custo Total</th>
            </tr>
            <?php
              while($exibirResultados = mysqli_fetch_array($search)) {
                $dia = $exibirResultados[0];
                $debito = $exibirResultados[1];
                $credito = $exibirResultados[2];
                $recebido = $exibirResultados[3];

                print "<tr><td>$dia</td>";
                print "<td>$debito</td>";
                print "<td>$credito</td>";
                print "<td>$recebido</td>";
                print "<td>" . number_format($custoTotal, 2, ',', '.') . "</td></tr>";
              }
            ?>
        </table>
    </main>
</body>
