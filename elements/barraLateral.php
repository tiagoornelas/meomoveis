<div id="barraLateral">
   <ul class="blocoSismeo">
       <?php
          if (isset($_SESSION["usuario"])) {
            echo '<il><button class="botaoBarraLateral"><a href="sismeo.php" class="hideLinkBarraLateral">Painel</a></button></il><br>';
          }
          else {
            echo '<li><a href="/login.php">sismeo</a></li>';
          }
        ?>
     <li><button class="botaoBarraLateral"><a href="consulta_cliente.php" class="hideLinkBarraLateral">Clientes</a></button></li><br>
     <li><button class="botaoBarraLateral"><a href="consulta_fornecedor.php" class="hideLinkBarraLateral">Fornecedores</a></button></li><br>
     <li><button class="botaoBarraLateral"><a href="consulta_vendas.php" class="hideLinkBarraLateral">Vendas</a></button></li><br>
     <li><button class="botaoBarraLateral"><a href="logistica_pedidos.php" class="hideLinkBarraLateral">Pedidos</a></button></li><br>
     <li><button class="botaoBarraLateral"><a href="logistica_retiras.php" class="hideLinkBarraLateral">Retiras</a></button></li><br>
     <li><button class="botaoBarraLateral"><a href="logistica_entregas.php" class="hideLinkBarraLateral">Entregas</a></button></li><br>
     <li><button class="botaoBarraLateral"><a href="logistica_assistencias.php" class="hideLinkBarraLateral">Assistências</a></button></li><br><br>
     <li><button class="botaoBarraLateral"><a href="includes/logout-inc.php" class="hideLinkBarraLateral">Sair</a></button></li><br>
   </ul>
 </div>
