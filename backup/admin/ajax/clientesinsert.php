<?php
header ('Content-type: text/html; charset=UTF-8');
require '../class/cliente.php';
require'../class/conexao.php';
$l = new conexao();


	$nome = $_POST['nome'];
	$nomeempresa = $_POST['empresa'];
	$endereco = $_POST['endereco'];
	$cep = $_POST['cep'];
	$bairro = $_POST['bairro'];
	$complemento = $_POST['complemento'];
	$cidade = $_POST['cidade'];
	$estado = $_POST['estado'];
	$pais = $_POST['pais'];
	$email = $_POST['email'];
	$emailsecundario = $_POST['emailsecundario'];
	$tel1 = $_POST['telefone1'];
	$tel2 = $_POST['telefone2'];
	$data = $_POST['data'];
	$rgie = $_POST['rgie'];
	$cpfcnpj = $_POST['cpfcnpj'];




$cli = new cliente();
$sucesso = $cli->inserir($nome,$nomeempresa, $endereco, $cep , $bairro, $complemento, $cidade, $estado, $pais, $email,$emailsecundario, $tel1, $tel2, $data, $rgie, $cpfcnpj);

if ($sucesso!=-1) {
echo "<div class='alert alert-success fade in navbar-fixed-top'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>Vamos aos serviços!</strong>
</div>";
echo "<meta http-equiv='refresh' content='1;URL=clientesservicos.php?id=$sucesso'>";

}elseif ($sucesso==-1) {

echo "<div class='alert alert-danger fade in navbar-fixed-top'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>Este e-mail ou CPF/CNPJ já foi utilizado para cadastro !</strong>
</div>";
}


?>