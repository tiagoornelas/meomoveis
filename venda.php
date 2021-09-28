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
			include('elements/barraLateral.php');

      date_default_timezone_set('America/Sao_Paulo');
      $compraID = date('dmYhis', time());
      ?>
<main>
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
   ?>
   <!-- FORMULÁRIO -->
  <h1 class="tituloBanner"><?php echo $nome . " <a href='https://api.whatsapp.com/send?phone=55$telefone' target='_blank'><img src='img/whatsapp.png' id='whatsappVisualizarCliente'></a>"?></h1><br><br>
  <div id="informacoesDoCliente">
    <div>
      <h1 class="titulosAdcProduto">Realizar Venda </h1>
      <h2 style="font-size:1vmax;"><?php echo "ID $compraID" ?></h2><br>
      <?php echo "<form onkeydown='return event.key != 'Enter'' name='venda' method='post'
          action='includes/venda-inc.php?cpf=$cpf&compraID=$compraID'>";?>
					<input id="descricaoVenda" class="input" onkeyup="
							var start = this.selectionStart;
							var end = this.selectionEnd;
							this.value = this.value.toUpperCase();
							this.setSelectionRange(start, end);" name="descricao"
								type="text" placeholder="Dê um nome de ref. para a compra." maxlength="50" pattern="[A-Z\s]+" required><br>
					<label for="dataVenda">Data Real da Venda:</label>
					<input id="inputVenda" name="dataVenda" class="input"
								type="date" required><br>
					<label for="precoFrete">Frete:</label>
					<input id="precoFrete" class="input" name="precoFrete"
									type="number" step="0.01" value="0.00" required><br><br>
									<label for="origem">Origem:</label>
				            <select id="origem" name="origem" class="miniDropDown">
				              <option value="Matriz">Matriz</option>
				              <option value="Site">Site</option>
				            </select><br><br>
				          <label for="parcelas">Condição:</label>
				            <select id="parcelaT" name="parcelas" class="miniDropDown">
				              <option value="À Vista">À Vista</option>
				              <option value="Cartão">Cartão</option>
				              <option value="Financeira">Financeira</option>
				              <option value="1">1 vez</option>
				              <option value="2">2 vezes</option>
				              <option value="3">3 vezes</option>
				              <option value="4">4 vezes</option>
				              <option value="5">5 vezes</option>
				              <option value="6">6 vezes</option>
				              <option value="7">7 vezes</option>
				              <option value="8">8 vezes</option>
				              <option value="9">9 vezes</option>
				              <option value="10">10 vezes</option>
				              <option value="11">11 vezes</option>
				              <option value="12">12 vezes</option>
				            </select><br><br>
					<label for="dataPgto">Data do 1º Pgto Combinado:</label>
					<input id="input1Venc" class="input" name="dataPgto"
								type="date" required><br>
					<label for="valorEntrada">Entrada:</label>
					<input id="precoEntrada" class="input" name="valorEntrada"
									type="number" step="0.01" value="0.00" disabled="disabled" required><br><br>
									<script>
									    document.getElementById('parcelaT').onchange = function () {
									        if (this.value === 'À Vista' || this.value === 'Cartão' || this.value === 'Financeira') {
                                                var precoEntrada = document.getElementById("precoEntrada");
                                                precoEntrada.disabled = true;
                                                precoEntrada.value = '0';
    									    } else {
                                                var precoEntrada = document.getElementById("precoEntrada");
                                                precoEntrada.disabled = false;
                                                precoEntrada.value = '0';
									    }
									    }
									</script>
          <input class="botao" style="width: 7vmax; background-image: linear-gradient(to right, #62CED1, #5DC771)"
                          name="submit" type="submit" value="Finalizar">
          <button class="botaoSair" style="width: 7vmax; background-image: linear-gradient(to right, #BB6177, #BB7861)"><a href="<?php echo "visualizar_cliente.php?cpf=$cpf"; ?>" class="hideLink">Voltar</a></button>
					<?php
	     			if (isset($_GET["error"])) {
	     				if ($_GET["error"] == "stmtFailed") {
	     					echo "<h1 class='aviso'>Não consegui te conectar!</h1>";
	     				}
	     			}
	     		 ?>
  				<p class="aviso2">Só é considerado entrada se pago no ato do registro da venda, caso contrário, indicamos como parcela a ser paga na data combinada no campo de 1º pagamento.</p>
				</div>
		</div>
		<div id="tabelaProdutosVenda">
			<h1 class="titulosDash">Produtos</h1><br>
			<table>
				<th>Produto</th>
				<th>Fornecedor</th>
				<th>Preço</th>
				<th>Logística</th>
				<th></th>

