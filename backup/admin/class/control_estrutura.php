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
		$file1 = $_FILES['foto'];

		$ext = strtolower(substr($file1['name'],-4)); //Pegando extensão do arquivo
		$new_name = date("Y.m.d-H.i.s") . "1" . $ext; //Definindo um novo nome para o arquivo
		move_uploaded_file($file1['tmp_name'], '../fotos/'.$new_name); //Fazer upload do arquivo

		$foto=$new_name;
		
		$legenda = $_POST['legenda'];
		$titulo = $_POST['titulo'];
		$texto = $_POST['descricao'];
		$categoria = $_POST['categoria'];
		mysqli_query($this->main,"INSERT INTO `estrutura`(`id`, `foto`, `legenda`, `titulo`, `texto`,`categoria`) VALUES ('','$foto','$legenda','$titulo','$texto','$categoria')");

		echo "<meta http-equiv='refresh' content='0;URL=../estrutura.php'><script>alert('Insirido com sucesso!');</script>";

	}

	public function update()
	{
		$id = $_REQUEST['id'];
		
		$file1 = $_FILES['foto'];
		if($file1['name'] != '')
		{
			$ext = strtolower(substr($file1['name'],-4)); //Pegando extensão do arquivo
			$new_name = date("Y.m.d-H.i.s") . "1" . $ext; //Definindo um novo nome para o arquivo
			move_uploaded_file($file1['tmp_name'], '../fotos/'.$new_name); //Fazer upload do arquivo
	
			$foto=$new_name;
			$foto1 = "foto ='$foto',";
		}

		$legenda = $_POST['legenda'];		
		$titulo = $_POST['titulo'];
		$texto = $_POST['descricao'];
		$categoria = $_POST['categoria'];
		
		 $sql = "UPDATE estrutura SET $foto1 legenda = '$legenda', titulo = '$titulo', texto = '$texto', `categoria` = '$categoria' WHERE id = '$id' ";
		mysqli_query($this->main,$sql);

		echo "<meta http-equiv='refresh' content='0;URL=../estrutura.php'><script>alert('Alterado com sucesso!');</script>";
	}


	public function delete()
	{
		$id = $_REQUEST['var'];

		$sql = "DELETE FROM `estrutura` WHERE `id` = $id";
		$resultado = mysqli_query($this->main,$sql);

		echo "<meta http-equiv='refresh' content='0;URL=../estrutura.php'><script>alert('Foto excluída!');</script>";
	}
	
	public function delete_more()
	{
			foreach($_POST['opcao'] as $id)
			{
			    $sql = "DELETE FROM `estrutura` WHERE `id` = $id";
				$resultado = mysqli_query($this->main,$sql);
			}
				
		echo "<meta http-equiv='refresh' content='0;URL=../estrutura.php'><script>alert('Excluído com sucesso!');</script>";
	}
	
	
	public function banner()
	{
		$id = $_GET['id'];
		
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