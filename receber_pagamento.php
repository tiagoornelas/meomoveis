<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">

<head>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Assistant&display=swap"
			rel="stylesheet">
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<title>Meo Móveis</title>
	<script type="text/javascript">
        window.addEventListener('keydown',function(e){if(e.keyIdentifier=='U+000A'||e.keyIdentifier=='Enter'||e.keyCode==13){if(e.target.nodeName=='INPUT'&&e.target.type=='text'){e.preventDefault();return false;}}},true);
    </script>
</head>
<body>
<?php include('elements/cabecalho.php');
			include('elements/barraLateral.php')?>
<main>
								<?php
								// PESQUISA DADOS DO PAGAMENTO //
								require_once 'includes/dbh-inc.php';
								require_once 'includes/functions-inc.php';

								$pay = filter_input(INPUT_GET, 'pay', FILTER_SANITIZE_NUMBER_INT);
								$termo_da_pesquisa = $_GET['pay'];
								$conteudo_pesquisa = "select * from lancamentos where id='$pay'";
								$sql = $conteudo_pesquisa;
								$search = mysqli_query($conn,$sql);
								$numero_clientes = mysqli_num_rows($search);

								$exibirResultados = mysqli_fetch_array($search);
									$id = $exibirResultados[0];
									$cpf = $exibirResultados[4];
									$descricaoGeral = $exibirResultados[6];
									$parcelaN = $exibirResultados[7];
									$parcelaT = $exibirResultados[8];
									$valorParcela = $exibirResultados[9];
									$dataDeb = $exibirResultados[10];
									$valorPago = $exibirResultados[11];
									$dataCred = $exibirResultados[12];
									$valorRestanteParcela = ($valorParcela - $valorPago);

									echo "<div class='popupFixo'>
												 	 <div class='medPopupContent'>
														 	<h1 id='tituloVendaExpressa' class='tituloBanner'>Receber Pagamento</h1><br><br>
															<h2> <?php echo 'Receber parcela <b class='negrito'> $parcelaN/$parcelaT
																	( R$ " . number_format($valorRestanteParcela,2,',','.') . ")</b> da compra $descricaoGeral?'
															<br><br>
																<form method='post' action='includes/receber_pagamento-inc.php?cpf=$cpf&pay=$id&previous=$valorpago'>
																		 		<label for='data'>Data</label><br>
																		 		<input class='popupInput' name='data'
																		 					type='date' required><br>
																		 		<label for='valor'>Pagamento</label><br>
																		 		<input class='popupInput' name='valor'
																		 					type='number' step='0.01' required value='$valorRestanteParcela' max='$valorRestanteParcela'>";

																			     			if (isset($_GET["error"])) {
																			     				if ($_GET["error"] == "overpay") {
																			     					echo "<h1 class='aviso'>Não é permitido pagar mais do que o valor da parcela!</h1>";
																			     				}
																			     			}
																			     		 ?>
									 				<br><br>
									 		<input class="botao" name="submit" type="submit" value="Registrar">
									 		 <a href="<?php echo "visualizar_cliente.php?cpf=$cpf"; ?>"><img src="img/close.png" class="close"></a>
		 				 </form>
		 			</div>
			 	</div>
		<?php
// PESQUISA DADOS DO CLIENTE //
    require_once 'includes/dbh-inc.php';
    require_once 'includes/functions-inc.php';

		$cpf = filter_input(INPUT_GET, 'cpf', FILTER_SANITIZE_NUMBER_INT);
		$termo_da_pesquisa = $_GET['cpf'];
		$conteudo_pesquisa = "select * from clientes where cpf=$cpf";
		$sql = $conteudo_pesquisa;
		$search = mysqli_query($conn,$sql);
		$numero_clientes = mysqli_num_rows($search);

    while($exibirResultados = mysqli_fetch_array($search)) {
      $id = $exibirResultados[0];
      $cpf = $exibirResultados[1];
      $nome = $exibirResultados[2];
      $referencia = $exibirResultados[3];
      $telefone = $exibirResultados[4];
      $endereco = $exibirResultados[5];}

// PESQUISA PONTUALIDADE MEDIA //

			$cpf = filter_input(INPUT_GET, 'cpf', FILTER_SANITIZE_NUMBER_INT);
			$termo_da_pesquisa = $_GET['cpf'];
			$conteudo_pesquisa = "SELECT Cliente, ClienteCPF, DataDeb, DataCred,
										        AVG(DateDiff(DataDeb, DataCred)) as 'Pontualidade'
												    FROM lancamentos WHERE ClienteCPF=$cpf";
			$sql = $conteudo_pesquisa;
			$search = mysqli_query($conn,$sql);
			$numero_pgto = mysqli_num_rows($search);

	    while($exibirResultados = mysqli_fetch_array($search)) {
	      $pontualidade = $exibirResultados[4];}

// PESQUISA VALOR EM ABERTO //

							$cpf = filter_input(INPUT_GET, 'cpf', FILTER_SANITIZE_NUMBER_INT);
							$termo_da_pesquisa = $_GET['cpf'];
							$conteudo_pesquisa = "SELECT Cliente, ClienteCPF, Debito, DataDeb, Credito, DataCred,
										        SUM(Debito) - SUM(Credito)
												    FROM lancamentos WHERE Credito < Debito
                            AND ClienteCPF = '$cpf'";
							$sql = $conteudo_pesquisa;
							$search = mysqli_query($conn,$sql);

					    while($exibirResultados = mysqli_fetch_array($search)) {
					      $em_aberto = $exibirResultados[6];}

