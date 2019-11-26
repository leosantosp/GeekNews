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
	
	public function insert()
	{

		$nome = $_POST['nome'];
		mysqli_query($this->main,"INSERT INTO `categoria`(`id`, `nome`) VALUES ('','$nome')");

		echo "<meta http-equiv='refresh' content='0;URL=../categoria.php'><script>alert('Inserido com sucesso!');</script>";

	}

	public function update()
	{
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		
		$sql = "UPDATE categoria SET nome = '$nome' WHERE id = '$id' ";
		mysqli_query($this->main,$sql);

		echo "<meta http-equiv='refresh' content='0;URL=../categoria.php'><script>alert('Alterado com sucesso!');</script>";
	}


	public function delete()
	{
		$id = $_GET['var'];

		$sql = "DELETE FROM `categoria` WHERE `id` = $id";
		$resultado = mysqli_query($this->main,$sql);

		echo "<meta http-equiv='refresh' content='0;URL=../categoria.php'><script>alert('Categoria excluída!');</script>";
	}
	
	public function destaque()
	{
		$id = $_POST['id'];
		$destaque = $_POST['destaque'];
		
		$sql = "UPDATE categoria_destaque SET categoria = '$destaque' WHERE id = '$id' ";
		mysqli_query($this->main,$sql);

		echo "<meta http-equiv='refresh' content='0;URL=../categoria.php'><script>alert('Alterado com sucesso!');</script>";
	}
}
?>