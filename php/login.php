<?php 
	
	$login = $_POST['login'];
	$senha = $_POST['senha'];

	require('../conecta.php');

	$stmt = $conn->prepare('SELECT * FROM usuario where ds_login = :login AND ds_senha = :senha');
	$stmt->bindValue("login", $login);
	$stmt->bindValue("senha", $senha);
	$stmt->execute();

	if ($stmt-> rowCount() > 0) {
		$listagem = $conn->prepare("SELECT * FROM usuario where ds_login = :login AND ds_senha = :senha ");
		$listagem->bindValue("login", $login);
		$listagem->bindValue("senha", $senha);
		$listagem->execute();
		$lista = $listagem->fetch(PDO::FETCH_ASSOC);
		session_start();
		if ($lista['id_usercat'] === 1) {
			if ($lista['id_usercat'] === 1) {
				$_SESSION['nivel'] = $lista['id_usercat'];

			}
		}
		$_SESSION['login'] = $login;
		$_SESSION['cd'] = $lista['cd_usuario'];
		echo "<meta HTTP-EQUIV='refresh' CONTENT='1'>";
		}
		else{
			echo "Ops, está errado! Tente novamente ou faça seu cadastro.";
		}


?>