// PESQUISA VALOR EM ABERTO //

							$cpf = filter_input(INPUT_GET, 'cpf', FILTER_SANITIZE_NUMBER_INT);
							$termo_da_pesquisa = $_GET['cpf'];
							$conteudo_pesquisa = "SELECT Cliente, ClienteCPF, Debito, DataDeb, Credito, DataCred,
										        SUM(Debito) - SUM(Credito)
												    FROM lancamentos WHERE Credito < Debito
                            AND `DataDeb` < CURRENT_DATE()
														AND ClienteCPF = '$cpf'";
							$sql = $conteudo_pesquisa;
							$search = mysqli_query($conn,$sql);

					    while($exibirResultados = mysqli_fetch_array($search)) {
					      $vencido = $exibirResultados[6];}
		 ?>
    <h1 class="tituloBanner"><?php echo $nome ?></h1><br><br>
    <div id="informacoesDoCliente">
      <ul class="">
				<?php
								if ($pontualidade < -30 && $numero_pgto > 0) {
									echo '<il><legend>Pontualidade Média:</legend><b class=vermelho>' . round(-1 * $pontualidade) . ' dias de atraso</b></il><br>';
								}
								elseif ($pontualidade >= -30 && $pontualidade < 0) {
									echo '<il><legend>Pontualidade Média:</legend><b class=amarelo>' . round(-1 * $pontualidade) . ' dias de atraso</b></il><br>';
								}
								elseif ($pontualidade > 0) {
									echo '<il><legend>Pontualidade Média:</legend><b class=verde>' . round($pontualidade) . ' dias de antecedência</b></il><br>';
								} else {
									if ($numero_pgto > 0) {
									echo '<il><legend>Pontualidade Média:</legend><b class=verde> Cliente pontual</b></il><br>';
									}
									else {

									}
								};
								if ($em_aberto > 0) {
									echo '<il><legend>Valor em Aberto:</legend>
									<b class=amarelo> R$ ' . number_format($em_aberto, 2, ',', '.') . ' em aberto</b></il><br>';
								};
								if ($vencido > 0) {
									echo '<il><legend>Valor Atrasado:</legend>
									<b class=vermelho> R$ ' . number_format($vencido, 2, ',', '.') . ' em atraso</b></il><br>';
								};?>
				<br>
			  <il><legend>CPF:</legend> <?php echo $cpf ?></il><br>
   			<il><legend>Referência:</legend> <?php echo $referencia ?></il><br>
   			<il><legend>Telefone:</legend> <?php echo $telefone ?></il><br>
   			<il><legend>Endereço:</legend><?php echo $endereco ?></il><br>
      </ul>
        <button class="botao" style="background-image: linear-gradient(to right, #62CED1, #5DC771);"><a href="consulta_cliente.php" class="hideLink">Vender</a></button>
				<button class="botaoSair" style="background-image: linear-gradient(to right, #BB6177, #BB7861)"><a href="consulta_cliente.php" class="hideLink">Sair</a></button>
    </div>
		<table style='text-align:center'>
			<tr>
				<th></th>
				<th style="width:10%">Parc.</th>
				<th style="width:15%">Venc.</th>
				<th style="width:40%">Compra</th>
				<th style="width:15%">Valor</th>
				<th style="width:15%">Pgto</th>
				<th></th>
			</tr>
				<?php
				// PESQUISA VALOR EM ABERTO //
					 $cpf = filter_input(INPUT_GET, 'cpf', FILTER_SANITIZE_NUMBER_INT);
					 $termo_da_pesquisa = $_GET['cpf'];
					 $conteudo_pesquisa = "SELECT ParcelaN, ParcelaT, descricaoGeral, debito, credito, cliente, clienteCPF, dataDeb, dataCred, compraID, dataVenda,
							                  	CASE
								                 WHEN DataCred = 0 AND DataDeb < CURRENT_DATE() THEN DATEDIFF(DataDeb,CURRENT_DATE())
								                 Else DATEDIFF(DataDeb,DataCred)
								                 END AS Pontualidade
								                 FROM lancamentos WHERE ClienteCPF=$cpf
																 ORDER BY dataVenda DESC";
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
						 $pontualidade = $exibirResultados[11];

						 if ($pagamento < $valor) {
						print "<tr style='width:50%'><td><a href='index.php'><img class='botaoImgTabela' src='img/money.png'></a></td>";
					} else {
						print "<tr style='width:50%'><td> </td>";
					}
						 print "<td>$parcelaN/$parcelaT</td>";
						 print "<td>$vencimento</td>";
						 print "<td><a href='visualizar_compra.php?compraID=$compraID'><b>$descricao</b></a></td>";
						 echo "<td><i>R$ " . number_format($valor, 2, ',', '.') . "</i></td>";
			if ($pagamento > 0) {
				print "<td style='color:green'><i>R$ " . number_format($pagamento, 2, ',', '.') . "</i></td>";
			} else {
				print "<td style='color:green'></td>";
			}
			if ($pontualidade <= -30) {
				print "<td class=vermelho>$pontualidade</td></tr>";
			} if ($pontualidade < 0 && $pontualidade > -30) {
				print "<td class=amarelo>$pontualidade</td></tr>";
			} if ($pontualidade >= 0) {
				print "<td class=verde>$pontualidade</td></tr>";
				}
				}
				 ?>
			</table>
	</main>
</body>