<!-- P R O D U T O S -->

<!-- P R O D U T O  1 -->
<tr id="rowProduto1"><td><input onkeyup='
	var start = this.selectionStart;
	var end = this.selectionEnd;
	this.value = this.value.toUpperCase();
	this.setSelectionRange(start, end);' pattern="[A-Z0-9\s]+" name='produto1'
		type='text' required></td>
		<td><select name='fornecedor1' class='miniDropDown' >
		<option value='NAO SE APLICA'>Defina o Fornecedor</option>
		<?php
		require_once 'includes/dbh-inc.php';
		require_once 'includes/functions-inc.php';

		$conteudo_pesquisa = "SELECT * from fornecedores ORDER BY empresa ASC";
		$sql = $conteudo_pesquisa;
		$search = mysqli_query($conn,$sql);

 while($exibirResultados = mysqli_fetch_array($search)) {
		 $fornecedor = $exibirResultados[1];
		 echo "<option value='$fornecedor'>$fornecedor</option>";} ?>

	</select></td><td><input style='width:5vmax' name='precoVenda1' type='number' step='0.01' required></td>
	<td style='text-align:center'><select name='logistica1'>
		<option value='Logística completa'>Logística completa</option>
		<option value='Retirar e Entregar'>Retirar e Entregar</option>
		<option value='Somente entregar'>Somente entregar</option>
		<option value='Nada a fazer'>Nada a fazer</option></td>
	<td id="addRow2">+</td></tr>
	<script>
			document.getElementById("addRow2").addEventListener("click", function(){
				document.querySelector("#rowProduto2").style.display = "table-row";
			})
	</script>

<!-- P R O D U T O  2 -->
<tr id="rowProduto2"><td><input onkeyup='
	var start = this.selectionStart;
	var end = this.selectionEnd;
	this.value = this.value.toUpperCase();
	this.setSelectionRange(start, end);' pattern="[A-Z0-9\s]+" name='produto2'
		type='text' ></td>
		<td><select name='fornecedor2' class='miniDropDown' >
		<option value='NAO SE APLICA'>Defina o Fornecedor</option>
		<?php
		require_once 'includes/dbh-inc.php';
		require_once 'includes/functions-inc.php';

		$conteudo_pesquisa = "SELECT * from fornecedores ORDER BY empresa ASC";
		$sql = $conteudo_pesquisa;
		$search = mysqli_query($conn,$sql);

 while($exibirResultados = mysqli_fetch_array($search)) {
		 $fornecedor = $exibirResultados[1];
		 echo "<option value='$fornecedor'>$fornecedor</option>";} ?>

	</select></td><td><input style='width:5vmax' name='precoVenda2' type='number' step='0.01' ></td>
	<td style='text-align:center'><select name='logistica2'>
		<option value='Logística completa'>Logística completa</option>
		<option value='Retirar e Entregar'>Retirar e Entregar</option>
		<option value='Somente entregar'>Somente entregar</option>
		<option value='Nada a fazer'>Nada a fazer</option></td>
								<td id="addRow3">+</td></tr>
								<script>
										document.getElementById("addRow3").addEventListener("click", function(){
											document.querySelector("#rowProduto3").style.display = "table-row";
										})
								</script>

