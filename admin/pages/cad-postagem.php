<script type="text/javascript">
    jQuery(function($){
        $("#date").mask("99/99/9999", {placeholder: "dd/mm/yyyy"});
    });
</script>

<div>
    <div>
        <div>
            <div>
                <h3>Cadastrar postagem</h3>
            </div>
            <div>
                <?php
                    if(isset($_POST['cadastrar'])) {
                        $titulo = trim(strip_tags($_POST['titulo']));
                        $data = trim(strip_tags($_POST['data']));
                        $exibir = trim(strip_tags($_POST['exibir']));
                        $descricao = trim(strip_tags($_POST['descricao']));
                        //INFO IMAGEM
                        $file 		= $_FILES['img'];
                        $numFile	= count(array_filter($file['name']));
                        
                        //PASTA
                        $folder		= '../upload/postagens/';
                        
                        //REQUISITOS
                        $permite 	= array('image/jpeg', 'image/png');
                        $maxSize	= 1024 * 1024 * 1;
                        
                        //MENSAGENS
                        $msg		= array();
                        $errorMsg	= array(
                            1 => 'O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini.',
                            2 => 'O arquivo ultrapassa o limite de tamanho em MAX_FILE_SIZE que foi especificado no formulário HTML',
                            3 => 'o upload do arquivo foi feito parcialmente',
                            4 => 'Não foi feito o upload do arquivo'
                        );
                        
                        if($numFile <= 0){
                            echo '<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        Selecione uma imagem e tente novamente
                                    </div>';
                        }
                        else if($numFile > 1){
                            echo '<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        Você ultrapassou o limite de upload. Selecione apenas uma imagem
                                    </div>';
                        }else{
                            for($i = 0; $i < $numFile; $i++){
                                $name 	= $file['name'][$i];
                                $type	= $file['type'][$i];
                                $size	= $file['size'][$i];
                                $error	= $file['error'][$i];
                                $tmp	= $file['tmp_name'][$i];
                                
                                $extensao = @end(explode('.', $name));
                                $novoNome = rand().".$extensao";
                                
                                if($error != 0)
                                    $msg[] = "<b>$name :</b> ".$errorMsg[$error];
                                else if(!in_array($type, $permite))
                                    $msg[] = "<b>$name :</b> Erro imagem não suportada!";
                                else if($size > $maxSize)
                                    $msg[] = "<b>$name :</b> Erro imagem ultrapassa o limite de 1MB";
                                else{
                                    
                                    if(move_uploaded_file($tmp, $folder.'/'.$novoNome)){
                                        //$msg[] = "<b>$name :</b> Upload Realizado com Sucesso!";
                                        $insert = "INSERT into tb_postagens (titulo, data, imagem, exibir, descricao) VALUES (:titulo, :data, :imagem, :exibir, :descricao)";
                                        try {
                                            $result = $conexao->prepare($insert);
                                            $result->bindParam(':titulo', $titulo, PDO::PARAM_STR);
                                            $result->bindParam(':data', $data, PDO::PARAM_STR);
                                            $result->bindParam(':imagem', $novoNome, PDO::PARAM_STR);
                                            $result->bindParam(':exibir', $exibir, PDO::PARAM_STR);
                                            $result->bindParam(':descricao', $descricao, PDO::PARAM_STR);
                                            $result->execute();
                                            $contar = $result->rowCount();

                                            if ($contar > 0) {
                                                echo '<div class="alert alert-success">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    <strong>Sucesso!</strong>A postagem foi cadastrada no banco de dados.
                                                </div>';
                                                header("Refresh: 2, home.php?acao=welcome");
                                            }
                                            else {
                                                echo '<div class="alert alert-danger">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    <strong>Erro ao fazer o cadastro!</strong>
                                                </div>';
                                            }
                                        }
                                        catch (PDOException $e) {
                                            echo $e;
                                        }
                                            
                                    }else
                                        $msg[] = "<b>$name :</b> Desculpe! Ocorreu um erro...";
                                
                                }
                                
                                foreach($msg as $pop)
                                echo $pop . '<br>';
                            }
                        }
                    }
                ?>
                <div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div>											
                            <label>Título da postagem</label>
                            <div>
                                <input type="text" id="titulo" name="titulo" value="">
                            </div>				
                        </div>
                        <div>											
                            <label>Data</label>
                            <div>
                                <input type="text" id="date" name="data" value="">
                            </div>				
                        </div> 
                        <div>											
                            <label>Imagem</label>
                            <div>
                                <input type="file" id="imagem" name="img[]" value="">
                            </div>				
                        </div>
                        <div>
                            <label>Exibir</label>
                            <div>
                                <select id="exibir" name="exibir">
                                    <option>Sim</option>
                                    <option>Não</option>
                                </select>
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