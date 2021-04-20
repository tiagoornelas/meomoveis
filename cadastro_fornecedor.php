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

				require_once 'includes/dbh-inc.php';
				require_once 'includes/functions-inc.php';
				if (isset($_GET["search"])) {
					$pesquisa_realizada = true;
					$termo_da_pesquisa = $_GET['search'];
					$conteudo_pesquisa = "SELECT * from fornecedores where name like
						'%$termo_da_pesquisa%' ORDER BY empresa ASC";
					}
					else {
					$pesquisa_realizada = false;
					$conteudo_pesquisa = "SELECT * from fornecedores ORDER BY empresa ASC";
				}

				$sql = $conteudo_pesquisa;
				$search = mysqli_query($conn,$sql);
				$numero_clientes = mysqli_num_rows($search);
			 ?>

 <main>
	 <div class="popupFixo">
	     <div class="popupContent">
		<h1 class="tituloPopup">Cadastrar Fornecedor</h1><br><br>
		<form method="post"
				action="includes/cadastro_fornecedor-inc.php">

			<label for="empresa">Empresa</label><br>
			<input class="popupInput" onkeyup="
				  var start = this.selectionStart;
				  var end = this.selectionEnd;
				  this.value = this.value.toUpperCase();
				  this.setSelectionRange(start, end);" name="empresa"
						pattern="[A-Z0-9\s]+" type="text" required><br>
			<label for="representante">Representante</label><br>
			<input class="popupInput" onkeyup="
				  var start = this.selectionStart;
				  var end = this.selectionEnd;
				  this.value = this.value.toUpperCase();
				  this.setSelectionRange(start, end);" name="representante" pattern="[A-Z0-9\s]+" type="text">
					<br>
			<label for="telefone_da_empresa">DDD e Celular da Retira</label><br>
			<input class="popupInput" name="telefone_da_empresa" type="number" minlength="10" maxlength="11" onKeyPress="
					if(this.value.length==11) return false;"><br>
			<label for="celular_do_vendedor">DDD e Celular do Vendedor</label><br>
			<input class="popupInput" name="celular_do_vendedor" type="number" minlength="10" maxlength="11" onKeyPress="
					if(this.value.length==11) return false;"><br>
					<br>
			<input class="botao" name="submit" type="submit" value="Cadastrar">
			<a href="visualizar_fornecedor.php"><img src="img/close.png" class="close"></a>
		</form>

		<?php
			if (isset($_GET["error"])) {
				if ($_GET["error"] == "emptyInput") {
					echo "<h1 class='aviso'>Você esqueceu de preencher todos os campos!</h1>";
				}
				if ($_GET["error"] == "alreadyRegistered") {
					echo "<h1 class='aviso'>Essa empresa ou telefone já tinha sido registrado anteriormente!</h1>";
				}
				if ($_GET["error"] == "stmtFailed") {
					echo "<h1 class='aviso'>Não consegui te conectar!</h1>";
				}
				if ($_GET["error"] == "none") {
					echo "<h1 class='aviso'>Fornecedor cadastrado com sucesso!</h1>";
				}
			}
		 ?>
	 		</div>
 		</div>
			<?php include('elements/background_consulta_fornecedores_popup.php'); ?>
					</main>
</body>
