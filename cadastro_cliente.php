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
					$conteudo_pesquisa = "SELECT * from clientes where cpf like
						'%$termo_da_pesquisa%' or nome like '%$termo_da_pesquisa%' or
						referencia like '%$termo_da_pesquisa%' ORDER BY nome ASC";
					}
					else {
					$pesquisa_realizada = false;
					$conteudo_pesquisa = "SELECT * from clientes";
				}

				$sql = $conteudo_pesquisa;
				$search = mysqli_query($conn,$sql);
				$numero_clientes = mysqli_num_rows($search);
			 ?>

 <main>
	 <div class="popupFixo">
	     <div class="popupContent">
	     		<h1 class="tituloPopup">Cadastrar Cliente</h1><br><br>
	     		<form method="post"
	     				action="includes/cadastro_cliente-inc.php">

	     			<label for="cpf">CPF</label><br>
	     			<input class="popupInput" name="cpf" type="number" minlength="11" maxlength="11" onKeyPress="
	     					if(this.value.length==11) return false;"><br>
	     			<label for="nome">Nome</label><br>
	     			<input class="popupInput" onkeyup="
	     				  var start = this.selectionStart;
	     				  var end = this.selectionEnd;
	     				  this.value = this.value.toUpperCase();
	     				  this.setSelectionRange(start, end);" name="nome"
	     						pattern="[A-Z\s]+" type="text" required><br>
	     			<label for="referencia">Referência</label><br>
	     			<input class="popupInput" onkeyup="
	     				  var start = this.selectionStart;
	     				  var end = this.selectionEnd;
	     				  this.value = this.value.toUpperCase();
	     				  this.setSelectionRange(start, end);" name="referencia" pattern="[A-Z0-9\s]+" type="text">
	     					<br>
	     			<label for="telefone">DDD e Telefone</label><br>
	     			<input class="popupInput" name="telefone" type="number" minlength="10" maxlength="11" onKeyPress="
	     					if(this.value.length==11) return false;"><br>
	     			<label for="endereco">Endereço</label><br>
	     			<input class="popupInput" onkeyup="
	     				  var start = this.selectionStart;
	     				  var end = this.selectionEnd;
	     				  this.value = this.value.toUpperCase();
	     				  this.setSelectionRange(start, end);" name="endereco"
	     							pattern="[A-Z0-9\s]+" type="text" required>
	     					<br>
	     			<input class="botao" name="submit" type="submit" value="Cadastrar">
	           <a href="consulta_cliente.php"><img src="img/close.png" class="close"></a>
	     		</form>

	     		<?php
	     			if (isset($_GET["error"])) {
	     				if ($_GET["error"] == "emptyInput") {
	     					echo "<h1 class='aviso'>Você esqueceu de preencher todos os campos!</h1>";
	     				}
	     				if ($_GET["error"] == "alreadyRegistered") {
	     					echo "<h1 class='aviso'>Esse cliente já tinha sido registrado anteriormente!</h1>";
	     				}
	     				if ($_GET["error"] == "stmtFailed") {
	     					echo "<h1 class='aviso'>Não consegui te conectar!</h1>";
	     				}
	     				if ($_GET["error"] == "invalidCPF") {
	     					echo "<h1 class='aviso'>CPF Inválido!</h1>";
	     				}
      				    if ($_GET["error"] == "none") {
	     					echo "<h1 class='aviso'>Cliente cadastrado com sucesso!</h1>";
	     				}
	     			}
	     		 ?>
	      </div>
	   </div>
		<?php include('elements/background_consulta_clientes_popup.php'); ?>
	</main>
</body>
