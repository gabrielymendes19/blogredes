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
                <th>Categoria</th>
                <th> Resumo</th>
                <th> </th>
              </tr>
            </thead>
            <tbody>
              <?php
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
                      <td> <?php echo $mostra->categoria; ?> </td>
                      <td> <?php echo limitarTexto($mostra->descricao, $limite = 200); ?> </td>
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