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
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Blog de Redes - Sistema de Postagem</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
                rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/pages/dashboard.css" rel="stylesheet">