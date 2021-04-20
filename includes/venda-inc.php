<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">

<head>
	<link rel="stylesheet" href="../css/style.css">
	<title>Meo Móveis</title>
</head>
<body>
<main>
  <?php
		/* ===========================================================================================================================================
		==============================================================================================================================================
		I N F O S      G E R A I S */

  require_once 'dbh-inc.php';
  require_once 'functions-inc.php';

	$compraID = filter_input(INPUT_GET, 'compraID', FILTER_SANITIZE_NUMBER_INT);
	$cpf = filter_input(INPUT_GET, 'cpf', FILTER_SANITIZE_NUMBER_INT);
  $termo_da_pesquisa = $_GET['cpf'];
  $conteudo_pesquisa = "select * from clientes where cpf=$cpf";
  $sql = $conteudo_pesquisa;
  $search = mysqli_query($conn,$sql);
  $numero_clientes = mysqli_num_rows($search);
	$exibirResultados = mysqli_fetch_array($search);
    $id = $exibirResultados[0];
    $cpf = $exibirResultados[1];
    $nome = $exibirResultados[2];
    $referencia = $exibirResultados[3];
    $telefone = $exibirResultados[4];
    $endereco = $exibirResultados[5];
		$descricao = $_POST['descricao'];
		$dataVenda = $_POST['dataVenda'];
		$precoFrete = $_POST['precoFrete'];
		$origem = $_POST['origem'];
		$parcelas = $_POST['parcelas'];
		$dataPgto = $_POST['dataPgto'];
		$valorEntrada = $_POST['valorEntrada'];

		/* ===========================================================================================================================================
		==============================================================================================================================================
		P R O D U T O S */

		$produto1 = $_POST['produto1'];
		$fornecedor1 = $_POST['fornecedor1'];
		$precoVenda1 = floatval($_POST['precoVenda1']);
		if ($_POST['logistica1'] == 'Nada a fazer') {
		$pedido1 = 0;
		$retira1 = 0;
		$entrega1 = 0;
	} else if ($_POST['logistica1'] == 'Somente entregar') {
		$pedido1 = 0;
		$retira1 = 0;
		$entrega1 = 1;
	} else if ($_POST['logistica1'] == 'Retirar e Entregar') {
		$pedido1 = 0;
		$retira1 = 1;
		$entrega1 = 1;
	} if ($_POST['logistica1'] == 'Logística completa') {
		$pedido1 = 1;
		$retira1 = 1;
		$entrega1 = 1;
		}

		$produto2 = $_POST['produto2'];
		$fornecedor2 = $_POST['fornecedor2'];
		$precoVenda2 = floatval($_POST['precoVenda2']);
		if ($_POST['logistica2'] == 'Nada a fazer') {
		$pedido2 = 0;
		$retira2 = 0;
		$entrega2 = 0;
	} if ($_POST['logistica2'] == 'Somente entregar') {
		$pedido2 = 0;
		$retira2 = 0;
		$entrega2 = 1;
	} if ($_POST['logistica2'] == 'Retirar e Entregar') {
		$pedido2 = 0;
		$retira2 = 1;
		$entrega2 = 1;
	} if ($_POST['logistica2'] == 'Logística completa') {
		$pedido2 = 1;
		$retira2 = 1;
		$entrega2 = 1;
		}

		$produto3 = $_POST['produto3'];
		$fornecedor3 = $_POST['fornecedor3'];
		$precoVenda3 = floatval($_POST['precoVenda3']);
		if ($_POST['logistica3'] == 'Nada a fazer') {
		$pedido3 = 0;
		$retira3 = 0;
		$entrega3 = 0;
	} if ($_POST['logistica3'] == 'Somente entregar') {
		$pedido3 = 0;
		$retira3 = 0;
		$entrega3 = 1;
	} if ($_POST['logistica3'] == 'Retirar e Entregar') {
		$pedido3 = 0;
		$retira3 = 1;
		$entrega3 = 1;
	} if ($_POST['logistica3'] == 'Logística completa') {
		$pedido3 = 1;
		$retira3 = 1;
		$entrega3 = 1;
		}

		$produto4 = $_POST['produto4'];
		$fornecedor4 = $_POST['fornecedor4'];
		$precoVenda4 = floatval($_POST['precoVenda4']);
		if ($_POST['logistica4'] == 'Nada a fazer') {
		$pedido4 = 0;
		$retira4 = 0;
		$entrega4 = 0;
	} if ($_POST['logistica4'] == 'Somente entregar') {
		$pedido4 = 0;
		$retira4 = 0;
		$entrega4 = 1;
	} if ($_POST['logistica4'] == 'Retirar e Entregar') {
		$pedido4 = 0;
		$retira4 = 1;
		$entrega4 = 1;
	} if ($_POST['logistica4'] == 'Logística completa') {
		$pedido4 = 1;
		$retira4 = 1;
		$entrega4 = 1;
		}

		$produto5 = $_POST['produto5'];
		$fornecedor5 = $_POST['fornecedor5'];
		$precoVenda5 = floatval($_POST['precoVenda5']);
		if ($_POST['logistica5'] == 'Nada a fazer') {
		$pedido5 = 0;
		$retira5 = 0;
		$entrega5 = 0;
	} if ($_POST['logistica5'] == 'Somente entregar') {
		$pedido5 = 0;
		$retira5 = 0;
		$entrega5 = 1;
	} if ($_POST['logistica5'] == 'Retirar e Entregar') {
		$pedido5 = 0;
		$retira5 = 1;
		$entrega5 = 1;
	} if ($_POST['logistica5'] == 'Logística completa') {
		$pedido5 = 1;
		$retira5 = 1;
		$entrega5 = 1;
		}

		$produto6 = $_POST['produto6'];
		$fornecedor6 = $_POST['fornecedor6'];
		$precoVenda6 = floatval($_POST['precoVenda6']);
		if ($_POST['logistica6'] == 'Nada a fazer') {
		$pedido6 = 0;
		$retira6 = 0;
		$entrega6 = 0;
	} if ($_POST['logistica6'] == 'Somente entregar') {
		$pedido6 = 0;
		$retira6 = 0;
		$entrega6 = 1;
	} if ($_POST['logistica6'] == 'Retirar e Entregar') {
		$pedido6 = 0;
		$retira6 = 1;
		$entrega6 = 1;
	} if ($_POST['logistica6'] == 'Logística completa') {
		$pedido6 = 1;
		$retira6 = 1;
		$entrega6 = 1;
		}

		$produto7 = $_POST['produto7'];
		$fornecedor7 = $_POST['fornecedor7'];
		$precoVenda7 = floatval($_POST['precoVenda7']);
		if ($_POST['logistica7'] == 'Nada a fazer') {
		$pedido7 = 0;
		$retira7 = 0;
		$entrega7 = 0;
	} if ($_POST['logistica7'] == 'Somente entregar') {
		$pedido7 = 0;
		$retira7 = 0;
		$entrega7 = 1;
	} if ($_POST['logistica7'] == 'Retirar e Entregar') {
		$pedido7 = 0;
		$retira7 = 1;
		$entrega7 = 1;
	} if ($_POST['logistica7'] == 'Logística completa') {
		$pedido7 = 1;
		$retira7 = 1;
		$entrega7 = 1;
		}

		$produto8 = $_POST['produto8'];
		$fornecedor8 = $_POST['fornecedor8'];
		$precoVenda8 = floatval($_POST['precoVenda8']);
		if ($_POST['logistica8'] == 'Nada a fazer') {
		$pedido8 = 0;
		$retira8 = 0;
		$entrega8 = 0;
	} if ($_POST['logistica8'] == 'Somente entregar') {
		$pedido8 = 0;
		$retira8 = 0;
		$entrega8 = 1;
	} if ($_POST['logistica8'] == 'Retirar e Entregar') {
		$pedido8 = 0;
		$retira8 = 1;
		$entrega8 = 1;
	} if ($_POST['logistica8'] == 'Logística completa') {
		$pedido8 = 1;
		$retira8 = 1;
		$entrega8 = 1;
		}

		$produto9 = $_POST['produto9'];
		$fornecedor9 = $_POST['fornecedor9'];
		$precoVenda9 = floatval($_POST['precoVenda9']);
		if ($_POST['logistica9'] == 'Nada a fazer') {
		$pedido9 = 0;
		$retira9 = 0;
		$entrega9 = 0;
	} if ($_POST['logistica9'] == 'Somente entregar') {
		$pedido9 = 0;
		$retira9 = 0;
		$entrega9 = 1;
	} if ($_POST['logistica9'] == 'Retirar e Entregar') {
		$pedido9 = 0;
		$retira9 = 1;
		$entrega9 = 1;
	} if ($_POST['logistica9'] == 'Logística completa') {
		$pedido9 = 1;
		$retira9 = 1;
		$entrega9 = 1;
		}

		$produto10 = $_POST['produto10'];
		$fornecedor10 = $_POST['fornecedor10'];
		$precoVenda10 = floatval($_POST['precoVenda10']);
		if ($_POST['logistica10'] == 'Nada a fazer') {
		$pedido10 = 0;
		$retira10 = 0;
		$entrega10 = 0;
	} if ($_POST['logistica10'] == 'Somente entregar') {
		$pedido10 = 0;
		$retira10 = 0;
		$entrega10 = 1;
	} if ($_POST['logistica10'] == 'Retirar e Entregar') {
		$pedido10 = 0;
		$retira10 = 1;
		$entrega10 = 1;
	} if ($_POST['logistica10'] == 'Logística completa') {
		$pedido10 = 1;
		$retira10 = 1;
		$entrega10 = 1;
		}
		

		/* ===========================================================================================================================================
		==============================================================================================================================================
		I N F O S       G E R A I S */

		$valorTotal = ($precoVenda1 + $precoVenda2 + $precoVenda3 + $precoVenda4 + $precoVenda5 + $precoVenda6 + $precoVenda7 +
									$precoVenda8 + $precoVenda9 + $precoVenda10 + $precoFrete);
		$valorMenosEntrada = ($valorTotal - $valorEntrada);

		echo "<div id='print'><button style='margin-left:1.5vmax'><a style='text-decoration:none;color:black' href='#' onclick='window.print()'>Imprimir</a></button><button><a style='text-decoration:none;color:black'href='../visualizar_cliente.php?cpf=$cpf'>Voltar</a></button><br><img id='printLogo' src='../img/logopreto.png'><br>";
		  
		if ($parcelas != 'À Vista' && $parcelas != 'Financeira' && $parcelas != 'Cartão') {
		echo "<h2>Comprovante de Venda</h2>
		    <h3><i>Número $compraID</i></h3>
		    <p style='text-align: justify;text-justify: inter-word;'>Nas condições abaixo descritas e até o último vencimento abaixo exposto, pagarei por esta via de nota promissória a Martins e Ornelas LTDA (Meo Móveis),
		    CNPJ 02.179.467/0001-76, ou a sua ordem a quantia de R$ ".number_format($valorTotal, 2, ',', '.')." em moeda
		    corrente do país.</p>
		    <p>Pagável em São Francisco do Glória/MG.</p>
		    <h3>Dados do Emitente:</h3>";
		} else { echo "<h2>Comprovante de Venda</h2>
		    <h3><i>Número $compraID</i></h3>
		    <h3>Comprovante de Venda:</h3>";}
		

		echo "CPF: $cpf"; echo "<br>";
		echo "Nome: $nome"; echo "<br>";
		echo "Telefone: $telefone"; echo "<br>";
		echo "Endereço: $endereco"; echo "<br>";
		echo "Descrição da Compra: $descricao"; echo "<br>";
		echo "Data da Venda: $dataVenda"; echo "<br>";

		/* ===========================================================================================================================================
		==============================================================================================================================================
		L A N Ç A M E N T O S */


		if ($parcelas == 'À Vista' || $parcelas == 'Cartão' || $parcelas == 'Financeira') {

			$parcelaT = '1';
			$parcelaN = '1';
			$sql = "INSERT INTO lancamentos (dataVenda,	loja,	cliente,	clienteCPF,	compraID,
					descricaoGeral,	parcelaN,	parcelaT,	debito,	dataDeb,	credito,	dataCred)
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("location: ../venda.php?error=stmtFailed");
				exit();
			}
			mysqli_stmt_bind_param($stmt, "ssssssssssss", $dataVenda, $origem, $nome, $cpf, $compraID, $descricao,
				$parcelaN, $parcelaT, $valorTotal, $dataVenda, $valorTotal, $dataVenda);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);

			echo "Valor Total: R$" . number_format($valorTotal, 2, ',', '.') . "<br>";
			echo "Valor de Entrada: R$" . number_format($valorEntrada, 2, ',', '.') . "<br><br><br><br>";
			echo "x<br>";
			echo "<i>".$nome."</div>";



		} else {

			$valorParcela = ($valorMenosEntrada / $parcelas);
			echo "Valor Total: R$" . number_format($valorTotal, 2, ',', '.') . "<br>";
			echo "Valor de Entrada: R$" . number_format($valorEntrada, 2, ',', '.') . "<br>";
			echo "Número de Parcelas: $parcelas de R$" . number_format($valorParcela, 2, ',', '.') . "<br>";
			echo "Primeiro Vencimento: $dataPgto"; echo "<br><br><br>";
			echo "x<br>";
			echo "<i>".$nome."</div>";

			if ($valorEntrada > 0 ) {
				$parcelaN = '0';
				$sql = "INSERT INTO lancamentos (dataVenda,	loja,	cliente,	clienteCPF,	compraID,
						descricaoGeral,	parcelaN,	parcelaT,	debito,	dataDeb,	credito,	dataCred)
						VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("location: ../venda.php?error=stmtFailed");
					exit();
				}
				mysqli_stmt_bind_param($stmt, "ssssssssssss", $dataVenda, $origem, $nome, $cpf, $compraID, $descricao,
					$parcelaN, $parcelas, $valorEntrada, $dataVenda, $valorEntrada, $dataVenda);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
			}

				if ($parcelas >= 1) {
				$dataDeb1 = date('Y-m-d', strtotime($dataPgto));
				$parcelaN1 = '1';
				$sql = "INSERT INTO lancamentos (dataVenda,	loja,	cliente,	clienteCPF,	compraID,
						descricaoGeral,	parcelaN,	parcelaT,	debito,	dataDeb)
						VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("location: ../venda.php?error=stmtFailed");
					exit();
				}
				mysqli_stmt_bind_param($stmt, "ssssssssss", $dataVenda, $origem, $nome, $cpf, $compraID, $descricao,
					$parcelaN1, $parcelas, $valorParcela, $dataDeb1);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);


			} if ($parcelas >= 2) {
				$dataDeb2 = date('Y-m-d', strtotime("+1 months", strtotime($dataPgto)));
				$parcelaN2 = '2';
				$sql = "INSERT INTO lancamentos (dataVenda,	loja,	cliente,	clienteCPF,	compraID,
						descricaoGeral,	parcelaN,	parcelaT,	debito,	dataDeb)
						VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("location: ../venda.php?error=stmtFailed");
					exit();
				}
				mysqli_stmt_bind_param($stmt, "ssssssssss", $dataVenda, $origem, $nome, $cpf, $compraID, $descricao,
					$parcelaN2, $parcelas, $valorParcela, $dataDeb2);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);


			} if ($parcelas >= 3) {
				$dataDeb3 = date('Y-m-d', strtotime("+2 months", strtotime($dataPgto)));
				$parcelaN3 = '3';
				$sql = "INSERT INTO lancamentos (dataVenda,	loja,	cliente,	clienteCPF,	compraID,
						descricaoGeral,	parcelaN,	parcelaT,	debito,	dataDeb)
						VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("location: ../venda.php?error=stmtFailed");
					exit();
				}
				mysqli_stmt_bind_param($stmt, "ssssssssss", $dataVenda, $origem, $nome, $cpf, $compraID, $descricao,
					$parcelaN3, $parcelas, $valorParcela, $dataDeb3);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);


			} if ($parcelas >= 4) {
				$dataDeb4 = date('Y-m-d', strtotime("+3 months", strtotime($dataPgto)));
				$parcelaN4 = '4';
				$sql = "INSERT INTO lancamentos (dataVenda,	loja,	cliente,	clienteCPF,	compraID,
						descricaoGeral,	parcelaN,	parcelaT,	debito,	dataDeb)
						VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("location: ../venda.php?error=stmtFailed");
					exit();
				}
				mysqli_stmt_bind_param($stmt, "ssssssssss", $dataVenda, $origem, $nome, $cpf, $compraID, $descricao,
					$parcelaN4, $parcelas, $valorParcela, $dataDeb4);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);


			} if ($parcelas >= 5) {
				$dataDeb5 = date('Y-m-d', strtotime("+4 months", strtotime($dataPgto)));
				$parcelaN5 = '5';
				$sql = "INSERT INTO lancamentos (dataVenda,	loja,	cliente,	clienteCPF,	compraID,
						descricaoGeral,	parcelaN,	parcelaT,	debito,	dataDeb)
						VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("location: ../venda.php?error=stmtFailed");
					exit();
				}
				mysqli_stmt_bind_param($stmt, "ssssssssss", $dataVenda, $origem, $nome, $cpf, $compraID, $descricao,
					$parcelaN5, $parcelas, $valorParcela, $dataDeb5);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);


			} if ($parcelas >= 6) {
				$dataDeb6 = date('Y-m-d', strtotime("+5 months", strtotime($dataPgto)));
				$parcelaN6 = '6';
				$sql = "INSERT INTO lancamentos (dataVenda,	loja,	cliente,	clienteCPF,	compraID,
						descricaoGeral,	parcelaN,	parcelaT,	debito,	dataDeb)
						VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("location: ../venda.php?error=stmtFailed");
					exit();
				}
				mysqli_stmt_bind_param($stmt, "ssssssssss", $dataVenda, $origem, $nome, $cpf, $compraID, $descricao,
					$parcelaN6, $parcelas, $valorParcela, $dataDeb6);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);


			} if ($parcelas >= 7) {
				$dataDeb7 = date('Y-m-d', strtotime("+6 months", strtotime($dataPgto)));
				$parcelaN7 = '7';
				$sql = "INSERT INTO lancamentos (dataVenda,	loja,	cliente,	clienteCPF,	compraID,
						descricaoGeral,	parcelaN,	parcelaT,	debito,	dataDeb)
						VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("location: ../venda.php?error=stmtFailed");
					exit();
				}
				mysqli_stmt_bind_param($stmt, "ssssssssss", $dataVenda, $origem, $nome, $cpf, $compraID, $descricao,
					$parcelaN7, $parcelas, $valorParcela, $dataDeb7);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);


			} if ($parcelas >= 8) {
				$dataDeb8 = date('Y-m-d', strtotime("+7 months", strtotime($dataPgto)));
				$parcelaN8 = '8';
				$sql = "INSERT INTO lancamentos (dataVenda,	loja,	cliente,	clienteCPF,	compraID,
						descricaoGeral,	parcelaN,	parcelaT,	debito,	dataDeb)
						VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("location: ../venda.php?error=stmtFailed");
					exit();
				}
				mysqli_stmt_bind_param($stmt, "ssssssssss", $dataVenda, $origem, $nome, $cpf, $compraID, $descricao,
					$parcelaN8, $parcelas, $valorParcela, $dataDeb8);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);


			} if ($parcelas >= 9) {
				$dataDeb9 = date('Y-m-d', strtotime("+8 months", strtotime($dataPgto)));
				$parcelaN9 = '9';
				$sql = "INSERT INTO lancamentos (dataVenda,	loja,	cliente,	clienteCPF,	compraID,
						descricaoGeral,	parcelaN,	parcelaT,	debito,	dataDeb)
						VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("location: ../venda.php?error=stmtFailed");
					exit();
				}
				mysqli_stmt_bind_param($stmt, "ssssssssss", $dataVenda, $origem, $nome, $cpf, $compraID, $descricao,
					$parcelaN9, $parcelas, $valorParcela, $dataDeb9);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);


			} if ($parcelas >= 10) {
				$dataDeb10 = date('Y-m-d', strtotime("+9 months", strtotime($dataPgto)));
				$parcelaN10 = '10';
				$sql = "INSERT INTO lancamentos (dataVenda,	loja,	cliente,	clienteCPF,	compraID,
						descricaoGeral,	parcelaN,	parcelaT,	debito,	dataDeb)
						VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("location: ../venda.php?error=stmtFailed");
					exit();
				}
				mysqli_stmt_bind_param($stmt, "ssssssssss", $dataVenda, $origem, $nome, $cpf, $compraID, $descricao,
					$parcelaN10, $parcelas, $valorParcela, $dataDeb10);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);


			} if ($parcelas >= 11) {
				$dataDeb11 = date('Y-m-d', strtotime("+10 months", strtotime($dataPgto)));
				$parcelaN11 = '11';
				$sql = "INSERT INTO lancamentos (dataVenda,	loja,	cliente,	clienteCPF,	compraID,
						descricaoGeral,	parcelaN,	parcelaT,	debito,	dataDeb)
						VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("location: ../venda.php?error=stmtFailed");
					exit();
				}
				mysqli_stmt_bind_param($stmt, "ssssssssss", $dataVenda, $origem, $nome, $cpf, $compraID, $descricao,
					$parcelaN11, $parcelas, $valorParcela, $dataDeb11);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);


			} if ($parcelas == 12) {
				$dataDeb12 = date('Y-m-d', strtotime("+11 months", strtotime($dataPgto)));
				$parcelaN12 = '12';
				$sql = "INSERT INTO lancamentos (dataVenda,	loja,	cliente,	clienteCPF,	compraID,
						descricaoGeral,	parcelaN,	parcelaT,	debito,	dataDeb)
						VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("location: ../venda.php?error=stmtFailed");
					exit();
				}
				mysqli_stmt_bind_param($stmt, "ssssssssss", $dataVenda, $origem, $nome, $cpf, $compraID, $descricao,
					$parcelaN12, $parcelas, $valorParcela, $dataDeb12);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
			}
		}

		/* ===========================================================================================================================================
		==============================================================================================================================================
		V E N D A S */

		if ($precoFrete > 0) {

						$fornecedorFrete = 'MEO LOGISTICA';
						$produtoFrete = 'FRETE';
						$logisticaFrete = '0';
						$sql = "INSERT INTO vendas (compraID,	dataVenda,	loja,	cliente,	clienteCPF,
							descricaoGeral,	fornecedor,	produto,	preco,	pedido,	retira,	entrega,	assistencia	)
								VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
						$stmt = mysqli_stmt_init($conn);
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							header("location: ../venda.php?error=stmtFailed");
							exit();
						}
						mysqli_stmt_bind_param($stmt, "sssssssssiiii", $compraID, $dataVenda, $origem, $nome,
							$cpf, $descricao, $fornecedorFrete, $produtoFrete, $precoFrete, $logisticaFrete,
							 $logisticaFrete, $logisticaFrete, $logisticaFrete);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_close($stmt);
		}

		if ( empty($produto1) || empty($fornecedor1) || empty($precoVenda1) ) {

		} else {
			$assistenciaPadrao = '0';
			$sql = "INSERT INTO vendas (compraID,	dataVenda,	loja,	cliente,	clienteCPF,
				descricaoGeral,	fornecedor,	produto,	preco,	pedido,	retira,	entrega,	assistencia	)
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("location: ../venda.php?error=stmtFailed");
				exit();
			}
			mysqli_stmt_bind_param($stmt, "sssssssssiiii", $compraID, $dataVenda, $origem, $nome,
				$cpf, $descricao, $fornecedor1, $produto1, $precoVenda1, $pedido1,
				 $retira1, $entrega1, $assistenciaPadrao);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

		if ( empty($produto2) || empty($fornecedor2) || empty($precoVenda2) ) {

		} else {
			$assistenciaPadrao = '0';
			$sql = "INSERT INTO vendas (compraID,	dataVenda,	loja,	cliente,	clienteCPF,
				descricaoGeral,	fornecedor,	produto,	preco,	pedido,	retira,	entrega,	assistencia	)
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("location: ../venda.php?error=stmtFailed");
				exit();
			}
			mysqli_stmt_bind_param($stmt, "sssssssssiiii", $compraID, $dataVenda, $origem, $nome,
				$cpf, $descricao, $fornecedor2, $produto2, $precoVenda2, $pedido2,
				 $retira2, $entrega2, $assistenciaPadrao);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

		if ( empty($produto3) || empty($fornecedor3) || empty($precoVenda3) ) {

		} else {
			$assistenciaPadrao = '0';
			$sql = "INSERT INTO vendas (compraID,	dataVenda,	loja,	cliente,	clienteCPF,
				descricaoGeral,	fornecedor,	produto,	preco,	pedido,	retira,	entrega,	assistencia	)
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("location: ../venda.php?error=stmtFailed");
				exit();
			}
			mysqli_stmt_bind_param($stmt, "sssssssssiiii", $compraID, $dataVenda, $origem, $nome,
				$cpf, $descricao, $fornecedor3, $produto3, $precoVenda3, $pedido3,
				 $retira3, $entrega3, $assistenciaPadrao);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

		if ( empty($produto4) || empty($fornecedor4) || empty($precoVenda4) ) {

		} else {
			$assistenciaPadrao = '0';
			$sql = "INSERT INTO vendas (compraID,	dataVenda,	loja,	cliente,	clienteCPF,
				descricaoGeral,	fornecedor,	produto,	preco,	pedido,	retira,	entrega,	assistencia	)
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("location: ../venda.php?error=stmtFailed");
				exit();
			}
			mysqli_stmt_bind_param($stmt, "sssssssssiiii", $compraID, $dataVenda, $origem, $nome,
				$cpf, $descricao, $fornecedor4, $produto4, $precoVenda4, $pedido4,
				 $retira4, $entrega4, $assistenciaPadrao);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

		if ( empty($produto5) || empty($fornecedor5) || empty($precoVenda5) ) {

		} else {
			$assistenciaPadrao = '0';
			$sql = "INSERT INTO vendas (compraID,	dataVenda,	loja,	cliente,	clienteCPF,
				descricaoGeral,	fornecedor,	produto,	preco,	pedido,	retira,	entrega,	assistencia	)
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("location: ../venda.php?error=stmtFailed");
				exit();
			}
			mysqli_stmt_bind_param($stmt, "sssssssssiiii", $compraID, $dataVenda, $origem, $nome,
				$cpf, $descricao, $fornecedor5, $produto5, $precoVenda5, $pedido5,
				 $retira5, $entrega5, $assistenciaPadrao);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

		if ( empty($produto6) || empty($fornecedor6) || empty($precoVenda6) ) {

		} else {
			$assistenciaPadrao = '0';
			$sql = "INSERT INTO vendas (compraID,	dataVenda,	loja,	cliente,	clienteCPF,
				descricaoGeral,	fornecedor,	produto,	preco,	pedido,	retira,	entrega,	assistencia	)
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("location: ../venda.php?error=stmtFailed");
				exit();
			}
			mysqli_stmt_bind_param($stmt, "sssssssssiiii", $compraID, $dataVenda, $origem, $nome,
				$cpf, $descricao, $fornecedor6, $produto6, $precoVenda6, $pedido6,
				 $retira6, $entrega6, $assistenciaPadrao);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

		if ( empty($produto7) || empty($fornecedor7) || empty($precoVenda7) ) {

		} else {
			$assistenciaPadrao = '0';
			$sql = "INSERT INTO vendas (compraID,	dataVenda,	loja,	cliente,	clienteCPF,
				descricaoGeral,	fornecedor,	produto,	preco,	pedido,	retira,	entrega,	assistencia	)
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("location: ../venda.php?error=stmtFailed");
				exit();
			}
			mysqli_stmt_bind_param($stmt, "sssssssssiiii", $compraID, $dataVenda, $origem, $nome,
				$cpf, $descricao, $fornecedor7, $produto7, $precoVenda7, $pedido7,
				 $retira7, $entrega7, $assistenciaPadrao);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

		if ( empty($produto8) || empty($fornecedor8) || empty($precoVenda8) ) {

		} else {
			$assistenciaPadrao = '0';
			$sql = "INSERT INTO vendas (compraID,	dataVenda,	loja,	cliente,	clienteCPF,
				descricaoGeral,	fornecedor,	produto,	preco,	pedido,	retira,	entrega,	assistencia	)
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("location: ../venda.php?error=stmtFailed");
				exit();
			}
			mysqli_stmt_bind_param($stmt, "sssssssssiiii", $compraID, $dataVenda, $origem, $nome,
				$cpf, $descricao, $fornecedor8, $produto8, $precoVenda8, $pedido8,
				 $retira8, $entrega8, $assistenciaPadrao);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

		if ( empty($produto9) || empty($fornecedor9) || empty($precoVenda9) ) {

		} else {
			$assistenciaPadrao = '0';
			$sql = "INSERT INTO vendas (compraID,	dataVenda,	loja,	cliente,	clienteCPF,
				descricaoGeral,	fornecedor,	produto,	preco,	pedido,	retira,	entrega,	assistencia	)
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("location: ../venda.php?error=stmtFailed");
				exit();
			}
			mysqli_stmt_bind_param($stmt, "sssssssssiiii", $compraID, $dataVenda, $origem, $nome,
				$cpf, $descricao, $fornecedor9, $produto9, $precoVenda9, $pedido9,
				 $retira9, $entrega9, $assistenciaPadrao);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

		if ( empty($produto10) || empty($fornecedor10) || empty($precoVenda10) ) {

		} else {
			$assistenciaPadrao = '0';
			$sql = "INSERT INTO vendas (compraID,	dataVenda,	loja,	cliente,	clienteCPF,
				descricaoGeral,	fornecedor,	produto,	preco,	pedido,	retira,	entrega,	assistencia	)
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("location: ../venda.php?error=stmtFailed");
				exit();
			}
			mysqli_stmt_bind_param($stmt, "sssssssssiiii", $compraID, $dataVenda, $origem, $nome,
				$cpf, $descricao, $fornecedor10, $produto10, $precoVenda10, $pedido10,
				 $retira10, $entrega10, $assistenciaPadrao);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

   ?>
