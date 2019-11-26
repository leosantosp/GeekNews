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
		
		$titulo = $_POST['titulo'];

		mysqli_query($this->main,"INSERT INTO `imagem`(`id`, `foto`, `titulo`) VALUES ('','$foto','$titulo')");

		echo "<meta http-equiv='refresh' content='0;URL=../imagem.php'><script>alert('Insirido com sucesso!');</script>";

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
	
		$titulo = $_POST['titulo'];
		
		 $sql = "UPDATE imagem SET $foto1 titulo = '$titulo' WHERE id = '$id' ";
		mysqli_query($this->main,$sql);

		echo "<meta http-equiv='refresh' content='0;URL=../imagem.php'><script>alert('Alterado com sucesso!');</script>";
	}


	public function delete()
	{
		$id = $_REQUEST['var'];

		$sql = "DELETE FROM `imagem` WHERE `id` = $id";
		$resultado = mysqli_query($this->main,$sql);

		echo "<meta http-equiv='refresh' content='0;URL=../imagem.php'><script>alert('Foto excluída!');</script>";
	}
}
?>