<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8"/>
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL ?>favicon.ico"/>
  <meta name="description" content="Sisgerlab - Sistema para gerenciar as reservas dos laboratórios solicitadas pelos professores."/>
  <meta name="Keywords" content="SisGerLab, sislerlab, lab"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
  <meta id="viewport" name="viewport" content="width=device-width, user-scalable=no"/>

  <meta name="robots" content="index,follow"/>
  <meta name="author" content="Sisgerlab"/>

  <meta property="og:type" content="website">
  <meta property="og:locale" content="pt_BR">
  <meta property="og:site_name" content="sisgerlab">
  <meta property="og:image" content="<?php echo BASE_URL ?>assets/img/sisgerlab.jpg">
  <meta property="og:image:type" content="image/jpeg">
  <meta property="og:image:width" content="256"> 
  <meta property="og:image:height" content="256">
  <meta property="og:url" content="https://www.sisgerlab.tk/">
  <meta property="og:title" content="Sisgerlab">
  <meta property="og:description" content="Sisgerlab - Sistema para gerenciar as reservas dos laboratórios solicitadas pelos professores.">

  <title>Sisgerlab</title>

  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>assets/css/sisgerlab.css">
  
  <script type="text/javascript" src="<?php echo BASE_URL ?>assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL ?>assets/js/bootstrap.js"></script>
  
</head>
<body>

<div class="container">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  
  <img class="navbar-brand" src="<?php echo BASE_URL ?>assets/img/logotipo.png" width="110px" height="90px"/>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home">Home <span class="sr-only"></span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="calendario">Reservas <span class="sr-only"></span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="contato">Contato <span class="sr-only"></span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="sobre">Sobre <span class="sr-only"></span></a>
      </li>

    </ul>

    <li class="form-outline my-2 my-lg-0">
      <?php
        Utilidades::menuPersonalisado();
      ?>
    </li>
  </div>
</nav>
</div>


<div class="container">
  <?php $this->loadViewInTemplate($nomePagina, $dadosPagina) ?>
</div>

<div class="container">
<span class="d-block p-2 bg-dark text-white">
  <p>&copy;2018 <a href="<?php echo BASE_URL ?>">Sisgerlab</a> Versão 0.0.2 - Todos os direitos reservados</p>

  <div>Icons made by <a href="https://www.flaticon.com/authors/gregor-cresnar" title="Gregor Cresnar">Gregor Cresnar</a> from <a href="https://www.flaticon.com/"           title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/"          title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>

</span>
</div>  

</body>
</html>