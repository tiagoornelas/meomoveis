<div id="searchboxConsultas">
      <section>
      <form class="form" method="post" action="includes/consulta_fornecedor-inc.php">
        <input name="pesquisa" type="text" maxlength="255" placeholder="Nome do Fornecedor"><br>
      </div>
        <input id="botaoConsulta" name="submit" type="image" src="img/search.png">
        <a href="cadastro_fornecedor.php"><img id="botaoCadastro" src="img/add-person.png"></a>
      </form>

      <?php
        if (isset($_GET["error"])) {
          if ($_GET["error"] == "emptyInput") {
            echo "<h1 class='aviso'>Preencha pelo menos um campo!</h1>";
          }
          if ($_GET["error"] == "moreThanOneInput") {
            echo "<h1 class='aviso'>Preencha somente um dos campos!</h1>";
          }
          if ($_GET["error"] == "stmtFailed") {
            echo "<h1 class='aviso'>Não consegui te conectar!</h1>";
          }
          if ($_GET["error"] == "none") {
            echo "<h1 class='aviso'>Pesquisa realizada.</h1>";
          }
          if ($_GET["error"] == "edited") {
            echo "<h1 class='aviso'>Registro editado com sucesso.</h1>";
          }
          if ($_GET["error"] == "deleted") {
            echo "<h1 class='aviso'>Registro deletado com sucesso.</h1>";
          }
          if ($_GET["error"] == "deletenotpossible") {
            echo "<h1 class='aviso'>Não foi possível deletar o registro.</h1>";
          }
        }
       ?>
      </section>
      <table>
        <tr>
          <th></th>
          <th></th>
          <th>Empresa</th>
          <th>Representante</th>
          <th>Telefone</th>
        </tr>
          <?php
             while($exibirResultados = mysqli_fetch_array($search)) {
               $id = $exibirResultados[0];
               $empresa = $exibirResultados[1];
               $representante = $exibirResultados[2];
               $telefone_da_empresa = $exibirResultados[3];
               $celular_do_vendedor = $exibirResultados[4];

               print "<td><a class='hideLinkSymbol' href='editar_fornecedor.php?id=$id'>&#x270E;</a></td>";
               print "<td><a class='hideLinkSymbol' id='deleteButton' href='deletar_fornecedor.php?id=$id'>&#128465;</a></td>";
               print "<td><b><a href='visualizar_fornecedor.php?id=$id'>$empresa</a></b></td>";
               print "<td><i>$representante</i></td>";
               print "<td>$telefone_da_empresa</td></tr>";
             }
           ?>
        </table>
