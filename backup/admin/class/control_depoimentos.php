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
		$id = $_POST['id'];		
		$sql = "UPDATE depoimentos SET  status = 1 WHERE id = '$id' ";
		mysqli_query($this->main,$sql);

		echo "<meta http-equiv='refresh' content='0;URL=../painel.php'><script>alert('Depoimento aprovado com sucesso!');</script>";
	}


	public function delete()
	{
		$id = $_GET['id'];

		$sql = "DELETE FROM `estrutura` WHERE `id` = $id";
		$resultado = mysqli_query($this->main,$sql);

		echo "<meta http-equiv='refresh' content='0;URL=../painel.php'><script>alert('Depoimento excluído!');</script>";
	}
}
?>