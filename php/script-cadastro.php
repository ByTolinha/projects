<?php
	require('../conecta.php');
	$nome = $_POST['nome'];
	$login = $_POST['log-cadastro'];
	$senha = $_POST['pass-cadastro'];
	$imagem = $_POST['img'];

    $stmt = $conn->prepare('SELECT * FROM usuario WHERE ds_login = :login');
    $stmt->bindValue("login", $login);
    $stmt->execute();

  if ($stmt->rowCount() > 0) {
    echo "<div class='alert alert-warning alert-dimissible fade show container pt-3 mt-5 col-sm-4' role='alert'>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          <strong>Ops, houve um problema!</strong><br>Esse login já está em uso!
          </div>";
  }else{

	try{
		$stmt = $conn->prepare('INSERT INTO usuario(nm_user,ds_login,ds_senha,ds_imagem) VALUES (:nome,:login,:senha,:imagem)');
		$stmt->execute(array(
			':nome' => $nome,
			':login' => $login,
			':senha' => $senha,
			':imagem' => $imagem,
		));

		$listagem = $conn->prepare("SELECT * FROM usuario where ds_login = :login");
		$listagem->bindValue("login", $login);
		$listagem->execute();
		$lista = $listagem->fetch(PDO::FETCH_ASSOC);
		session_start();
		$_SESSION['login'] = $login;
		$_SESSION['cd'] = $lista['cd_usuario'];
		echo "<meta HTTP-EQUIV='refresh' CONTENT='1'>";

	}catch(PDOException $e){
		echo 'Error: ' . $e->getMessage();
	}
}
?>