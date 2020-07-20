<?php
	ob_start();
	session_start();
	if(isset($_SESSION['usuarioblog']) && (isset($_SESSION['senhablog']))){ //se ja iniciou a sessao, impossivel acessar index.php
		header("Location: home.php");exit;
	}
	include("conexao/conecta.php");
?>
<!DOCTYPE html>
<html lang="br">
  
<head>
    <meta charset="utf-8">
    <title>Tela de Login</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 

</head>

<body>
	
	<div>
		<div>
			<div>
				<a data-toggle="collapse" data-target=".nav-collapse">
					<span></span>
					<span></span>
					<span></span>
				</a>
				<h1>
					Tela de Login			
				</h1>		
				<p>Para cadastrar postagens no blog, é necessário fazer login. Caso não tenha uma conta, faça o cadastro.</p>
				<p>
					Para visualizar as postagens diretamente no blog, <a href="../">clique aqui.</a>
				</p>
			</div>
		</div> 
	</div>
	<?php

	if(isset($_GET['acao'])){
		if(!isset($_POST['logar'])){
			$acao = $_GET['acao'];
			if($acao=='negado'){
				echo '<strong>Acesso negado!</strong> Você precisa estar logado.';	
			}
		}
	}



	//se clickar em logar
	if(isset($_POST['logar'])) {
		//recuperar dados form 
		$usuario = trim(strip_tags($_POST['usuario']));
		$senha = trim(strip_tags($_POST['senha'])); //entre aspas simples eh o atributo name do codigo html

		//selecionar banco de dados
		$select = "SELECT * from usuarios WHERE BINARY usuario=:usuario AND BINARY senha=:senha"; //BINARY serve para diferenciar maiusculas de minusculas
		try {
			$result = $conexao->prepare($select);
			$result->bindParam(':usuario', $usuario, PDO::PARAM_STR);
			$result->bindParam(':senha', $senha, PDO::PARAM_STR);
			$result->execute();
			$contar = $result->rowCount();

			if ($contar > 0) {
				$usuario = $_POST['usuario'];
				$senha= $_POST['senha'];
				$_SESSION['usuarioblog'] = $usuario; 
				$_SESSION['senhablog'] = $senha;// o SESSION armazena o usuario e a senha digitada em 'usuarioblog' e 'senhablog', respectivamente
				echo '<strong>Logado com Sucesso!</strong> Redirecionando para a página inicial.';
				header("Refresh: 2, home.php?acao=welcome");
			}
			else {
				echo '<strong>Erro ao logar!</strong> Os dados inseridos estão incorretos.';
			}
		}
		catch (PDOException $e) {
			echo $e;
		}
	}
	?>

<div>
	<div>
		<form action="#" method="post" enctype="multipart/form-data">
		
			<h2>Faça seu Login</h2>		
			
			<div>
				
				<p>Digite seu login e sua senha:</p>
				
				<div>
					<label for="username">Usuário:</label>
					<input type="text" id="username" name="usuario" value="" placeholder="Usuário"/>
				</div> 
				
				<div>
					<label for="password">Senha:</label>
					<input type="password" id="password" name="senha" value="" placeholder="Senha"/>
				</div> 
				
			</div>
			
			<div>
									
				<input type="submit" name="logar" value="Logar">
				
			</div> 
		</form>
		<p>Ainda não possui conta? <a href="index.php?acao=cad-usuario">Faça o cadastro aqui.</a></p>
		
	</div> 
	
</div>


<script src="js/jquery-1.7.2.min.js"></script>

<script src="js/signin.js"></script>

</body>

</html>