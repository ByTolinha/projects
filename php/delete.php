<?php
	require('../conecta.php');
	$tb = $_GET['tb'];
	$cd = $_GET['cd'];

	try {
		$delete = $conn->prepare("DELETE FROM $tb WHERE cd='$cd'");
		$delete->execute();
		header(sprintf('location: %s', $_SERVER['HTTP_REFERER']));
	} catch(PDOException $e) {
		header('location:cadastrar-categoria.php');
		?>
			<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
  			<div class="modal-dialog" role="document">
    			<div class="modal-content">
      				<div class="modal-header bg-dark font-monospace">
        				<h1 class="modal-title fs-5 font-monospace" id="deleteModalLabel">Novo Produto</h1>
        				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      				</div>
      					<div class="modal-body font-monospace">
      						
      						<?php echo 'ERROR: ' . $e->getMessage();?>

      					</div>
      				<div class="modal-footer font-monospace bg-dark">
        				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        				<button type="button" class="btn btn-warning" id="enviar">Adicionar</button>
      				</div>
    			</div>
  			</div>
		</div>

	<?php
		}
?>