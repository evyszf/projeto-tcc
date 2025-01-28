<?php
if (empty($_SESSION['nome']) && empty($_SESSION['tipo'])){
  header("Location: login");
}

?>
<h3><span class="badge badge-secondary">Minhas </span> Reservas</h3>
<hr>
<a href="calendario" class="btn btn-info">Nova reserva</a>
<hr> 
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Data</th>
      <th scope="col">Laboratorio</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php
      $lab = new Laboratorio();
      $res = new Reserva();
      $dados = array();
      $dados = $res->listarReservaUsu($_SESSION['nome']);
      foreach ($dados as $r) {
        echo '<tr>';
        echo '<td>'.$r['id'].'</td>';
        echo '<td>'.$r['data'].'</td>';
        echo '<td>'.$lab->getLab($r['laboratorio']).'</td>';
        echo '<td>'.$res->getStatu($r['id']).'</td>';
        echo '<tr>';
        }
    ?>
    </tr>
  </tbody>
</table>


