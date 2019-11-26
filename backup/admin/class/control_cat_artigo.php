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
		
		$titulo = $_POST['titulo'];
		$texto = $_POST['descricao'];
		mysqli_query($this->main,"INSERT INTO `cat_artigo`(`id`, `nome`, `texto`) VALUES ('','$titulo','$texto')");

		echo "<meta http-equiv='refresh' content='0;URL=../cat_artigo.php'><script>alert('Insirido com sucesso!');</script>";

	}

	public function update()
	{
		$id = $_REQUEST['id'];
	
		$titulo = $_POST['titulo'];
		$texto = $_POST['descricao'];
		
		$sql = "UPDATE cat_artigo SET nome = '$titulo', texto = '$texto' WHERE id = '$id' ";
		mysqli_query($this->main,$sql);

		echo "<meta http-equiv='refresh' content='0;URL=../cat_artigo.php'><script>alert('Alterado com sucesso!');</script>";
	}


	public function delete()
	{
		$id = $_REQUEST['var'];
		$sql = "DELETE FROM `cat_artigo` WHERE `id` = $id";
		$resultado = mysqli_query($this->main,$sql);

		echo "<meta http-equiv='refresh' content='0;URL=../cat_artigo.php'><script>alert('Foto excluída!');</script>";
	}
	
	public function banner()
	{
		$id = $_POST['id'];
		
		$sql = "SELECT * FROM estrutura WHERE id = $id";
		$query = mysqli_query($this->main,$sql);
		$row = mysqli_fetch_array($query);
		
	if($row['banner'] == 0)
		{
		$sql = "UPDATE estrutura SET banner = 1 WHERE id = '$id' ";
		}
		else
		{	
		$sql = "UPDATE estrutura SET banner = 0 WHERE id = '$id' ";		
		}
		mysqli_query($this->main,$sql);

		echo "<meta http-equiv='refresh' content='0;URL=../estrutura.php'><script>alert('Alterado com sucesso!');</script>";
	}
}
?>