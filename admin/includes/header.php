<?php
    ob_start();
	session_start();
	if(!isset($_SESSION['usuarioblog']) && (!isset($_SESSION['senhablog']))){ //se nao iniciou a sessao, impossivel acessar home.php
		header("Location: index.php?acao=negado");exit;
	}
    include("conexao/conecta.php");
    include("includes/logout.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Blog de Redes - Sistema de Postagem</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">

        <script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
        <script src="js/jquery.maskedinput.js" type="text/javascript"></script>