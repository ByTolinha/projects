<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Acesso Admin</title>
	<script src="../js/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
	<script type="text/javascript" src="../css/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/style.css">

	<script type="text/javascript">
		$(document).ready(function(){
  		$("#enviar").click(function(){
  			$.ajax({
  				url: "script-categoria.php",
  				type: "POST",
  				data: "categoria="+$("#categoria").val(),
  				dataType: "html"
  			}).done(function(resposta) {
	    $("#p").html(resposta);

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
	<nav class="navbar navbar-dark bg-dark p-2">
		<button type="button" class="btn btn-warning font-monospace" data-bs-toggle="modal" data-bs-target="#exampleModal">
  			Adicione uma categoria
		</button>

		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header bg-dark">
        				<h1 class="modal-title fs-5 font-monospace" id="exampleModalLabel">Nova Categoria</h1>
        				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      				</div>
      					<div class="modal-body bg-warning font-monospace">
      						<h6>Qual o nome da sua nova categoria?<h6>
      							<hr>
        					<input type="text" class="form-control" placeholder="Digite aqui..." id="categoria">
      					</div>
      				<div class="modal-footer bg-dark">
        				<button type="button" class="btn btn-secondary font-monospace" data-bs-dismiss="modal">Fechar</button>
        				<button type="button" class="btn btn-warning font-monospace" id="enviar">Adicionar</button>
      				</div>
    			</div>
  			</div>
		</div>
	</nav>
	<p id="p"></p>

	<div class="table-responsive">
	<table class="table table-bordered ">
		<thead>
		<tr class="bg-dark font-monospace">
			<th scope="col">CD</th>
			<th scope="col">Nome</th>
			<th></th>
		</tr>
		</thead>

		 	<?php 
		 		try{
		 		require('../conecta.php');
		 		$listagem = $conn->prepare("SELECT * FROM categoria");
		 		$listagem->execute();
		 		while($lista = $listagem->fetch(PDO::FETCH_ASSOC)){
		 	?>

		 <tbody>
				<tr class="bg-warning font-monospace">
					<td><?php echo $lista['cd'];?></td>
					<td><?php echo $lista['nm_categoria'];?></td>
					<td><a class="btn btn-danger" id="delete" href="delete.php?tb=categoria&&cd=<?php echo $lista['cd']?>">Delete</a>
						<a class="btn btn-success" href="update-categoria.php?tb=categoria&&cd=<?php echo $lista['cd']?>">Editar</a></td>
				</tr>
		</tbody>

			<?php 
					}
				} catch(PDOExcepition $e){

		 			}
			?>
	</table>
</div>
	<div class="p-2">
		<a class="btn btn-warning mt-3 p-2 font-monospace" href="cadastrar-produtos.php">Avançar</a>
	</div>
</body>
</html>