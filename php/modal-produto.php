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

		<script type="text/javascript">
		$(document).ready(function(){
  		$("#edite").click(function(){
  			$.ajax({
  				url: "modal-produto.php",
  				type: "POST",
  				data: "produto="+$("#produto").val()+"&fabricacao="+$("#fabricacao").val()+"&imagem="+$("#imagem")+"&descricao="+$("#descricao").val()+"&vencimento="+$("#vencimento").val()+"&idc="+$("#idc").val(),
  				dataType: "html"
  			}).done(function(resposta) {
	    $("input").html(resposta);

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
	<button id="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-edicao">Editar</button>

	<div class="modal fade" id="modal-edicao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	<?php
	require('../conecta.php');
	if (isset($_POST['cd'])){
	$cd = $_POST['cd'];
	$tb = $_POST['tb'];

	$sql = "SELECT * FROM $tb WHERE cd = :cd";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':cd',$cd);
	$result = $stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

		}
	?>
			<div class="input">
			<label>Nome do produto:</label>
		<input type="text" class="form-control" id="produto" value="<?php echo ($rows[0]['nm_produto']); ?>">
			</div>
			<div class="input">
			<label>Data de Fabricação:</label>
		<input type="date" class="form-control" id="fabricacao" value="<?php echo ($rows[0]['dt_fabricacao']);?>">
			</div>
			<div class="input">
			<label>Imagem:</label>
		<input type="text" class="form-control" id="imagem" value="<?php echo ($rows[0]['ds_imagem']);?>">
			</div>
			<div class="input">
			<label>Descreva seu produto:</label>
		<input type="text" class="form-control" id="descricao" value="<?php echo ($rows[0]['ds_produto']);?>">
			</div>
			<div class="input">
			<label>Data de Vencimento:</label>
		<input type="date" class="form-control" id="vencimento" value="<?php echo ($rows[0]['dt_vencimento']);?>">
			</div>
			<div class="input">
			<label>ID Categoria:</label>
		<select id="idc" class="form-control">
<?php  
				$id = $rows[0]['id_categoria'];
				$categoria = $conn->prepare("SELECT * FROM categoria WHERE cd = :id");
		 		$categoria->bindValue(':id', $id);
		 		$categoria->execute();
		 		$cate = $categoria->fetch(PDO::FETCH_ASSOC);

?>
        	<option><?php echo $cate['nm_categoria'];?></option>
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
		<button class="btn btn-warning font-monospace mt-3" id="edite" name="edite">Atualizar</button>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
	<?php

	if (isset($_POST["edite"])) {
		//var_dump($cd);

		$nome = $_POST['produto'];
		$fab = $_POST['fabricacao'];
		$img = $_POST['imagem'];
		$ds = $_POST['descricao'];
		$ven = $_POST['vencimento'];
		$cat = $_POST['idc'];

	$update = "UPDATE produto SET nm_produto = :nm, dt_fabricacao = :fab, ds_imagem = :img, ds_produto = :ds, dt_vencimento = :ven, id_categoria = :idc WHERE cd = :cd";
	$update = $conn->prepare($update);

	$update->bindParam(':cd',$cd);
	$update->bindParam(':nm',$nome);
	$update->bindParam(':fab',$fab);
	$update->bindParam(':img',$img);
	$update->bindParam(':ds',$ds);
	$update->bindParam(':ven',$ven);
	$update->bindParam(':idc',$cat);

	$resultup = $update->execute();

	if (!$resultup) {
		var_dump($update->errorInfo());
		exit;
	} else{
		echo $update->rowCount() . "Atualizado com sucesso!";
		header(sprintf('location: %s', $_SERVER['HTTP_REFERER']));

	}
	}
?>

</body>
</html>