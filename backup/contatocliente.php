<?php
session_start();
require('admin/class/conexao.php');

$login= new conexao();
$l = new conexao();
$conn = $l->getconexao();

header('Content-Type: text/html; charset=utf-8');
$headers = "Content-type: text/html; charset=utf-8\r\n";


$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$whatsapp = $_POST['zapzap'];
$msg = $_POST['mensagem'];

$mensagem = "
<html>
<head>
<title></title>
</head>
<body> 
	<strong> 
		Nome:
	</strong> 
	<br/>  
	$nome 
	<br/>  
	<br/>
	
	<strong>
	Telefone:
	</strong> 
	<br/>
	$telefone 
	<br/>
	<br/> 
	
	<strong>
	Email:
	</strong> 
	<br/>  
	$email 
	<br/>
	<br/> 
	
	<strong>  
	Whatsapp:
	</strong> 
	<br/>  
	$zapzap 
	<br/>
	<br/>


	<strong> 
	Mensagem:
	</strong> 
	<br/>  
	$msg 
	
</body>
</html>";

	$sql = "SELECT * FROM email";
	$query = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($query))
	{
		$email = $row['nome'];
		mail("propaganda@softhar.com.br", "Contato Via Blog Softhar",$mensagem,$headers);
	}

 echo	"<meta http-equiv='refresh' content='0;URL=muitoobrigado.php'>";
 

?>