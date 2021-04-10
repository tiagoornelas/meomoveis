<?php
  session_start();
?>
<!-- 1 - CABEÇALHO -->
<header> 	<!-- 1.1 Tag Preta (Tarja) -->
  <div>
    <?php
      if (isset($_SESSION["usuario"])) {
        $usuario = $_SESSION["usuario"];
        echo '<p id="tag">tenha um bom trabalho, ' . $usuario . '!</p>';
      }
      else {
        echo '<p id="tag">seu novo jeito de comprar móveis</p>';
      }
    ?>
  </div>

  <div>					<!-- 1.2 - Cabeçalho Principal -->
    <nav id="menuNavegacao">
      <a href='index.php'><img id="logotipo" src="/img/logo_branco.png"></a>
      <ul id="listaNavegacao"> 			<!-- 1.3 - Menu de Navegação -->
        <li><a href="/index.php">início</a></li>
        <li><a href="/marcas.php">marcas</a></li>
        <li><a href="/categorias.php">categorias</a></li>
        <li><a href="/entregas.php">entregas</a></li>
        <li><a href="https://api.whatsapp.com/send?phone=553237541101"
              target="_blank">whatsapp</a></li>
        <li><a href="/pesquisar.php">pesquisar</a></li>
        <?php
          if (isset($_SESSION["usuario"])) {
            $usuario = $_SESSION["usuario"];
            echo '<li><a href="/sismeo.php">sismeo</a></li>';
          }
          else {
            echo '<li><a href="/login.php">sismeo</a></li>';
          }
        ?>
      </ul>
    </nav>
  </div>
</header>