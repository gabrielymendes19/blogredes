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
                        $categoria = trim(strip_tags($_POST['categoria']));
                        $conteudo = trim(strip_tags($_POST['conteudo']));
                        $insert = "INSERT into posts (titulo, data, categoria, conteudo) VALUES (:titulo, :data, :categoria, :conteudo)";
                        try {
                            $result = $conexao->prepare($insert);
                            $result->bindParam(':titulo', $titulo, PDO::PARAM_STR);
                            $result->bindParam(':data', $data, PDO::PARAM_STR);
                            $result->bindParam(':categoria', $categoria, PDO::PARAM_STR);
                            $result->bindParam(':conteudo', $conteudo, PDO::PARAM_STR);
                            $result->execute();
                            $contar = $result->rowCount();

                            if ($contar > 0) {
                                echo '<strong>Sucesso!</strong>A postagem foi cadastrada no banco de dados. Voltando para área administrativa.';
                                header("Refresh: 2, home.php?acao=welcome");
                            }
                            else {
                                echo '<strong>Erro ao cadastrar a postagem!</strong>';
                            }
                        }
                        catch (PDOException $e) {
                            echo $e;
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
                            <label>Categoria</label>
                            <div>
                                <select id="categoria" name="categoria">
                                    <option >Selecione a categoria da sua postagem</option>
                                    <option>Antenada e Maquinada</option>
                                    <option>Auxílio Socioeconômico</option>
                                    <option>Calouro</option>
                                    <option>CAREDES</option>
                                    <option>Concessão de Créditos em Língua Estrangeira</option>
                                    <option>Divulgação de Materiais de Estudo, de Serviços e de Produtos</option>
                                    <option>EngNet</option>
                                    <option>Matérias</option>
                                    <option>Oportunidades de estágio</option>
                                    <option>SIGAA</option>
                                </select>
                            </div>
                        </div> 
                        <div>											
                            <label>Conteúdo</label>
                            <div>
                                <textarea id="conteudo" name="conteudo" value=""></textarea>
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