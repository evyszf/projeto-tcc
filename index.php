<?php  
require 'config.php';// usado para verificar sempre o banco em todas as paginas
session_start();

//define("BASE_URL", "https://www.sisgerlab.tk/"); //Usada no servidor web funcional
define("BASE_URL", "http://localhost/sisgerlab/");// Usada para o servidor local desenvolvedor

/*
função para pegar o nome do arquivo nos devidos pacotes,
distribui ou navega pelo mvc, em seguida pega o nome da
classe necessária para carregar sobre o template.php 
*/
spl_autoload_register(function ($class){
	if(strpos($class, 'Controle') > -1){
		if(file_exists('controles/'.$class.'.php')){
			require_once 'controles/'.$class.'.php';
		}
	}else if(file_exists('modelos/'.$class.'.php')){
		require_once 'modelos/'.$class.'.php';
	}else{
		require_once 'core/'.$class.'.php';
	}
});
/*
Em seguida levar a url capatura para a classe Core
fazer os filtros das urls amigaveis
*/
$core = new Core();
$core->carregar();

?>