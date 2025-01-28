<?php

  if (empty($_SESSION['tipo'])){
    header("Location: home");
  }elseif ($_SESSION['tipo'] == "Professor") {
    header("Location: home");
  }

	$id = 0;
	// Precisamos pegar primeiro o valor do id:
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$id = addslashes($_GET['id']);
	}

  if (isset($_POST["txtStatus"]) && !empty($_POST["txtStatus"])) {

    $txtStatus = addslashes($_POST["txtStatus"]);
	  
    $res = new Reserva();
    $res->setStatus($txtStatus);
    $res->editar($id);
	  header("Location: coorconfig");
  }

?>
<div class="card">
  <div class="card-header">

    <h2>Edite reserva</h2>
<form method="POST">

	<label class="my-1 mr-2 alert-link" for="inlineFormCustomSelectPref">Situação</label>
  <select class="custom-select my-1 mr-sm-2" name="txtStatus">
      <option value="#daa520">Pendente</option>
      <option value="#228b22">Ativar</option>
      <option value="#b22222">Cancelada</option>
  </select>

  
  	<a href='coorconfig' class='btn btn-danger'>Voltar</a>
    <button type="submit" class="btn btn-primary">Atualizar</button>

   <hr>

</form>

</div>
</div>