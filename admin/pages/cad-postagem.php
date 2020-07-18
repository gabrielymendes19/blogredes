<div>
    <div>
        <div>
            <div>
                <h3>Cadastrar postagem</h3>
            </div>
            <div>
                <div>
                    <form action="" method="post">
                        <div>											
                            <label>Título da postagem</label>
                            <div>
                                <input type="text" id="titulo" name="titulo" value="">
                            </div>				
                        </div>
                        <div>											
                            <label>Data</label>
                            <div>
                                <input type="text" id="data" name="data" value="">
                            </div>				
                        </div> 
                        <div>											
                            <label>Imagem</label>
                            <div>
                                <input type="file" id="imagem" name="imagem" value="">
                            </div>				
                        </div>
                        <div>											
                            <label>Descrição</label>
                            <div>
                                <textarea id="descricao" name="descricao" value=""></textarea>
                            </div>				
                        </div>
                        <div>
                            <input type="submit" name="cadastrar" value="Cadastrar"> 
                            <input type="reset" value="Cancelar">
                        </div>
                    </form>
                </div>
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