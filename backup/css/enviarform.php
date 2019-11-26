<?php


header('Content-Type: text/html; charset=utf-8');
$headers = "Content-type: text/html; charset=utf-8\r\n";

$empresa = $_POST['empresa'];
$cnpj = $_POST['cnpj'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$plano = $_POST['plano'];

if(isset($_POST['atual']))
{
    // Faz loop pelo array dos numeros
    foreach($_POST['atual'] as $atual)
    {
    $atua.=' - ' . $atual ;
    }
}
else
{
     $atua.='Nenhuma opção selecionada<br/>';
}

if(isset($_POST['interesse']))
{
    // Faz loop pelo array dos numeros
    foreach($_POST['interesse'] as $interesse)
    {
     $interess.=' - ' . $interesse ;
    }
}
else
{
     $interess ='Nenhuma op??o selecionada';
}



$msn = $_POST['mensagem'];


 $mensagem = "
<table border='0' cellspacing='20px' style='border:2px solid #CCCCCC;'>

	<tr >
		
		<td colspan='4' align='center' style='border-bottom:1px solid #DDDDDD;'><h2> <strong>Nome:</strong> $nome</h2></td>
	</tr>

	<tr>
		<td style='border-bottom:1px solid #DDDDDD;'><strong>Empresa: </strong></td>
		<td style='border-bottom:1px solid #DDDDDD;'> $empresa  </td>
		<td style='border-bottom:1px solid #DDDDDD;'><strong>CNPJ: </strong></td>
		<td style='border-bottom:1px solid #DDDDDD;'> $cnpj </td>


	</tr>

	<tr>
		<td style='border-bottom:1px solid #DDDDDD;'><strong>Email: </strong></td>
		<td style='border-bottom:1px solid #DDDDDD;'> $email </td>	
		<td style='border-bottom:1px solid #DDDDDD;'><strong>Telefone Fixo: </strong></td>
		<td style='border-bottom:1px solid #DDDDDD;'> $telefone</td>
	</tr>

	<tr>
		<td style='border-bottom:1px solid #DDDDDD;'><strong>Plano de interesse:</strong></td>
		<td style='border-bottom:1px solid #DDDDDD;'  colspan='3'>$plano</td>

	</tr>	
	
	<tr>
		<td style='border-bottom:1px solid #DDDDDD;'><strong>Operadora atual: </strong></td>
		<td style='border-bottom:1px solid #DDDDDD;'>$atua </td>
		<td style='border-bottom:1px solid #DDDDDD;'><strong>Operadora de interesse: </strong></td>
		<td style='border-bottom:1px solid #DDDDDD;'>$interess </td>
	</tr>
	
	<tr>
		<td style='border-bottom:1px solid #DDDDDD;'><strong>Mensagem: </strong></td>
		<td style='border-bottom:1px solid #DDDDDD;' colspan='3'>$msn </td>
	</tr>
	
</table>";

 mail("contato@maisconsultoriatelecom.com.br", "Interesse do cliente", $mensagem, $headers);
mail("desenvolvimento@softhar.com.br", "Contato Via site Mais Telecom",$mensagem,$headers);

echo	"<meta http-equiv='refresh' content='0;URL=index.php'>
 
 <script>
	alert('Mensagem enviada com sucesso')
	</script>";


?>