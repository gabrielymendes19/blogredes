<div class="well well-sm">
    <?php
        $host = "localhost";
        $login = "root";
        $senha = "";
        
        $conecta = mysqli_connect($host, $login, $senha) or print (mysqli_error());
        $seleciona = mysqli_query($conecta, "SELECT * FROM posts ORDER BY id DESC");
        $conta = mysqli_num_rows($seleciona);

        if ($conta <= 0) {
            echo "nenhuma postagem cadastrada no banco de dados";
        }
        else {
            while ($row = mysqli_fetch_array($seleciona)) {
                $id = $row['id'];
                $titulo = $row['titulo'];
                $descricao = $row['descricao'];
                $imagem = $row['imagem'];
                $data = $row['data'];
                $hora = $row['hora'];
                $postador = $row['postador'];
                $sql = "SELECT * FROM usuarios WHERE usuario = '$postador'";
                $query = mysqli_query($conecta, $sql);
                $linha = mysqli_fetch_assoc($query);
            }
        }
    ?>
</div>