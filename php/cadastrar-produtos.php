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
  			var imagem = new FormData();
			imagem.append('file', $('#imagem'));
  			$.ajax({
  				url: "script-produtos.php",
  				type: "POST",
  				data: "produto="+$("#produto").val()+"&fabricacao="+$("#fabricacao").val()+"&imagem="+$("#imagem")+"&descricao="+$("#descricao").val()+"&vencimento="+$("#vencimento").val()+"&idc="+$("#idc").val(),
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
	<nav class="navbar navbar bg-dark p-2">
		<button type="button" class="btn btn-warning font-monospace" data-bs-toggle="modal" data-bs-target="#exampleModal">
  			Adicione um Produto
		</button>

		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header bg-dark font-monospace">
        				<h1 class="modal-title fs-5 font-monospace" id="exampleModalLabel">Novo Produto</h1>
        				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      				</div>
      					<div class="modal-body bg-warning font-monospace">
      						Nome:<br>
        					<input type="text" class="form-control" placeholder="Qual o nome do seu produto?" id="produto">
        					Data de Fabricação:<br>
        					<input type="date" class="form-control" id="fabricacao">
        					Imagem do Produto:<br>
        					<input type="file" class="form-control" id="imagem">
        					Descrição do produto:<br>
        					<input type="text" class="form-control" placeholder="Descreva seu produto aqui..." id="descricao">
        					Data de Vencimento:<br>
        					<input type="date" class="form-control" id="vencimento">

        					Categoria do Produto:<br>
        					<select id="idc" class="form-control">
        						<option>Selecione a Categoriado seu produto</option>
        					<?php
        							require('../conecta.php');
        							$listagem = $conn->prepare('SELECT * FROM categoria');
        							$listagem->execute();
        							while($lista = $listagem->fetch(PDO::FETCH_ASSOC)){
        					?>
        						<option value="<?php echo $lista['cd']?>"><?php echo $lista['nm_categoria']?></option>
        						<?php 
        							}
        						?>
        					</select>

      					</div>
      				<div class="modal-footer font-monospace bg-dark">
        				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        				<button type="button" class="btn btn-warning" id="enviar">Adicionar</button>
      				</div>
    			</div>
  			</div>
		</div>
	</nav>
	<p id="p"></p>

<div class="table-responsive">
	<table class="table table-bordered">
		<tr class="bg-dark font-monospace">
			<th>CD</th>
			<th>Nome</th>
			<th>Data de Fabricação</th>
			<th>Imagem</th>
			<th>Descrição</th>
			<th>Vencimento</th>
			<th>Categoria</th>
			<th></th>
		</tr>

		 <?php 
		 	try{
		 		require('../conecta.php');
		 		$listagem = $conn->prepare("SELECT * FROM produto");
		 		$listagem->execute();
		 		while($lista = $listagem->fetch(PDO::FETCH_ASSOC)){
		 ?>
		<tr class="bg-warning font-monospace">
			<td><?php echo $lista['cd'];?></td>
			<td><?php echo $lista['nm_produto'];?></td>
			<td><?php echo $lista['dt_fabricacao'];?></td>
			<td><?php echo $lista['ds_imagem'];?></td>
			<td><?php echo $lista['ds_produto'];?></td>
			<td><?php echo $lista['dt_vencimento'];?></td>
<?php  
				$id = $lista['id_categoria'];
				$categoria = $conn->prepare("SELECT * FROM categoria WHERE cd = :id");
		 		$categoria->bindValue(':id', $id);
		 		$categoria->execute();
		 		$cate = $categoria->fetch(PDO::FETCH_ASSOC);
?>
			<td><?php echo $cate['nm_categoria'];?></td>
			<td><a class="btn btn-danger" href="delete.php?tb=produto&&cd=<?php echo $lista['cd']?>">Delete</a>
			<a class="btn btn-success" href="update-produto.php?tb=produto&&cd=<?php echo $lista['cd']?>">Editar</a>
			</td>
		</tr>

		<?php 
			}
		} catch(PDOExcepition $e){
			echo 'ERROR: ' . $e->getMessage();
		 	}
		?>

		
	</table>
</div>
	<div class="font-monospace p-2">
		<a class="btn btn-warning mt-3" href="cadastrar-categoria.php">Voltar</a>
		<a class="btn btn-warning mt-3" href="menu-user.php">Voltar para o Menu</a>
	</div>
</body>
</html>
