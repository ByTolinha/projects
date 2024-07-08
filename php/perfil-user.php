<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../js/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
	<script type="text/javascript" src="../css/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<title>Meu Perfil</title>
</head>
<body>

	<div class="container" id="perfil-usuario">

		<?php
		require('../conecta.php');
		try{
			$listagem = $conn->prepare("SELECT * FROM usuario where cd_usuario = :cd");
			$listagem->bindValue("cd",$_SESSION['cd']);
			$listagem->execute();
			while ($lista = $listagem->fetch(PDO::FETCH_ASSOC)) {
	?>
	<div class="box col-sm-6 mt-5 bg-warning font-monospace">
	<div class="header">
				<div class="tittle"><h4>Configure seu perfil</h4></div>
	</div>
				<hr>
		
			<div class="body"> 

				<div class="row">
				<img src="https://th.bing.com/th?q=Imagens+Bizarras&w=120&h=120&c=1&rs=1&qlt=90&cb=1&pid=InlineBlock&mkt=pt-BR&cc=BR&setlang=pt-br&adlt=moderate&t=1&mw=247" class="img-thumbnail" style="width: 200px;">
				</div>
				<div class="row">
					<p>
						<?php echo $lista['nm_user'];?>
					</p>
					<p>
					Seu Login: <br>
					<?php echo $lista['ds_login'];?>
					</p>
					<p>
					Sua senha: <br>
					<?php echo $lista['ds_senha'];?>
					</p>
				</div>
		<?php
		}
	} catch(PDOExcepition $e){

	}
	?>
	</div>
	<div class="footer p-2">
		<button onclick="history.go(-1)" class="btn btn-dark">Voltar</button>
		<a class="btn btn-dark" href="logout.php">Sair da Conta</a>
	</div>
</div>
</div>
</div>
</body>
</html>