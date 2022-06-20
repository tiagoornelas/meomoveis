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
			include('elements/barraLateral.php'); ?>
<main>
		<?php

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
      $telefone_da_empresa = $exibirResultados[3];
      $celular_do_vendedor = $exibirResultados[4];}
		 ?>
     <!-- FORMULÁRIO -->
    <h1 class="tituloBanner"><?php echo $empresa ?></h1><br><br>
    <div id="informacoesDoCliente">
      <ul class="">
   			<il><legend>ID do Fornecedor:</legend> <?php echo $id ?></il><br>
        <il><legend>Representante:</legend> <?php echo $representante ?></il><br>
   			<il><legend>Celular da Retira:</legend> <?php echo $telefone_da_empresa ?></il><br>
				<il><legend>Celular do Vendedor:</legend> <?php echo $celular_do_vendedor ?></il><br><br>
      </ul>
				<?php
				if ($celular_do_vendedor != '') {
					print "<button class='botao'><a target='_blank' href='https://api.whatsapp.com/send?phone=55$celular_do_vendedor' class='hideLink'>Contato</a></button>";
				}
				?>
                <button class="botao" style="background-image: linear-gradient(to right, #62CED1, #5DC771);"><a href="<?php echo "editar_fornecedor.php?id=$id";?>" class="hideLink">Editar</a></button>
				<button class="botaoSair"><a href="consulta_fornecedor.php" class="hideLink">Sair</a></button>
    </div>
	</main>
</body>
