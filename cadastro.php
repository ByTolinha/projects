<?php
	session_start();
	if (isset($_SESSION['login'])) {
		header("location:./php/menu-user.php");
	}
	else{
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="./js/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
	<script type="text/javascript" src="./css/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<title></title>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#enviar").click(function(){
  			$.ajax({
  				url: "./php/script-cadastro.php",
  				type: "POST",
  				data: "nome="+$("#nome").val()+"&log-cadastro="+$("#log-cadastro").val()+"&pass-cadastro="+$("#pass-cadastro").val()+"&img="+$("#img").val(),
  				dataType: "html"
  			}).done(function(resposta) {
	    $("p").html(resposta);

		}).fail(function(jqXHR, textStatus ) {
	    console.log("Request failed: " + textStatus);

		}).always(function() {
	    console.log("completou");
		});
  			});
				});
	</script>
</head>
<body>
	<div class="container">
		<div class="box col-sm-4 font-monospace bg-dark" id="cadastro-box">
		<div class="header-login ">
			<h4>Faça seu cadastro!</h4>
		</div>
		<label>Escolha seu apelido:</label>
		<input class="form-control" type="text" id="nome">
		<label>Informe seu login:</label>
		<input class="form-control" type="text" id="log-cadastro">
		<label>Crie sua senha:</label>
		<input class="form-control" type="password" id="pass-cadastro">
		<label>Insira uma Imagem para seu perfil:</label>
		<input class="form-control" type="text" id="img">
		<div class="footer-login">
			<button class="btn btn-warning mt-3 col-6" id="enviar">Cadastrar</button>
			<hr>
			<p>Se já possui um login, <a href="index.php"> Clique aqui!</a></p>
		</div>
	</div>
	</div>
	<p></p>
</body>
</html>
<?php 
	}
?>