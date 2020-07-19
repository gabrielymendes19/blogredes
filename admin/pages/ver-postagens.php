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
                                            if (!is_numeric($pg)) {
                                                echo '<script language="JavaScript">location.href="home.php?acao=ver-postagens";</script>';
                                            }
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
                                                    <td> <?php echo limitarTexto($mostra->descricao, $limite = 200); ?> </td>
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
                        <style>
                            <?php
                                if(isset($_GET['pg'])) {
                                    $num_pg = $_GET['pg'];
                                }
                                else {
                                    $num_pg = 1;
                                }
                            ?>
                            .paginas a.ativo<?php echo $num_pg; ?> {
                                background: red;
                                color: white;
                            }
                        </style>
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
                                if ($pg > $paginas) {
                                    echo '<script language="JavaScript">location.href="home.php?acao=ver-postagens";</script>';
                                }
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
                                <a href="home.php?acao=ver-postagens&pg=<?php echo $i; ?>" class="ativo<?php echo $i; ?>"><?php echo $i; ?></a>
                                <?php
                                        }
                                    }
                                ?>
                                <a href="home.php?acao=ver-postagens&pg=<?php echo $pg; ?>" class="ativo<?php echo $i; ?>"><?php echo $pg; ?></a>

                                <?php
                                    for($i = $pg + 1 ; $i <= $pg + $links ; $i++) {
                                        if($i > $paginas) {

                                        }
                                        else {
                                ?>

                                <a href="home.php?acao=ver-postagens&pg=<?php echo $i; ?>" class="ativo<?php echo $i; ?>"><?php echo $i; ?></a>

                                <?php            

                                        }
                                    }
                                ?>

                                <a href="home.php?acao=ver-postagens&pg=<?php echo $paginas; ?>">Última Página</a>  

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