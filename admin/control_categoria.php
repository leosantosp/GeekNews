<?php
header('Content-type: text/html; charset=UTF-8');
require 'class/conexao.php';
$l = new conexao();
$l->manter();

if(isset($_GET['control']))
{
	$control = filter_input(INPUT_GET, 'control', FILTER_SANITIZE_STRING);
}
else
{
	$control = filter_input(INPUT_POST, 'control', FILTER_SANITIZE_STRING);	
}

$classe = new categoria();
$classe->$control();
?>

<?php
class categoria{
	private $main;
	public function __construct()
	{
		$l = new conexao();
		$l->manter();
		$this->main = $l->getconexao();
	}
	
	public function insert()
	{

		$nome = trim($_POST['nome']);
		mysqli_query($this->main,"INSERT INTO `categoria`(`nome`) VALUES ('$nome')");

		echo "<meta http-equiv='refresh' content='0;URL=categoria.php'><script>alert('Inserido com sucesso!');</script>";

	}

	public function updateDestaque()
	{
		$id = intval($_GET['id']);
		$query = mysqli_query($this->main,"SELECT * FROM `categoria` WHERE `id` = $id ");
		$row = mysqli_fetch_array($query);
		$in_menu = ($row['in_menu'])? 0 : 1;
		echo $sql = "UPDATE categoria SET in_menu = '$in_menu' WHERE id = '$id' ";
		mysqli_query($this->main,$sql);

		echo "<meta http-equiv='refresh' content='0;URL=categoria.php'><script>alert('Alterado com sucesso!');</script>";
	}

	public function update()
	{
		$id = $_POST['id'];
		$nome = trim($_POST['nome']);
		$sql = "UPDATE categoria SET nome = '$nome' WHERE id = '$id' ";
		mysqli_query($this->main,$sql);

		echo "<meta http-equiv='refresh' content='0;URL=categoria.php'><script>alert('Alterado com sucesso!');</script>";
	}


	public function delete()
	{
		$id = $_GET['var'];
		$sqla ="SELECT * FROM `subcategoria` WHERE `id_categoria` =$id ";
		$query = mysqli_query($this->main,$sqla);

		$numero_de_subcategorias = mysqli_num_rows($query);

		if($numero_de_subcategorias==0):
			$sql = "DELETE FROM `categoria` WHERE `id` = $id";
		$resultado = mysqli_query($this->main,$sql);

		echo "<meta http-equiv='refresh' content='0;URL=categoria.php'><script>alert('Categoria excluída!');</script>";
		else:
			echo "<meta http-equiv='refresh' content='0;URL=categoria.php'><script>alert('Não foi possível excluir, existem subcategoria nessa categoria!');</script>";
		endif;
	}

	public function insert_sub()
	{

		$nome = trim($_POST['nome']);
		$id_categoria = $_POST['id_categoria'];
		$sql ="INSERT INTO `subcategoria`(`nome`,`id_categoria`) VALUES ('$nome','$id_categoria')";
		mysqli_query($this->main,$sql);

		echo "<meta http-equiv='refresh' content='0;URL=categoria.php'><script>alert('Inserido com sucesso!');</script>";

	}	
	
	public function update_sub()
	{
		$id = $_POST['id'];
		$nome = trim($_POST['nome']);
		$tag = trim($_POST['tag']);

		$sql = "UPDATE subcategoria SET nome = '$nome', tag = '$tag' WHERE id = '$id' ";
		mysqli_query($this->main,$sql);

		echo "<meta http-equiv='refresh' content='0;URL=categoria.php'><script>alert('Alterado com sucesso!');</script>";
	}
	
	public function delete_sub()
	{
		$id = $_GET['var'];
		$sqla ="SELECT * FROM `produtos` WHERE `subcategoria` =$id ";
		$query = mysqli_query($this->main,$sqla);

		$numero_de_subcategorias = mysqli_num_rows($query);

		if($numero_de_subcategorias==0):

			$sql = "DELETE FROM `subcategoria` WHERE `id` = $id";
		$resultado = mysqli_query($this->main,$sql);

		echo "<meta http-equiv='refresh' content='0;URL=categoria.php'><script>alert('Excluída!');</script>";
		else:

			echo "<meta http-equiv='refresh' content='0;URL=categoria.php'><script>alert('Não foi possível excluir, existem produtos cadastrados!');</script>";

		endif;
	}
}
?>