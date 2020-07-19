<div>
    <div>
        <div>
            <div>
                <div class="span 12">
                    <div>
                        <div>
                            <h3>Visualizar Posts</h3>
                        </div>
                        <div>
                            <table>
                                <thead>
                                    <tr>
                                        <th> Nº</th>
                                        <th> Título da Postagem </th>
                                        <th> Data</th>
                                        <th>Categoria</th>
                                        <th>Imagem</th>
                                        <th>Exibição</th>
                                        <th> Resumo</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        include("functions/limita-texto.php");
                                        if (empty($_GET['pg'])) {

                                        }
                                        else {
                                            $pg = $_GET['pg'];
                                        }
                                        if (isset($pg)) {
                                            $pg = $_GET['pg'];
                                        }
                                        else {
                                            $pg = 1;
                                        }
                                        $quantidade = 1;
                                        $inicio = ($pg*$quantidade) - $quantidade;
                                        $select = "SELECT * from tb_postagens ORDER BY id DESC LIMIT $inicio, $quantidade";
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
                                                    <td><img src="../upload/postagens/<?php echo $mostra->imagem; ?>" width="50"></td>
                                                    <td><?php echo $mostra->exibir; ?></td>
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
                                                    <strong>Aviso!</strong> Não há post cadastrado em nosso banco de dados ou a página não existe.
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
                        <!--inicio botoes paginacao-->
                        <?php
                            $sql = "SELECT * from tb_postagens";
                            try {
                                $result = $conexao->prepare($sql);
                                $result->execute();
                                $totalRegistros = $result->rowCount();
                            }
                            catch (PDOException $e) {
                                echo $e;
                            }
                            if ($totalRegistros <= $quantidade) {
                                
                            }
                            else {
                                $paginas = ceil($totalRegistros/$quantidade);
                                $links = 5;
                                if (isset($i)) {

                                }
                                else {
                                    $i = '1';
                                }
                        ?>

                        <div class="paginas">
                                <a href="home.php?acao=ver-postagens&pg=1">Primeira Página</a>
                                <?php
                                    if (isset($_GET['pg'])) {
                                        $num_pg = $_GET['pg'];
                                    }
                                    for ($i = $pg - $links; $i <= $pg - 1 ; $i++) {
                                        if ($i <= 0) {

                                        }
                                        else {
                                ?>
                                <a href="home.php?acao=ver-postagens&pg=<?php echo $i; ?>" class="ativo"><?php echo $i; ?></a>
                                <?php
                                        }
                                    }
                                ?>
                                <a href="#" class="ativo"><?php echo $pg ?></a>

                        </div> <!--paginas-->
                        
                        <?php
                            }

                        ?>
                        <!--fim botoes paginacao-->
                    </div>
                </div> <!-- span 12-->
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