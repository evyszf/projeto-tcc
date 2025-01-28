<?php
    // buscar reservas no calendario
    $res = new Reserva();
    $dados = array();
    $dados = $res->listar();
    // buscar nome do lab
    $lab = new Laboratorio();
    $dados2 = array();
    $dados2 = $lab->listar();

    // verificador de campos casos aconteça uma reserva
    if(isset($_POST["txtProf"]) && !empty($_POST['txtProf']) && 
      isset($_POST["title"]) && !empty($_POST['title']) && 
      isset($_POST["start"]) && !empty($_POST['start'])){

      $prof = $_POST['txtProf'];
      $labor = $_POST['title'];
      $startData = $_POST['start'];
      $status = "#daa520"; // cor escolhida como padrao para reserva em analise

      //Converter a data e hora do formato brasileiro para o formato do Banco de Dados
      $data = explode(" ", $startData);
      list($date, $hora) = $data;
      $data_sem_barra = array_reverse(explode("/", $date));
      $data_sem_barra = implode("-", $data_sem_barra);
      $dataBarra = $data_sem_barra . " " . $hora;

      $res = new Reserva();
      $res->setData($dataBarra." ".$labor);// permitir horarios iguais em locais diferente
      $res->setLab($labor);
      $res->setProf($prof);
      $res->setStatus($status);
      $res->cadastrar();
    }
    
?>
<link href="<?php echo BASE_URL ?>assets/css/fullcalendar.min.css" rel="stylesheet" />
<link href="<?php echo BASE_URL ?>assets/css/fullcalendar.print.min.css" rel="stylesheet" media="print" />

<script src="<?php echo BASE_URL ?>assets/js/moment.min.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/fullcalendar.min.js"></script>
<script src="<?php echo BASE_URL ?>assets/locale/pt-br.js"></script>
<script>

  var now = new Date();
  var valorData = 0;
  valorDataHoje = parseInt(now.getFullYear()+""+(now.getMonth()+1)+""+now.getDate());

  $(document).ready(function() {
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,listMonth'
      },
      defaultDate: Date(),
      navLinks: true,
      editable: true,
      eventLimit: true, 
      eventClick: function(event) {
        $('#visualizar #id').text(event.id);
        $('#visualizar #title').text(event.title);
        $('#visualizar #start').text(event.start.format('DD/MM/YYYY HH:mm'));
        $('#visualizar').modal('show');
        return false;
      },
      
      selectable:'<?php echo Utilidades::isLogado();?>', // bloquear ou desbloquear o calendario se o usuário logado.
      selectHelper: true,
      select: function(start){
        //document.write($('.fc-past').hasClass('fc-sun'));
        var horarioformado = "";
        horarioformado += moment(start).format('DD/MM/YYYY ');

        // Verificar data passada com data de hoje
        var valorDataSelecionada = 0;
        valorDataSelecionada = parseInt(moment(start).format('YYYYMMDD'));
        if (valorDataSelecionada >= valorDataHoje) {
  
          //if ($('.all-day').hasClass('fc-sun') == false) {

          $('#cadastrar #data').val(moment(start).format('DD/MM/YYYY '));
          $('#cadastrar #viewHora').val(horarioformado + $("#box option:selected").val());
          $('#cadastrar').modal('show');
          $("#box").change(function(){
            $('#cadastrar #viewHora').val(horarioformado + $("#box option:selected").val());
          });

          //}

        }else{
          alert("Data já passou.");
        }
      },
      
      events: [
        { // iniciador do calendario, precisa de uma data qualquer
          id: 01,
          title: 'Default Inicial',
          start: '2000-01-01 00:00',
          color: '#000000'
        },
        <?php
          foreach($dados as $row){
            ?>
            {
            id: '<?php echo $row['id']; ?>',
            title: '<?php echo $lab->getLab($row['laboratorio']); ?>',
            start: '<?php echo substr($row['data'],0,16); ?>',
            color: '<?php echo $row['status']; ?>'
            },<?php
          }
        ?>
        {// funcao a ser estudada para setar os feriados
          start: '2018-12-25',
          overlap: false,
          rendering: 'background',
          color: '#ff0000'
        }
      ],
      timeFormat: 'H:mm'
    });
  
});


  //Mascara para o campo data e hora
  function DataHora(evento, objeto){
    var keypress=(window.event)?event.keyCode:evento.which;
    campo = eval (objeto);
    if (campo.value == '00/00/0000 HH:mm'){
      campo.value="";
    }
   
    caracteres = '0123456789';
    separacao1 = '/';
    separacao2 = ' ';
    separacao3 = ':';
    conjunto1 = 2;
    conjunto2 = 5;
    conjunto3 = 10;
    conjunto4 = 13;
    conjunto5 = 16;
    if ((caracteres.search(String.fromCharCode (keypress))!=-1) && campo.value.length < (19)){
      if (campo.value.length == conjunto1 )
      campo.value = campo.value + separacao1;
      else if (campo.value.length == conjunto2)
      campo.value = campo.value + separacao1;
      else if (campo.value.length == conjunto3)
      campo.value = campo.value + separacao2;
      else if (campo.value.length == conjunto4)
      campo.value = campo.value + separacao3;
      else if (campo.value.length == conjunto5)
      campo.value = campo.value + separacao3;
    }else{
      event.returnValue = false;
    }
  }
  
