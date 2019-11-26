<?php
header('Content-type: text/html; charset=UTF-8');
session_start();
require 'cliente.php';
require 'conexao.php';


if(isset($_GET['control']))
	{
		$control = filter_input(INPUT_GET, 'control', FILTER_SANITIZE_STRING);
	}
else
	{
		$control = filter_input(INPUT_POST, 'control', FILTER_SANITIZE_STRING);	
	}
	
$classe = new estrutura();
$classe->$control();
?>

<?php
class estrutura{
	private $main;
	public function __construct()
	{
		$l = new conexao();
		$l->manter();
		$this->main = $l->getconexao();
	}
	

	public function update()
	{
		$id = $_REQUEST['id'];
	
		$texto = $_POST['descricao'];
		
		$sql = "UPDATE telefone_rodape SET texto = '$texto' WHERE id = '$id' ";
		mysqli_query($this->main,$sql);

		echo "<meta http-equiv='refresh' content='0;URL=../telefone_rodape.php'><script>alert('Alterado com sucesso!');</script>";
	}



	
}
?>