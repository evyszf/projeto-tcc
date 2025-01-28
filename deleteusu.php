<?php
	if (($_SESSION['tipo'] != "Administrador")){
	  	header("Location: home");
	}

	$id = 0;
	// Precisamos pegar primeiro o valor do id:
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$id = addslashes($_GET['id']);
	}

	/*
  Verificar os campos e armazenar os valores;
  */
  if (isset($_POST["txtNome"]) && !empty($_POST["txtNome"])) {
	    $usu = new Usuario();
	    $usu->excluir($id);
	    header("Location: admconfig");
  }
  
	$usu = new Usuario();
	$dados = array();
	$dados = $usu->listarId($id);

?>
<div class="card">
  <div class="card-header">

    <h2>Excluir Usuario?</h2>
<form method="POST">
<div class="col">
  <label class="my-1 mr-2 alert-link" for="inlineFormCustomSelectPref">Id</label>
  <?php echo "<span>".$dados['id']."</span><br>"; ?>

	<label class="my-1 mr-2 alert-link" for="inlineFormCustomSelectPref">Situação</label>
  <?php echo "<span>".$dados['situacao']."</span>"; ?>
</div>
    <div class="col">
      <label for="exampleNome" class="alert-link">Nome</label>
      <?php echo "<input type='text' name='txtNome' class='form-control' value='".$dados['nome']."'' readonly>"; ?>
    </div>

    <div class="col">
      <label for="exampleNome" class="alert-link">Função</label>
      <?php echo "<input type='text' name='txtNome' class='form-control' value='".$dados['funcao']."'' readonly>"; ?>
    </div>

<div class="col">
  <div class="form-group">
    <label for="exampleInputEmail1" class="alert-link">Endereço de E-mail</label>
    <?php echo "<input type='email' name='txtEmail' class='form-control' value='".$dados['email']."' readonly>"; ?>
  </div>
  	<a href='admconfig' class='btn btn-danger'>Cancelar</a>
    <button type="submit" class="btn btn-primary">Sim</button>
</div>
   <hr>

</form>

</div>
</div>