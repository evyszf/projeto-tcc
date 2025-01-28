<?php
  if (($_SESSION['tipo'] != "Administrador")){
    header("Location: home");
  }

  if (isset($_POST["txtNomeLab"]) && !empty($_POST["txtNomeLab"]) &&
    isset($_POST["txtLocalLab"]) && !empty($_POST["txtLocalLab"])) {
    $nome = $_POST["txtNomeLab"];
    $local = $_POST["txtLocalLab"];

    $lab = new Laboratorio();
    $lab->setNome($nome);
    $lab->setLocal($local);
    $lab->cadastrar();
    header("Location: admconfig");

    }elseif (isset($_POST["txtNome"]) && !empty($_POST["txtNome"]) &&
    isset($_POST["txtFuncao"]) && !empty($_POST["txtFuncao"]) &&
    isset($_POST["txtCpf"]) && !empty($_POST["txtCpf"]) &&
    isset($_POST["txtEmail"]) && !empty($_POST["txtEmail"]) &&
    isset($_POST["txtSenha"]) && !empty($_POST["txtSenha"])) {

      $nome = $_POST["txtNome"];
      $fun = $_POST["txtFuncao"];
      $cpf = $_POST["txtCpf"];
      $email = $_POST["txtEmail"];
      $senha = md5($_POST["txtSenha"]);
      $situ = $_POST["txtSituacao"];

      $usu = new Usuario();
      $usu->setNome($nome);
      $usu->setFuncao($fun);
      $usu->setCpf($cpf);
      $usu->setEmail($email);
      $usu->setSenha($senha);
      $usu->setSituacao($situ);
      $usu->cadastrar();
      header("Location: admconfig");
    }
?>

<script>
  $('#exampleModal').on('show.bs.modal', function (event) {

  })
</script>

<hr>
<h3><span class="badge badge-secondary">Lista de usuários</span>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal2" data-whatever="@mdo">Novo usuário</button></h3>

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Nome</th>
      <th scope="col">Email</th>
      <th scope="col">Funcao</th>
      <th scope="col">Status</th>
      <th scope="col">Operacao</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php
      $cad = new Usuario();
      $dados = array();
      $dados = $cad->listar();
      foreach ($dados as $usu1) {
        echo '<tr>';
        echo '<td>'.$usu1['id'].'</td>';
        echo '<td>'.$usu1['nome'].'</td>';
        echo '<td>'.$usu1['email'].'</td>';
        echo '<td>'.$usu1['funcao'].'</td>';
        echo '<td>'.$usu1['situacao'].'</td>';
        echo '<td>
          <a href="deleteusu?id='.$usu1['id'].'" class="btn btn-danger">Excluir</a>
          <a href="editeusu?id='.$usu1['id'].'" class="btn btn-info">Editar</a> 
        </td>';
        echo "</tr>";
        }
    ?>
    </tr>
  </tbody>
</table>
<hr>

<!--lista de labs-->
<hr>
<h3><span class="badge badge-secondary">Lista de laboratórios</span>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Novo laboratório</button></h3>

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Nome</th>
      <th scope="col">Local</th>
      <th scope="col">Operacao</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php
      $labs = new Laboratorio();
      $dadoslab = array();
      $dadoslab = $labs->listar();
      foreach ($dadoslab as $lab) {
        echo '<tr>';
        echo '<td>'.$lab['id'].'</td>';
        echo '<td>'.$lab['nome'].'</td>';
        echo '<td>'.$lab['local'].'</td>';
        echo '<td>
          <a href="deletelab?id='.$lab['id'].'" class="btn btn-danger">Excluir</a>
          <a href="editelab?id='.$lab['id'].'" class="btn btn-info">Editar</a> 
        </td>';
        echo "</tr>";
        }
    ?>
    </tr>
  </tbody>
</table>
<hr>

<!--moda cadastar laboratorios-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar laborátorio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="admconfig">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nome:</label>
            <input type="text" name="txtNomeLab" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Local:</label>
            <input type="text" name="txtLocalLab" class="form-control" required>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Salvar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--fim modal lab-->

<!--moda cadastrar usuario-->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="admconfig">
          <label class="my-1 mr-2 alert-link">Função</label>
          <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="txtFuncao">
            <option selected value="0">Selecione</option>
            <option value="Administrador">Administrador</option>
            <option value="Coordenador">Coordenador</option>
            <option value="Professor">Professor</option>
          </select>

          <div class="form-group">
            <label class="my-1 mr-2 alert-link">Nome</label>
            <input type="text" name="txtNome" class="form-control" required>
          </div>

          <div class="form-group">
            <label class="my-1 mr-2 alert-link">Email</label>
            <input type="email" name="txtEmail" class="form-control" required>
          </div>

          <div class="form-group">
            <label class="my-1 mr-2 alert-link">CPF</label>
            <input type="text" name="txtCpf" maxlength="11" class="form-control" required>
          </div>

          <div class="form-group">
          <label for="exampleInputPassword" class="alert-link">Senha</label>
          <input type="password" name="txtSenha" class="form-control" id="exampleInputPassword1" placeholder="Senha" required></div>

          <label class="my-1 mr-2 alert-link">Status</label>
          <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="txtSituacao">
            <option selected value="on">On</option>
            <option value="off">Off</option>
          </select>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Salvar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--moda cadastar laboratorios-->
