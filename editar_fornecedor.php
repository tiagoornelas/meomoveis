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
    $conteudo_pesquisa = "select * from fornecedores where id=$id";
    $sql = $conteudo_pesquisa;
    $search = mysqli_query($conn,$sql);
    $numero_fornecedores = mysqli_num_rows($search);

    while($exibirResultados = mysqli_fetch_array($search)) {
      $id = $exibirResultados[0];
      $empresa = $exibirResultados[1];
      $representante = $exibirResultados[2];
      $celular_do_vendedor = $exibirResultados[3];
      $telefone_da_empresa= $exibirResultados[4];}
		 ?>
     <!-- FORMULÁRIO -->
<main>
	<div class="popupFixo">
		<div class="popupContent">
		<h1 class="tituloBanner">Editar Fornecedor</h1><br>
		<p class='aviso'>Editar campos primários (como Nome da Empresa) causam perda de confiabilidade nos dados.<br>Caso precise realizar a edição de um campo primário, delete e cadastre novamente ou contate o suporte.</i><br><br>
 		<form class="form" method="post" action="includes/editar_fornecedor-inc.php">

 			<label for="empresa"><?php echo $empresa ?></label><br>
 			<input class="popupInput" name="empresa" value="<?php echo $empresa ?>" pattern="[A-Z0-9\s]+" type="text" style='display:none' maxlength="11" onKeyPress="if(this.value.length==11) return false;"><br>
 			<label for="representante">Representante</label><br>
 			<input class="popupInput" value="<?php echo $representante ?>"name="representante" pattern="[A-Z0-9\s]+" type="text" required onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);" ><br>
 			<label for="celular_do_vendedor">DDD e Celular da Retira</label><br>
 			<input class="popupInput" value="<?php echo $celular_do_vendedor ?>" name="celular_do_vendedor" minlength="10" pattern="[A-Z0-9\s]+" type="text" onkeyup="var start = this.selectionStart; var end = this.selectionEnd; this.value = this.value.toUpperCase(); this.setSelectionRange(start, end);"><br>
 			<label for="telefone_da_empresa">DDD e Celular do Vendedor</label><br>
 			<input class="popupInput" name="telefone_da_empresa" value="<?php echo $telefone_da_empresa?>" type="number" minlength="10" maxlength="11" onKeyPress="if(this.value.length==11) return false;"><br>

      <input class="botao" name="submit" type="submit" value="Salvar">
      <a href="<?php echo "visualizar_fornecedor.php?id=$id"; ?>"><img src="img/close.png" class="close"></a>
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
		<?php include('elements/background_consulta_fornecedores_popup.php'); ?>
	</main>
</body>
