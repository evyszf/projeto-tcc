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
  if (isset($_POST["txtOpcao"]) &&
    isset($_POST["txtNome"]) && !empty($_POST["txtNome"]) &&
    isset($_POST["txtEmail"]) && !empty($_POST["txtEmail"]) &&
    isset($_POST["txtSituacao"]) && !empty($_POST["txtSituacao"])) {

    $txtFun = addslashes($_POST["txtOpcao"]);
    $txtNome = addslashes($_POST["txtNome"]);
    $txtEmail = addslashes($_POST['txtEmail']);
    $txtSit = addslashes($_POST["txtSituacao"]);

    $usu = new Usuario();
    $usu->setNome($txtNome);
    $usu->setEmail($txtEmail);
    $usu->setFuncao($txtFun);
    $usu->setSituacao($txtSit);
    $usu->editar($id);
    header("Location: admconfig");
  }

	$usu = new Usuario();
	$dados = array();
	$dados = $usu->listarId($id);

?>
<div class="card">
  <div class="card-header">

    <h2>Edite dados</h2>
<form method="POST">

	<label class="my-1 mr-2 alert-link" for="inlineFormCustomSelectPref">Situação</label>
  <select class="custom-select my-1 mr-sm-2" name="txtSituacao">
      <?php
        if ($dados['situacao'] == "on") {
          echo "<option selected value='on'>On</option>";
          echo "<option value='off'>Off</option>";
        } else {
          echo "<option selected value='off'>Off</option>";
          echo "<option value='on'>On</option>";
        }
      ?>
  </select>

  <label class="my-1 mr-2 alert-link" for="inlineFormCustomSelectPref">Sua função</label>
  <select class="custom-select my-1 mr-sm-2" name="txtOpcao">
      <?php
        if ($dados['funcao'] == "Administrador") {
          echo "<option selected value='Administrador'>Administrador</option>";
          echo "<option value='Coordenador'>Coordenador</option>";
          echo "<option value='Professor'>Professor</option>";
        } elseif($dados['funcao'] == "Coordenador") {
          echo "<option selected value='Coordenador'>Coordenador</option>";
          echo "<option value='Administrador'>Administrador</option>";
          echo "<option value='Professor'>Professor</option>";
        }else{
          echo "<option selected value='Professor'>Professor</option>";
          echo "<option value='Administrador'>Administrador</option>";
          echo "<option value='Coordenador'>Coordenador</option>";
        }
        
      ?>
  </select>

  <div class="form-row">
    <div class="col">
      <label for="exampleNome" class="alert-link">Nome</label>
      <?php echo "<input type='text' name='txtNome' class='form-control' value='".$dados['nome']."'' required>"; ?>
    </div>

    <div class="col">
      <label for="exampleCpf" class="alert-link">CPF</label>
      <?php echo "<input type='text' maxlength='11' name='txtCpf' class='form-control' value='".$dados['cpf']."' readonly>"; ?>
      <small id="emailHelp" class="form-text text-muted">Nós nunca vamos compartilhar seu CPF com mais ninguém.</small>
    </div>

  </div>

  <div class="form-group">
    <label for="exampleInputEmail1" class="alert-link">Endereço de E-mail</label>
    <?php echo "<input type='email' name='txtEmail' class='form-control' value='".$dados['email']."' required>"; ?>
    <small id="emailHelp" class="form-text text-muted">Nós nunca vamos compartilhar seu e-mail com mais ninguém.</small>
  </div>
  	<a href='admconfig' class='btn btn-danger'>Voltar</a>
    <button type="submit" class="btn btn-primary">Atualizar</button>

   <hr>

</form>

</div>
</div>