<!-- P R O D U T O  3 -->
<tr id="rowProduto3"><td><input onkeyup='
	var start = this.selectionStart;
	var end = this.selectionEnd;
	this.value = this.value.toUpperCase();
	this.setSelectionRange(start, end);' pattern="[A-Z0-9\s]+" name='produto3'
		type='text' ></td>
		<td><select name='fornecedor3' class='miniDropDown' >
		<option value='NAO SE APLICA'>Defina o Fornecedor</option>
		<?php
		require_once 'includes/dbh-inc.php';
		require_once 'includes/functions-inc.php';

		$conteudo_pesquisa = "SELECT * from fornecedores ORDER BY empresa ASC";
		$sql = $conteudo_pesquisa;
		$search = mysqli_query($conn,$sql);

 while($exibirResultados = mysqli_fetch_array($search)) {
		 $fornecedor = $exibirResultados[1];
		 echo "<option value='$fornecedor'>$fornecedor</option>";} ?>

	</select></td><td><input style='width:5vmax' name='precoVenda3' type='number' step='0.01' ></td>
	<td style='text-align:center'><select name='logistica3'>
		<option value='Logística completa'>Logística completa</option>
		<option value='Retirar e Entregar'>Retirar e Entregar</option>
		<option value='Somente entregar'>Somente entregar</option>
		<option value='Nada a fazer'>Nada a fazer</option></td>
								<td id="addRow4">+</td></tr>
								<script>
										document.getElementById("addRow4").addEventListener("click", function(){
											document.querySelector("#rowProduto4").style.display = "table-row";
										})
								</script>

<!-- P R O D U T O  4 -->
<tr  id="rowProduto4"><td><input onkeyup='
	var start = this.selectionStart;
	var end = this.selectionEnd;
	this.value = this.value.toUpperCase();
	this.setSelectionRange(start, end);' pattern="[A-Z0-9\s]+" name='produto4'
		type='text' ></td>
		<td><select name='fornecedor4' class='miniDropDown' >
		<option value='NAO SE APLICA'>Defina o Fornecedor</option>
		<?php
		require_once 'includes/dbh-inc.php';
		require_once 'includes/functions-inc.php';

		$conteudo_pesquisa = "SELECT * from fornecedores ORDER BY empresa ASC";
		$sql = $conteudo_pesquisa;
		$search = mysqli_query($conn,$sql);

 while($exibirResultados = mysqli_fetch_array($search)) {
		 $fornecedor = $exibirResultados[1];
		 echo "<option value='$fornecedor'>$fornecedor</option>";} ?>

	</select></td><td><input style='width:5vmax' name='precoVenda4' type='number' step='0.01' ></td>
	<td style='text-align:center'><select name='logistica4'>
		<option value='Logística completa'>Logística completa</option>
		<option value='Retirar e Entregar'>Retirar e Entregar</option>
		<option value='Somente entregar'>Somente entregar</option>
		<option value='Nada a fazer'>Nada a fazer</option></td>
								<td id="addRow5">+</td></tr>
								<script>
										document.getElementById("addRow5").addEventListener("click", function(){
											document.querySelector("#rowProduto5").style.display = "table-row";
										})
								</script>

<!-- P R O D U T O  5 -->
<tr id="rowProduto5"><td><input onkeyup='
	var start = this.selectionStart;
	var end = this.selectionEnd;
	this.value = this.value.toUpperCase();
	this.setSelectionRange(start, end);' pattern="[A-Z0-9\s]+" name='produto5'
		type='text' ></td>
		<td><select name='fornecedor5' class='miniDropDown' >
		<option value='NAO SE APLICA'>Defina o Fornecedor</option>
		<?php
		require_once 'includes/dbh-inc.php';
		require_once 'includes/functions-inc.php';

		$conteudo_pesquisa = "SELECT * from fornecedores ORDER BY empresa ASC";
		$sql = $conteudo_pesquisa;
		$search = mysqli_query($conn,$sql);

 while($exibirResultados = mysqli_fetch_array($search)) {
		 $fornecedor = $exibirResultados[1];
		 echo "<option value='$fornecedor'>$fornecedor</option>";} ?>

	</select></td><td><input style='width:5vmax' name='precoVenda5' type='number' step='0.01' ></td>
	<td style='text-align:center'><select name='logistica5'>
		<option value='Logística completa'>Logística completa</option>
		<option value='Retirar e Entregar'>Retirar e Entregar</option>
		<option value='Somente entregar'>Somente entregar</option>
		<option value='Nada a fazer'>Nada a fazer</option></td>
								<td id="addRow6">+</td></tr>
								<script>
										document.getElementById("addRow6").addEventListener("click", function(){
											document.querySelector("#rowProduto6").style.display = "table-row";
										})
								</script>

