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
	<title>Seu Login</title>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
	<script type="text/javascript" src="./css/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
	<script src="./js/jquery-3.6.0.min.js"></script>
		<link rel="stylesheet" type="text/css" href="./css/style.css">

	<script type="text/javascript">
		$(document).ready(function(){
  		$("#enviar").click(function(){
  			$.ajax({
  				url: "./php/login.php",
  				type: "POST",
  				data: "login="+$("#login").val()+"&senha="+$("#senha").val(),
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
		<div class="box bg-dark font-monospace">
		<div class="header-login">
			<h4>Efetue seu login para prosseguir!</h4>
		</div>
		<div class="col">
			<label>Login:</label>
			<input type="text" id="login" class="form-control" required>
			<label>Senha:</label>
			<input type="password" id="senha" class="form-control">
			<div class="footer-login">
			<button id="enviar" class="btn btn-warning mt-3 col-6">Entrar</button>
			<hr>
			<p>Se ainda não possui um cadastro, <a href="cadastro.php" style="text-decoration: none; color: gold;"> Clique aqui!</a></p>
			</div>
		</div>
		</div>
	</div>
	<p></p>

</body>
</html>

<?php 
	}
?>