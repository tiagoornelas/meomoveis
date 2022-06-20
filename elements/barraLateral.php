<div id="barraLateral">
   <ul class="blocoSismeo">
       <?php
          if (isset($_SESSION["usuario"])) {
            echo '<il><button class="botaoBarraLateral"><a href="sismeo.php" class="hideLinkBarraLateral">painel</a></button></il><br>';
          }
          else {
            echo '<li><a href="/login.php">sismeo</a></li>';
          }
        ?>
     <li><button class="botaoBarraLateral"><a href="consulta_cliente.php" class="hideLinkBarraLateral">clientes</a></button></li><br>
     <li><button class="botaoBarraLateral"><a href="consulta_fornecedor.php" class="hideLinkBarraLateral">fornecedores</a></button></li><br>
     <li><button class="botaoBarraLateral"><a href="consulta_vendas.php" class="hideLinkBarraLateral">vendas</a></button></li><br>
     <li><button class="botaoBarraLateral"><a href="logistica_pedidos.php" class="hideLinkBarraLateral">pedidos</a></button></li><br>
     <li><button class="botaoBarraLateral"><a href="logistica_retiras.php" class="hideLinkBarraLateral">retiras</a></button></li><br>
     <li><button class="botaoBarraLateral"><a href="logistica_entregas.php" class="hideLinkBarraLateral">entregas</a></button></li><br>
     <li><button class="botaoBarraLateral"><a href="logistica_assistencias.php" class="hideLinkBarraLateral">assistências</a></button></li><br><br>
     <li><button class="botaoBarraLateral"><a href="includes/logout-inc.php" class="hideLinkBarraLateral">sair</a></button></li><br>
   </ul>
 </div>
