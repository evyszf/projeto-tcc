<?php
  /*
  Verificar os campos e armazenar os valores;
  */
  if (isset($_POST["txtOpcao"]) &&
    isset($_POST["txtNome"]) && !empty($_POST["txtNome"]) &&
    isset($_POST["txtSobrenome"]) && !empty($_POST["txtSobrenome"]) &&
    isset($_POST["txtCpf"]) && !empty($_POST["txtCpf"]) &&
    isset($_POST["txtEmail"]) && !empty($_POST["txtEmail"]) &&
    isset($_POST["txtSenha1"]) && !empty($_POST["txtSenha1"])) {

    $txtOpcao = addslashes($_POST["txtOpcao"]);
    $txtNome = addslashes($_POST["txtNome"]);
    $txtSobrenome = addslashes($_POST["txtSobrenome"]);
    $txtCpf = addslashes($_POST["txtCpf"]);
    $txtEmail = addslashes($_POST['txtEmail']);
    $txtSenha1 = md5(addslashes($_POST["txtSenha1"]));
    $txtSenha2 = md5(addslashes($_POST["txtSenha2"]));

    /*
    Verificar se as senhas estão iguais e se box função foi selecionado;
    Se tudo ok, então insere os dados no banco.
    */
    if($txtSenha1 == $txtSenha2){
      if($txtOpcao != "0"){
        $func = new Usuario();
        $func->setCpf($txtCpf);
        $func->setNome($txtNome." ".$txtSobrenome);
        $func->setEmail($txtEmail);
        $func->setSenha($txtSenha1);
        $func->setFuncao($txtOpcao);
        $func->setSituacao("off"); // valor padrão temporario desativo
        $func->cadastrar();
      }else{
        echo "".Utilidades::mensagemErro("Selecione sua função!");
        exit();
      }
    } else {
      echo "".Utilidades::mensagemErro("Senhas são diferentes!");
      exit();
    }
  }
?>

<div class="card">
  <div class="card-header">

    <h2>Solicitar acesso</h2>

<form action="cadastro" method="POST">

  <label class="my-1 mr-2 alert-link" for="inlineFormCustomSelectPref">Sua função</label>
  <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="txtOpcao">
    <option selected value="0">Selecione</option>
    <option value="Administrador">Administrador</option>
    <option value="Coordenador">Coordenador</option>
    <option value="Professor">Professor</option>
  </select>

  <div class="form-row">
    <div class="col">
      <label for="exampleNome" class="alert-link">Nome</label>
      <input type="text" name="txtNome" class="form-control" placeholder="Nome" required>
    </div>

    <div class="col">
      <label for="exampleSobreNome" class="alert-link">Sobrenome</label>
      <input type="text" name="txtSobrenome" class="form-control" placeholder="Sobrenome" required>
    </div>

    <div class="col">
      <label for="exampleCpf" class="alert-link">CPF</label>
      <input type="text" maxlength="11" name="txtCpf" class="form-control" placeholder="CPF" required>
      <small id="emailHelp" class="form-text text-muted">Nós nunca vamos compartilhar seu CPF com mais ninguém.</small>
    </div>

  </div>

  <div class="form-group">
    <label for="exampleInputEmail1" class="alert-link">Endereço de E-mail</label>
    <input type="email" name="txtEmail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Digite o E-mail" required>
    <small id="emailHelp" class="form-text text-muted">Nós nunca vamos compartilhar seu e-mail com mais ninguém.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword" class="alert-link">Senha</label>
    <input type="password" name="txtSenha1" class="form-control" id="exampleInputPassword1" placeholder="Senha" required></div>

    <div class="form-group">
        <input type="password" name="txtSenha2" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" placeholder="Repita a Senha" required>
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar</button>

</form>

</div>
</div>