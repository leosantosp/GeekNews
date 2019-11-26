<?php

require('class/conexao.php');
header('Content-Type: text/html; charset=utf-8');
$id = $_POST['img'];
//$url = $_POST['url'];
$l = new conexao();
$l->manter();
$conn = $l->getconexao();

$sql_check = "SELECT * FROM banner";
$query_check  = mysqli_query($conn,$sql_check);
$numero_de_banners = mysqli_num_rows($query_check);
$dir = 'images/'; //Diretório para uploads
if($numero_de_banners!=1):
    $sqls = "SELECT * FROM banner WHERE id = $id";
    $querys = mysqli_query($conn,$sqls);
    $rows = mysqli_fetch_array($querys);
    $nome= $rows['nome'];

    $sql = "DELETE FROM banner WHERE id = $id";
    mysqli_query($conn,$sql);
    unlink($dir.$nome);
    echo "<script>alert('Excluído');</script>";

else:
        echo "<script>alert('Não foi excluído, mantenha ao menos um banner');</script>";
endif;

echo "<meta http-equiv='refresh' content='0;URL=banner_excluir.php'>";

?>