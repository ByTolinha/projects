<?php
	try{
		require('../conecta.php');
		$stmt = $conn->prepare('INSERT INTO categoria(nm_categoria) VALUES (:cat)');
		$stmt->execute(array(
			':cat' => $_POST['categoria'] 
		));
		echo "<br>".$stmt->rowCount();

	} catch(PDOException $e) {
  		echo 'Error: ' . $e->getMessage();
	}

?>