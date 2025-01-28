<?php
  if (isset($_POST["txtNome"]) && !empty($_POST["txtNome"]) &&
    isset($_POST["txtEmail"]) && !empty($_POST["txtEmail"]) &&
    isset($_POST["txtMensagem"]) && !empty($_POST["txtMensagem"])) {
    $nome = addslashes($_POST["txtNome"]);
    $email = addslashes($_POST["txtEmail"]);
    $mensagem = addslashes($_POST["txtMensagem"]);
    Utilidades::enviarEmail($nome, $email, $mensagem);
  }

?>
<h2>Contato com a <span class="badge badge-secondary">Sisgerlab</span></h2>

<div class="card">
  <div class="card-header">
<form action="contato" method="POST">
  <div class="form-group">
    <label for="exampleFormControlInput1" class="alert-link">Nome</label>
    <input type="text" class="form-control" name="txtNome" autofocus required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput2" class="alert-link">Email</label>
    <input type="email" name="txtEmail" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea3" class="alert-link">Assunto</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" name="txtMensagem" rows="3" required></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>
</div>
</div>