<?php
header ('Content-type: text/html; charset=UTF-8');
require '../class/cliente.php';
require'../class/conexao.php';
$l = new conexao();



$sucesso = -1;

if (isset($_POST['id'])) {

$id = $_POST['id'];
$servicos = $_POST['servico'];
$cli = new cliente();
$sucesso = $cli->associarservico($id,$servicos);
}





if ($sucesso!=-1) {
echo "<div class='alert alert-success fade in navbar-fixed-top'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>Cadastro feito!</strong>
</div>";
//echo "<meta http-equiv='refresh' content='1;URL=clientesservicos.php?id=$sucesso'>";

}elseif ($sucesso==-1) {

echo "<div class='alert alert-danger fade in navbar-fixed-top'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>Este e-mail ou CPF/CNPJ já foi utilizado para cadastro !</strong>
</div>";
}


?>