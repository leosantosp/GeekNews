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

$classe = new crud();
$classe->$control();
?>

<?php
class crud{
	private $main;
	public function __construct()
	{
		$l = new conexao();
		$l->manter();
		$this->main = $l->getconexao();
	}

	public function update()
	{
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $valor = trim(filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_STRING));
        $frete_valor_gratis = trim(str_replace(',', ".",$valor ));
		$sql = "UPDATE frete_estado SET frete_valor_gratis = '$frete_valor_gratis' WHERE id = '$id' ";
		mysqli_query($this->main,$sql);

		echo "<meta http-equiv='refresh' content='0;URL=".($_SERVER['HTTP_REFERER'])."'><script>alert('Alterado com sucesso!');</script>";
	}

	public function updateChave()
	{
        $chave = filter_input(INPUT_POST, 'chave', FILTER_SANITIZE_STRING);
        $valor = trim(filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_STRING));
        $valor = trim(str_replace(',', ".",$valor ));
		$sql = "UPDATE config SET valor = '$valor' WHERE chave = '$chave' ";
		mysqli_query($this->main,$sql);

		echo "<meta http-equiv='refresh' content='0;URL=".($_SERVER['HTTP_REFERER'])."'><script>alert('Alterado com sucesso!');</script>";
	}

	

}
?>