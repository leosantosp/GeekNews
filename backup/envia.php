<?php
session_start();
require('admin/class/conexao.php');

$login= new conexao();
$l = new conexao();
$conn = $l->getconexao();

$nome = $_POST['nome'];
$email = $_POST['email'];
$mensagem = $_POST['mensagem'];

$sql = "INSERT INTO `depoimentos`(`id`, `nome`, `email`, `depoimento`) VALUES ('','$nome','$email','$mensagem')";
mysqli_query($conn,$sql);

echo "<meta http-equiv='refresh' content='0;URL=depoimentos.php'><script>alert('Seu depoimento foi enviado com sucesso!');</script>";

?>