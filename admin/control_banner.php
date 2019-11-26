<?php
;
require('class/conexao.php');
$l = new conexao();
$l->manter();
$id = $_POST['img'];
$url = '';
if($_POST['url']!=''):
$url =  $_POST['url'];
endif;

if(isset($_POST['retirarurl'])):
    $urls =  $_POST['retirarurl'];
    else:
    $urls =  false;
endif;

$l = new conexao();
$l->manter();
$conn = $l->getconexao();

		$sqls = "SELECT * FROM banner WHERE id = $id";

		$querys = mysqli_query($conn,$sqls);
		$rows = mysqli_fetch_array($querys);
		 $nome= $rows['nome'];



date_default_timezone_set("Brazil/East"); //Definindo timezone padrão
 
      $ext = strtolower(substr($_FILES['fileUpload']['name'],-4)); //Pegando extensão do arquivo

		$new_name = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo

		$dir = 'images/'; //Diretório para uploads
 
		move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo
 $sql_url='';
if($_POST['url']!=''&&!$url):
    $url =  $_POST['url'];
    $sql_url =",url='$urls'";
    else:
    $sql_url =",url=''";
endif;
 $sql = "UPDATE banner SET nome='$new_name' $sql_url WHERE id = $id";

		mysqli_query($conn,$sql);

		unlink($dir.$nome);
echo "<meta http-equiv='refresh' content='0;URL=banner.php'>";
