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

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $termo_da_pesquisa = $_GET['id'];
    $conteudo_pesquisa = "select * from clientes where id=$id";
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
<main>
	<div class="popupFixo">
		<div class="popupContent">
		<h1 class="tituloBanner">Editar Cliente</h1><br>
		<p class='aviso'>Editar campos primários (como CPF e Nome) causam perda de confiabilidade nos dados.<br>Caso precise realizar a edição de um campo primário, delete e cadastre novamente ou contate o suporte.</i><br><br>
 		<form class="form" method="post" action="includes/editar_cliente-inc.php">

 			<label for="cpf">CPF: <?php echo $cpf ?></label><br>
 			<input class="popupInput" name="cpf" value="<?php echo $cpf ?>" type="number" style='display:none' maxlength="11" onKeyPress="if(this.value.length==11) return false;"><br>
 			<label for="nome"><?php echo $nome ?></label><br>
 			<input class="popupInput" value="<?php echo $nome ?>"name="nome" pattern="[A-Z0-9\s]+" type="text" style='display:none' onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" ><br>
 			<label for="referencia">Referência</label><br>
 			<input class="popupInput" value="<?php echo $referencia ?>" name="referencia" pattern="[A-Z0-9\s]+" type="text" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"><br>
 			<label for="telefone">DDD e Telefone</label><br>
 			<input class="popupInput" name="telefone" value="<?php echo $telefone ?>" type="number" minlength="10" maxlength="11" onKeyPress="if(this.value.length==11) return false;"><br>
 			<label for="endereco">Endereço</label><br>
 			<input class="popupInput" value="<?php echo $endereco ?>" name="endereco" pattern="[A-Z0-9\s]+" type="text" required onkeyup=" var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"><br>

      <input class="botao" name="submit" type="submit" value="Salvar">
			<a href="<?php echo "visualizar_cliente.php?cpf=$cpf"; ?>"><img src="img/close.png" class="close"></a>
		</form>
<?php
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "none") {
        echo "<h1 class='aviso'>Registro editado com sucesso</h1>";
      }
      if ($_GET["error"] == "notpossible") {
        echo "<h1 class='aviso'>Não foi possível editar o registro!</h1>";
      }
    }
?>
		</div>
	</div>
		<?php include('elements/background_consulta_clientes_popup.php'); ?>
	</main>
</body>
