 <?php
  if (empty($_SESSION['tipo'])){
      header("Location: home");
  }elseif($_SESSION['tipo'] == "Professor"){
    header("Location: home");
  }
 ?>

 <h3><span class="badge badge-secondary">Gerenciar</span> Reservas</h3>

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Data</th>
      <th scope="col">Laboratorio</th>
      <th scope="col">Professor</th>
      <th scope="col">Status</th>
      <th scope="col">Operacao</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php
      $lab = new Laboratorio();
      $res = new Reserva();
      $dados = array();
      $dados = $res->listar();
      foreach ($dados as $r) {
        echo '<tr>';
        echo '<td>'.$r['id'].'</td>';
        echo '<td>'.$r['data'].'</td>';
        echo '<td>'.$lab->getLab($r['laboratorio']).'</td>';
        echo '<td>'.$r['professor'].'</td>';
        echo '<td>'.$res->getStatu($r['id']).'</td>';
        echo '<td>
          <a href="editeres?id='.$r['id'].'" class="btn btn-info">Ativar/Desativar/Cancelar</a> 
        </td>';
        echo "</tr>";
        }
    ?>
    </tr>
  </tbody>
</table>

