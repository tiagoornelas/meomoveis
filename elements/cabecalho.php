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
        <li><a target="_blank" href="/index.php">início</a></li>
        <li><a target="_blank" href="https://api.whatsapp.com/send?phone=553237541101&text=Ol%C3%A1%2C%20gostaria%20de%20conhecer%20os%20marcas%20que%20voc%C3%AAs%20trabalham!">marcas</a></li>
        <li><a target="_blank" href="https://api.whatsapp.com/send?phone=553237541101&text=Ol%C3%A1%2C%20qual%20tipo%20de%20m%C3%B3vel%20voc%C3%AAs%20trabalham%3F">produtos</a></li>
        <li><a target="_blank" href="https://api.whatsapp.com/send?phone=553237541101&text=Ol%C3%A1%2C%20gostaria%20de%20verificar%20se%20voc%C3%AAs%20fazem%20entrega%20na%20minha%20cidade.">entregas</a></li>
        <li><a target="_blank" href="https://api.whatsapp.com/send?phone=553237541101"
              target="_blank">whatsapp</a></li>
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