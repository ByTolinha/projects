<?php
	require('../conecta.php');

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<script src="../js/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
	<script type="text/javascript" src="../css/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
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
			<a id="Enviar" class="btn btn-warning font-monospace" href="cadastrar-categoria.php">Cadastrar +</a>
			<?php
			}else{

			}
			
			?>
	</nav>

		<div class="container-fluid">
					
			<div class="card-group">
					<?php
			require('../conecta.php');
			$listagem = $conn->prepare('SELECT * FROM produto');
			$listagem->execute();
			while($lista = $listagem->fetch(PDO::FETCH_ASSOC)){
		?>

				<div class="card">
					<div class="card-header"><img class="img-fluid"><?php echo $lista['ds_imagem'];?></img></div>
					<div class="card-body">
						<h5><?php echo $lista['nm_produto'];?></h5>
						<label><?php echo $lista['ds_produto'];?></label>
					</div>
					<div class="card-footer"><button class="btn btn-primary">Adicionar no carrinho</button></div>
				</div>
				<?php 
					}
				?>
			</div>

		</div>
		

</body>

</html>