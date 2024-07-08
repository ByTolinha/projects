<?php 
	$nome = uniqid('img_');
	$diretorio = '../img/';
	$endereco = $diretorio . $nome;
	foreach ($_FILES as $value) {
		move_uploaded_file($value["tmp_name"], $endereco. $value['imagem']);
	}

	try{
		require('../conecta.php');
		$stmt = $conn->prepare('INSERT INTO produto(nm_produto,dt_fabricacao,ds_imagem,ds_produto,dt_vencimento,id_categoria) VALUES (:nm,:dtfab,:dsimg,:dspro,:dtven,:idc)');
		$stmt->execute(array(
			':nm' => $_POST['produto'],
			':dtfab' => $_POST['fabricacao'],
			':dsimg' => $nome,
			':dspro' => $_POST['descricao'],
			':dtven' => $_POST['vencimento'],
			':idc' => $_POST['idc'],
		));
		
	} catch (Exception $e) {
		echo 'Error: ' . $e->getMessage();
	}
?>