<!-- P R O D U T O  6 -->
<tr id="rowProduto6"><td><input onkeyup='
	var start = this.selectionStart;
	var end = this.selectionEnd;
	this.value = this.value.toUpperCase();
	this.setSelectionRange(start, end);' pattern="[A-Z0-9\s]+" name='produto6'
		type='text' ></td>
		<td><select name='fornecedor6' class='miniDropDown' >
		<option value='NAO SE APLICA'>Defina o Fornecedor</option>
		<?php
		require_once 'includes/dbh-inc.php';
		require_once 'includes/functions-inc.php';

		$conteudo_pesquisa = "SELECT * from fornecedores ORDER BY empresa ASC";
		$sql = $conteudo_pesquisa;
		$search = mysqli_query($conn,$sql);

 while($exibirResultados = mysqli_fetch_array($search)) {
		 $fornecedor = $exibirResultados[1];
		 echo "<option value='$fornecedor'>$fornecedor</option>";} ?>

	</select></td><td><input style='width:5vmax' name='precoVenda6' type='number' step='0.01' ></td>
	<td style='text-align:center'><select name='logistica6'>
		<option value='Logística completa'>Logística completa</option>
		<option value='Retirar e Entregar'>Retirar e Entregar</option>
		<option value='Somente entregar'>Somente entregar</option>
		<option value='Nada a fazer'>Nada a fazer</option></td>
								<td id="addRow7">+</td></tr>
								<script>
										document.getElementById("addRow7").addEventListener("click", function(){
											document.querySelector("#rowProduto7").style.display = "table-row";
										})
								</script>

<!-- P R O D U T O  7 -->
<tr id="rowProduto7"><td><input onkeyup='
	var start = this.selectionStart;
	var end = this.selectionEnd;
	this.value = this.value.toUpperCase();
	this.setSelectionRange(start, end);' pattern="[A-Z0-9\s]+" name='produto7'
		type='text' ></td>
		<td><select name='fornecedor7' class='miniDropDown' >
		<option value='NAO SE APLICA'>Defina o Fornecedor</option>
		<?php
		require_once 'includes/dbh-inc.php';
		require_once 'includes/functions-inc.php';

		$conteudo_pesquisa = "SELECT * from fornecedores ORDER BY empresa ASC";
		$sql = $conteudo_pesquisa;
		$search = mysqli_query($conn,$sql);

 while($exibirResultados = mysqli_fetch_array($search)) {
		 $fornecedor = $exibirResultados[1];
		 echo "<option value='$fornecedor'>$fornecedor</option>";} ?>

	</select></td><td><input style='width:5vmax' name='precoVenda7' type='number' step='0.01' ></td>
	<td style='text-align:center'><select name='logistica7'>
		<option value='Logística completa'>Logística completa</option>
		<option value='Retirar e Entregar'>Retirar e Entregar</option>
		<option value='Somente entregar'>Somente entregar</option>
		<option value='Nada a fazer'>Nada a fazer</option></td>
								<td id="addRow8">+</td></tr>
								<script>
										document.getElementById("addRow8").addEventListener("click", function(){
											document.querySelector("#rowProduto8").style.display = "table-row";
										})
								</script>

