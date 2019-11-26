<?php
session_start();
require('admin/class/conexao.php');

$login= new conexao();
$l = new conexao();
$conn = $l->getconexao();

?>
<?php
if(isset($_POST['nome']))
{
	$nome = $_POST['nome'];
}else
{
	$nome = 'Anônimo';
}

$comentario = $_POST['comentario'];
$artigo = $_POST['artigo'];
$status = 0;
$tipo = $_POST['tipo'];

mysqli_query($conn,"INSERT INTO `comentarios`(`id`, `nome`, `comentario`, `artigo`, `status`, `tipo`) VALUES ('','$nome','$comentario','$artigo','$status','$tipo')");

//echo "<meta http-equiv='refresh' content='0;URL='>";
?>
<script>
javascript:window.history.go(-1);
</script>