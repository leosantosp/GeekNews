<?php
session_start();
require('conexao.php');

$l = new conexao();
$l->manter();
$conn = $l->getconexao();

$id = $_POST['id'];
$destaque = $_POST['destaque'];

 $sql = "UPDATE destaque SET id_p ='$id' WHERE id = $destaque";
 mysqli_query($conn,$sql);


echo "<meta http-equiv='refresh' content='0;URL=../destaque.php'>";

?>