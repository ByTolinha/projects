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
		<div class="box font-monospace bg-dark col-sm-4">
		<form method="POST">
			<div class="input">
			<label>Nome da categoria:</label>
		<input type="text" class="form-control" name="categoria" value="<?php echo ($rows[0]['nm_categoria']); ?>">
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

		$nome = $_POST['categoria'];

	$update = "UPDATE categoria SET nm_categoria = :nm WHERE cd = :cd";
	$update = $conn->prepare($update);

	$update->bindParam(':cd',$cd);
	$update->bindParam(':nm',$nome);

	$resultup = $update->execute();

	if (!$resultup) {
		var_dump($update->errorInfo());
		exit;
	} else{
		echo $update->rowCount() . "Atualizado com sucesso!";
		header('location:cadastrar-categoria.php');
	}
	}
?>
