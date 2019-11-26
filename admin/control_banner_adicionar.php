<?php
header('Content-Type: text/html; charset=utf-8');
require('class/conexao.php');
$url = '';
$l = new conexao();
$l->manter();
$conn = $l->getconexao();



date_default_timezone_set("Brazil/East"); //Definindo timezone padrão
 
      $ext = strtolower(substr($_FILES['fileUpload']['name'],-4)); //Pegando extensão do arquivo

		$new_name = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo

		$dir = 'images/'; //Diretório para uploads
 
		move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo
 	

if($_POST['url']!=''):
    $url =  $_POST['url'];
endif;
  $sql = "INSERT INTO `banner` (`nome`, `url`) VALUES ('$new_name', '$url')";

		mysqli_query($conn,$sql);
echo "<meta http-equiv='refresh' content='0;URL=banner.php'>";
