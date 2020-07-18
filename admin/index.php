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
    <title>Login - Blog de Redes</title>

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
				<a href="index.php">
					Login - Blog de Redes			
				</a>		
				<div>
					<ul>
						<li class="">						
							<a href="../" class="">
								Acessar o site
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div> 
	</div>
	<?php

	if(isset($_GET['acao'])){
		if(!isset($_POST['logar'])){
			$acao = $_GET['acao'];
			if($acao=='negado'){
				echo '<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<strong>Erro ao acessar!</strong> Você precisa estar logado.
						</div>';	
			}
		}
	}



	//se clickar em logar
	if(isset($_POST['logar'])) {
		//recuperar dados form 
		$usuario = trim(strip_tags($_POST['usuario']));
		$senha = trim(strip_tags($_POST['senha'])); //entre aspas simples eh o atributo name do codigo html

		//selecionar banco de dados
		$select = "SELECT * from login WHERE BINARY usuario=:usuario AND BINARY senha=:senha"; //BINARY serve para diferenciar maiusculas de minusculas
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
				echo '<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Logado com Sucesso!</strong> Redirecionando para a página inicial.
				</div>';
				header("Refresh: 2, home.php?acao=welcome");
			}
			else {
				echo '<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Erro ao logar!</strong> Os dados estão incorretos.
				</div>';
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
		
			<h1>Faça seu Login</h1>		
			
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
		
	</div> 
	
</div>


<script src="js/jquery-1.7.2.min.js"></script>

<script src="js/signin.js"></script>

</body>

</html>