</script>
<header class="fc-header">
  <div class="container">       
        <span class="btn btn-success"></span> Confirmada
        <span class="btn btn-warning"></span> Pendente
        <span class="btn btn-danger"></span> Cancelada
        <span class="btn" style="background: #FFAEB9;"></span> Feriados

    <div id='calendar'></div>
    <hr>
  </div>

<!--Modal para visualizar os detalhes já cadastrados-->
<div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center">Detalhes da Reserva</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>   
      </div>
      <div class="modal-body">
        <dl class="dl-horizontal">
          <dt>Código reserva</dt>
          <dd id="id"></dd>
          <dt>Laboratório</dt>
          <dd id="title"></dd>
          <dt>Data da reserva</dt>
          <dd id="start"></dd>
        </dl>
      </div>
    </div>
  </div>
</div>
<!--fim-->


<!--Modal para cadastrar reservas-->
<div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center">Pedido de reserva</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="calendario">
          
          <div class="form-group">
            <div class="col-sm-10">
              <!--Pegar nome do usuário da sessão-->
              <?php
               echo "<input class='form-control' name='txtProf' type='text' value='" .$_SESSION['nome']."' readonly>";
              ?>
            </div>
          </div>

          <hr>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Laboratórios</label>
            <div class="col-sm-10">
              <select name="title" class="form-control" id="title">
                <option value="">Selecione</option>     

                <?php
                  foreach($dados2 as $row2){
                    echo "<option value=".$row2['id'].">".$row2['nome']."</option>";
                  }
                ?>

              </select>
            </div>
          </div>
          
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Horário</label>
            <div class="col-sm-10">
              <select id="box" name="horas" class="form-control">
                <option value="">Selecione</option>     
                <option value="07:00" id="hora">07:00 às 08:00 Manhã</option>
                <option value="08:00" id="hora">08:00 às 09:00 Manhã</option>
                <option value="09:00" id="hora">09:00 às 10:00 Manhã</option>
                <option value="10:00" id="hora">10:00 às 11:00 Manhã</option>
                <option value="11:00" id="hora">11:00 às 12:00 Manhã</option>

                <option value="13:00" id="hora">13:00 às 14:00 Tarde</option>
                <option value="14:00" id="hora">14:00 às 15:00 Tarde</option>
                <option value="15:00" id="hora">15:00 às 16:00 Tarde</option>
                <option value="16:00" id="hora">16:00 às 17:00 Tarde</option>

                <option value="17:00" id="hora">17:00 às 18:00 Noite</option>
                <option value="18:00" id="hora">18:00 às 19:00 Noite</option>
                <option value="19:00" id="hora">19:00 às 20:00 Noite</option>
                <option value="20:00" id="hora">20:00 às 21:00 Noite</option>
                <option value="21:00" id="hora">21:00 às 22:00 Noite</option>
                
              </select>
            </div>
          </div>

          <hr>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Data:</label>
            <div class="col-sm-10">
              <input class="form-control" name="start" type="text" value="" id="viewHora" readonly>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-success">Solicitar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--Fim Modal cadastrar reservas-->


</header>