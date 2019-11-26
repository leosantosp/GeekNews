<?php
session_start();
require('class/conexao.php');
header ('Content-type: text/html; charset=UTF-8');
$user = $_POST['user'];
$senha = $_POST['senha'];
$log = new conexao();
$retorno = $log->valida($user,$senha);
if($retorno==-1){
echo "<div class='alert alert-danger fade in navbar-fixed-top'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>E-mail e/ou Senha incorretos.</strong>
</div>";

}else{
	echo "<div class='alert alert-success fade in navbar-fixed-top'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>Liberando acesso...</strong>
</div>";
echo "<meta http-equiv='refresh' content='1;URL=painel.php'>";
}



?>
