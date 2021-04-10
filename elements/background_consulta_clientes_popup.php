<div id="searchboxConsultas">
      <section>
      <form class="form" method="post" action="includes/consulta_cliente-inc.php">

        <input name="pesquisa" type="text" maxlength="255" placeholder="CPF / Nome / Referência">
</div>
        <input id="botaoConsulta" name="submit" type="image" src="img/search.png">
        <img id="botaoCadastro" src="img/add-person.png">
      </form>

      <?php
        if (isset($_GET["error"])) {
          if ($_GET["error"] == "emptyInput") {
            echo "<h1 class='aviso'>Preencha pelo menos um campo!</h1>";
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
<th>CPF</th>
<th>Nome</th>
<th>Referência</th>
<th>Telefone</th>
</tr>
<?php
 while($exibirResultados = mysqli_fetch_array($search)) {
   $id = $exibirResultados[0];
   $cpf = $exibirResultados[1];
   $nome = $exibirResultados[2];
   $referencia = $exibirResultados[3];
   $telefone = $exibirResultados[4];

   print "<td><a class='hideLinkSymbol' href='editar_cliente.php?id=$id'>&#x270E;</a></td>";
   print "<td><a class='hideLinkSymbol' id='deleteButton' href='deletar_cliente.php?id=$id'>&#128465;</a></td>";
   print "<td>$cpf</td>";
   print "<td><a href='visualizar_cliente.php?cpf=$cpf'><b>$nome</b></a></td>";
   print "<td><i>$referencia</i></td>";
   print "<td>$telefone</td></tr>";
 }
?>
</table>
