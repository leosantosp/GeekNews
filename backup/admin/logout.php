<?php
session_start();
require('class/conexao.php');
$user = $_POST['user'];
 $senha = $_POST['senha'];
$log = new conexao();
$log->destruir($user,$senha);



?>