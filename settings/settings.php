<?php
    //dados do servidor
    $host = "localhost";
    $login = "root";
    $senha = "";

    //efetuando a conexao
    $conecta = mysqli_connect($host, $login, $senha) or print (mysqli_error());
    $banco = mysqli_select_db($conecta, 'blogredes') or print (mysqli_error());

    //verificacao
    if(!mysqli_connect($host, $login, $senha)) {
        echo "Erro ao conectar ao banco de dados";
    }
?>