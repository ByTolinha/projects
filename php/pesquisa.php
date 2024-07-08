<?php
	require('../conecta.php');

 	if (!isset($_GET['pesquisar'])) {
		header("Location: menu-user.php");
		exit;
	}
 
	$dados = "%".trim($_GET['pesquisar'])."%";
  
	$sql = $conn->prepare('SELECT * FROM produto WHERE nm_produto LIKE :nome');
	$sql->bindParam(':nome', $dados, PDO::PARAM_STR);
	$sql->execute();
 
	$resultados = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Campo de pesquisa</title>
	<script src="../js/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
	<script type="text/javascript" src="../css/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/style.css">

	<svg xmlns="http://www.w3.org/2000/svg" style="display: none;"><symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol></svg>

</head>
<body>

		<nav class="navbar bg-dark p-2">

		<button class="btn btn-warning font-monospace" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop"
		>Abrir Lateral</button>

		<div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
  			<div class="offcanvas-header bg-dark">
    			<h5 class="offcanvas-title" id="staticBackdropLabel">Menu</h5>
    			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  			</div>

  			<div class="offcanvas-body bg-warning">
  				<div class="btn-group-vertical col-12">
  					<a class="btn btn-warning font-monospace menu" href="perfil-user.php">Meu perfil</a>
  					<a class="btn btn-warning font-monospace menu">Meu Carrinho</a>
  					<a class="btn btn-warning font-monospace menu">Categorias</a>
  					<a class="btn btn-warning font-monospace menu" href="menu-user.php">Menu principal</a>
  				</div>
  			</div>
  			<div class="offcanvas-footer">

  			</div>
  		</div>

  			<form method="get" action="pesquisa.php">
  				<div class="container input-group mt-2 mb-2">
  					<input type="search" name="pesquisar" id="pesquisar" placeholder="Pesquisar" class="form-control">
  					<button name="busca" class="btn btn-warning" id="busca"><img class="mb-1" id="icone-lupa" src="../css/procurar.png"></img>
  					</button>
  				</div>
  			</form>

			
		<?php
			session_start();
			if (isset($_SESSION['nivel'])) {
		?>
			<a class="btn btn-warning font-monospace" href="cadastrar-categoria.php">Cadastrar +</a>
		<?php
			}else{

			}
			
		?>
	</nav>

	<?php
		if (count($resultados)) {
			echo "<label class='p-2 mt-3'><small>Resultado da busca:</small></label><hr>";
			foreach($resultados as $Resultado) {
	?>
	<div class="card">
		<img class="card-img-top img-thumbinal" src="<?php echo $Resultado['ds_imagem'] ?>">
		<label><h5><?php echo $Resultado['nm_produto']; ?></h5></label>
		<label><?php echo $Resultado['ds_produto']; ?></label>
	</div>
	<br>

	<?php
			} 
		} else {
	?>
	<hr>
	<div class="row mt-3 mx-3">
	<div class="alert alert-warning d-flex align-items-center" role="alert">
  		<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  		<div>
    		<label>Não foram encontrados resultados pelo termo buscado.</label>
  		</div>
	</div>
	</div>

	<?php
		}
	?>

</body>
</html>