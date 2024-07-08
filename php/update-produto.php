<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../js/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
	<script type="text/javascript" src="../css/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<title></title>
</head>
<body>
	<nav class="navbar bg-dark">
		<h2>oi</h2>
	</nav>
	<?php
	require('../conecta.php');
	if (isset($_GET['cd'])){
	$cd = $_GET['cd'];
	$tb = $_GET['tb'];

	$sql = "SELECT * FROM $tb WHERE cd = :cd";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':cd',$cd);
	$result = $stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

		}
	?>
	<div class="container">
		<div class="box-update font-monospace bg-dark col-sm-4">
		<form method="POST">
			<div class="input">
			<label>Nome do produto:</label>
		<input type="text" class="form-control" name="produto" value="<?php echo ($rows[0]['nm_produto']); ?>">
			</div>
			<div class="input">
			<label>Data de Fabricação:</label>
		<input type="date" class="form-control" name="fabricacao" value="<?php echo ($rows[0]['dt_fabricacao']);?>">
			</div>
			<div class="input">
			<label>Imagem:</label>
		<input type="text" class="form-control" name="imagem" value="<?php echo ($rows[0]['ds_imagem']);?>">
			</div>
			<div class="input">
			<label>Descreva seu produto:</label>
		<input type="text" class="form-control" name="ds" value="<?php echo ($rows[0]['ds_produto']);?>">
			</div>
			<div class="input">
			<label>Data de Vencimento:</label>
		<input type="date" class="form-control" name="vencimento" value="<?php echo ($rows[0]['dt_vencimento']);?>">
			</div>
			<div class="input">
			<label>ID Categoria:</label>
		<select name="categoria" class="form-control">
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
		<input type="submit" class="btn btn-warning font-monospace mt-3" name="edite" name="edite" value="Atualizar">
		</form>
	</div>
	</div>

</body>
</html>

<?php

	if (isset($_POST["edite"])) {
		//var_dump($cd);

		$nome = $_POST['produto'];
		$fab = $_POST['fabricacao'];
		$img = $_POST['imagem'];
		$ds = $_POST['ds'];
		$ven = $_POST['vencimento'];
		$cat = $_POST['categoria'];

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
		header('location:cadastrar-produtos.php');
	}
	}
?>
