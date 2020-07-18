<div>
  <div>
    <div>
      <div>
        <div>
          <?php
          if (isset($_GET['acao'])) {
            $acao = $_GET['acao'];
            if ($acao == 'welcome') {
              echo
                '<div class="alert alert-info">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Olá, ' . $nomeLogado . '!</strong> Seja Bem vindo ao <strong>Blog de Redes</strong> !
               </div>';
            }
          }
          ?>
        </div>


        <div>
          <div id="target-1">
            <div>
              <h1>Blog de Redes - Apresentação</h1>
              <p>O <strong>Blog de Redes</strong> tem como objetivo gerenciar postagens feitas por alunos de redes. <br>
            </div> 
          </div> 
        </div>
      </div>



      <?php
      //excluir
      if (isset($_GET['delete'])) {
        $id_delete = $_GET['delete'];

        // seleciona a imagem
        $seleciona = "SELECT * from tb_postagens WHERE id= :id_delete";
        try {
          $result = $conexao->prepare($seleciona);
          $result->bindParam('id_delete', $id_delete, PDO::PARAM_INT);
          $result->execute();
          $contar = $result->rowCount();
          if ($contar > 0) {
            $loop = $result->fetchAll();
            foreach ($loop as $exibir) {
            }

            $fotoDeleta = $exibir['imagem'];
            $arquivo = "../upload/postagens/" . $fotoDeleta;
            unlink($arquivo);


            // exclui o registo
            $seleciona = "DELETE from tb_postagens WHERE id=:id_delete";
            try {
              $result = $conexao->prepare($seleciona);
              $result->bindParam('id_delete', $id_delete, PDO::PARAM_INT);
              $result->execute();
              $contar = $result->rowCount();
              if ($contar > 0) {
                echo '<div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Sucesso!</strong> O post foi excluído.
                </div>';
              } else {
                echo '<div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Erro!</strong> Não foi possível excluir o post.
                </div>';
              }
            } catch (PDOException $erro) {
              echo $erro;
            }
          }
        } catch (PDOException $erro) {
          echo $erro;
        }
      }

      ?>




      <div>
        <div>
          <h3>Últimos Posts</h3>
        </div>
        <div>
          <table>
            <thead>
              <tr>
                <th> Nº</th>
                <th> Título da Postagem </th>
                <th> DATA</th>
                <th> Resumo</th>
                <th> </th>
              </tr>
            </thead>
            <tbody>
              <?PHP
                include("functions/limita-texto.php");
                $select = "SELECT * from tb_postagens ORDER BY id DESC LIMIT 5";
                $contagem = 1;

                try {
                  $result = $conexao->prepare($select);
                  $result->execute();
                  $contar = $result->rowCount();
                  if ($contar > 0) {
                    while ($mostra = $result->FETCH(PDO::FETCH_OBJ)) {
              ?>
                    <tr>
                      <td><?php echo $contagem++; ?></td>
                      <td> <?php echo $mostra->titulo; ?> </td>
                      <td> <?php echo $mostra->data; ?> </td>
                      <td> <?php echo limitarTexto($mostra->descricao, $limite = 200) ?> </td>
                      <td><a href="home.php?acao=editar-postagem&id=<?php echo $mostra->id; ?>" ></a>

                        <a href="home.php?delete=<?php echo $mostra->id; ?>" onClick="return confirm('Deseja realmente excluir o post?')"></a></td>
                    </tr>
              <?php
                    }
                  }
                  else {
                    echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Aviso!</strong> Não há post cadastrado em nosso banco de dados.
                  </div>';
                  }
                }
                catch (PDOException $e) {
                  echo $e;
                }
              ?>


            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>
</div>
</div>