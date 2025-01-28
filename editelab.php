<?php
	if (($_SESSION['tipo'] != "Administrador")){
	  	header("Location: home");
	}

	$id = 0;
	// Precisamos pegar primeiro o valor do id:
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$id = addslashes($_GET['id']);
	}

	$lab = new Laboratorio();
	if (isset($_POST["txtId"]) && !empty($_POST["txtId"]) &&
		isset($_POST["txtNome"]) && !empty($_POST["txtNome"]) &&
		isset($_POST["txtLocal"]) && !empty($_POST["txtLocal"])) {
		$nome = $_POST["txtNome"];
		$local = $_POST["txtLocal"];
		$lab->setNome($nome);
		$lab->setLocal($local);
	    $lab->editar($id);
	    header("Location: admconfig");
  	}
	//$lab = new Laboratorio();
	$dadoslab = array();
	$dadoslab = $lab->listarId($id);
?>

<div class="card">
  <div class="card-header">

    <h2>Excluir laboratorio?</h2>
<form method="POST">

	<div class="form-group col-md-2">
      <label class="my-1 mr-2 alert-link">Id</label>
      <?php echo "<input type='text' name='txtId' value='".$dadoslab['id']."' class='form-control' readonly>" ?>
    </div>

    <div class="form-group col-md-2">
      <label class="my-1 mr-2 alert-link">Nome</label>
      <?php echo "<input type='text' name='txtNome' value='".$dadoslab['nome']."' class='form-control'>" ?>
    </div>

    <div class="form-group col-md-2">
      <label class="my-1 mr-2 alert-link">Local</label>
      <?php echo "<input type='text' name='txtLocal' value='".$dadoslab['local']."' class='form-control'>" ?>
    </div>
<hr>
  	<a href='admconfig' class='btn btn-danger'>Cancelar</a>
    <button type="submit" class="btn btn-primary">Sim</button>
</div>
   <hr>

</form>

</div>
</div>