<!-- P R O D U T O  8 -->
<tr id="rowProduto8"><td><input onkeyup='
	var start = this.selectionStart;
	var end = this.selectionEnd;
	this.value = this.value.toUpperCase();
	this.setSelectionRange(start, end);' pattern="[A-Z0-9\s]+" name='produto8'
		type='text' ></td>
		<td><select name='fornecedor8' class='miniDropDown' >
		<option value='NAO SE APLICA'>Defina o Fornecedor</option>
		<?php
		require_once 'includes/dbh-inc.php';
		require_once 'includes/functions-inc.php';

		$conteudo_pesquisa = "SELECT * from fornecedores ORDER BY empresa ASC";
		$sql = $conteudo_pesquisa;
		$search = mysqli_query($conn,$sql);

 while($exibirResultados = mysqli_fetch_array($search)) {
		 $fornecedor = $exibirResultados[1];
		 echo "<option value='$fornecedor'>$fornecedor</option>";} ?>

	</select></td><td><input style='width:5vmax' name='precoVenda8' type='number' step='0.01' ></td>
	<td style='text-align:center'><select name='logistica8'>
		<option value='Logística completa'>Logística completa</option>
		<option value='Retirar e Entregar'>Retirar e Entregar</option>
		<option value='Somente entregar'>Somente entregar</option>
		<option value='Nada a fazer'>Nada a fazer</option></td>
								<td id="addRow9">+</td></tr>
								<script>
										document.getElementById("addRow9").addEventListener("click", function(){
											document.querySelector("#rowProduto9").style.display = "table-row";
										})
								</script>

<!-- P R O D U T O  9 -->
<tr id="rowProduto9"><td><input onkeyup='
	var start = this.selectionStart;
	var end = this.selectionEnd;
	this.value = this.value.toUpperCase();
	this.setSelectionRange(start, end);' pattern="[A-Z0-9\s]+" name='produto9'
		type='text' ></td>
		<td><select name='fornecedor9' class='miniDropDown' >
		<option value='NAO SE APLICA'>Defina o Fornecedor</option>
		<?php
		require_once 'includes/dbh-inc.php';
		require_once 'includes/functions-inc.php';

		$conteudo_pesquisa = "SELECT * from fornecedores ORDER BY empresa ASC";
		$sql = $conteudo_pesquisa;
		$search = mysqli_query($conn,$sql);

 while($exibirResultados = mysqli_fetch_array($search)) {
		 $fornecedor = $exibirResultados[1];
		 echo "<option value='$fornecedor'>$fornecedor</option>";} ?>

	</select></td><td><input style='width:5vmax' name='precoVenda9' type='number' step='0.01' ></td>
	<td style='text-align:center'><select name='logistica9'>
		<option value='Logística completa'>Logística completa</option>
		<option value='Retirar e Entregar'>Retirar e Entregar</option>
		<option value='Somente entregar'>Somente entregar</option>
		<option value='Nada a fazer'>Nada a fazer</option></td>
								<td id="addRow10">+</td></tr>
								<script>
										document.getElementById("addRow10").addEventListener("click", function(){
											document.querySelector("#rowProduto10").style.display = "table-row";
										})
								</script>

<!-- P R O D U T O  10-->
	<tr id="rowProduto10"><td><input onkeyup='
		var start = this.selectionStart;
		var end = this.selectionEnd;
		this.value = this.value.toUpperCase();
		this.setSelectionRange(start, end);' pattern="[A-Z0-9\s]+" name='produto10'
			type='text' ></td>
			<td><select name='fornecedor10' class='miniDropDown' >
			<option value='NAO SE APLICA'>Defina o Fornecedor</option>
			<?php
			require_once 'includes/dbh-inc.php';
			require_once 'includes/functions-inc.php';

			$conteudo_pesquisa = "SELECT * from fornecedores ORDER BY empresa ASC";
			$sql = $conteudo_pesquisa;
			$search = mysqli_query($conn,$sql);

	 while($exibirResultados = mysqli_fetch_array($search)) {
			 $fornecedor = $exibirResultados[1];
			 echo "<option value='$fornecedor'>$fornecedor</option>";} ?>

		</select></td><td><input style='width:5vmax' name='precoVenda10' type='number' step='0.01' ></td>
		<td style='text-align:center'><select name='logistica10'>
			<option value='Logística completa'>Logística completa</option>
			<option value='Retirar e Entregar'>Retirar e Entregar</option>
			<option value='Somente entregar'>Somente entregar</option>
			<option value='Nada a fazer'>Nada a fazer</option></td>

						</div>
			 </div>
			 </table>
 			<p class="Aviso">Registre os produtos aqui separadamente, ou seja, um a um.<br><br>
			Isso é extremamente importante para que o sistema lhe auxilie nos lançamentos de logística<br>
			e para efetuar pedidos aos vendedores.</p>
			</form>
