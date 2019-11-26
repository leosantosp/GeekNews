<?php

//error_reporting(0);
date_default_timezone_set("Brazil/East");
require_once 'class/conexao.php';
require_once 'class/Simple_Mysql.php';
require_once 'class/SimpleImage.php';

$l = new conexao();
$l->manter();

$l = new conexao();
$l->manter();
$conn = $l->getconexao();

if (isset($_GET['acao'])) {
	$control = filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_STRING);
} else {
	$control = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);
}

$classe = new crud();

/* 24 de junho 2016 @D */
$string = iconv('UTF-8', 'ASCII//TRANSLIT', $control);
$string_space = preg_replace("/[\s]/", "-", $string);
$control = preg_replace("/[^a-zA-Z0-9+]/", "", $string_space);

if (method_exists('crud', $control)):
	$classe->$control();
else:
	echo "<meta http-equiv='refresh' content='0;URL=painel.php'>";
die;
endif;
?>

<?php

class crud {

	private $simple;
	private $dir_fotos;

	public function __construct() {
		$this->simple = new Simple_Mysql();
		$this->dir_fotos = 'images/';
		$this->dir_fotos_large = 'large/';
		$this->dir_fotos_medium = 'medium/';
		$this->dir_fotos_thumbnail = 'thumbnail/';
	}


	public function inseririmagem() {
		$name_imagem ="";
		$simple = $this->simple;
		$dir_pasta = $this->dir_fotos;


		$copia_correcao = date("YmdHis");
		$identificacao = trim(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING));

		$content = array();
		$simple->table = array('imagens');
		$content['identificacao'] = $identificacao;
		$imagem = $_FILES['imagem']['name'];

		if($imagem!=""):

			$ext = strtolower(substr($_FILES['imagem']['name'],-4));
		/* tipos aceitos */
		$types =array('.png', '.jpg','.gif','.PNG', '.JPG','.GIF');

		if(!in_array($ext, $types)):
			$formato_upper = strtoupper($ext);
		echo "<script>alert('Não foi possível realizar, formato \"$formato_upper\" inválido!');</script>";
		echo "<meta http-equiv='refresh' content='0;URL=painel.php'>";
		die;
		endif;
		endif;

		$imagem = $this->limpa_string_caracter_especial($imagem);
		if ($imagem != ""):
			$i = 1;
		$imagem_m =strtolower(substr($imagem,0,-4));
		while (file_exists($dir_pasta . $imagem_m.$ext)) {
			$i = $i + 1;
			$imagem = $i . $imagem;
			$imagem_m = $i . $imagem_m;
		}
		else:
			echo "<script>alert('Não foi possível realizar');</script>";
		echo "<meta http-equiv='refresh' content='0;URL=painel.php'>";

		die;
		endif;

		$temp1 = $_FILES['imagem']['tmp_name'];



		if ($imagem != ""):
		move_uploaded_file($temp1, $dir_pasta . $imagem_m.$ext);


		$content['imagem'] = $imagem_m.$ext;
		endif;

		$simple->column = $content;
		$simple->insert();
		$simple->execute();
		$id_imagem = $simple->insert_id();


		if ($id_imagem == 0):
			echo "<script>alert('Não foi possível realizar');</script>";
		echo "<meta http-equiv='refresh' content='0;URL=painel.php'>";

		die;
		endif;
		echo "<script>alert('Realizado com sucesso');</script>";
		echo "<meta http-equiv='refresh' content='0;" . ($_SERVER['HTTP_REFERER']) . "#maisimagens'>";
		die;
	}


	public function excluirimagem() {
		$dir_pasta = $this->dir_fotos;
		$simple = $this->simple;

		$dir_fotos_large = $this->dir_fotos_large;
		$dir_fotos_medium = $this->dir_fotos_medium;
		$dir_fotos_thumbnail = $this->dir_fotos_thumbnail;

		$data1 = filter_input(INPUT_GET, 'imagem', FILTER_SANITIZE_STRING);
		$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
		$simple->table = array('imagens');
		$simple->where = array('id' => $id);

		$simple->delete();
		$simple->execute();

		unlink($dir_pasta . $data1);
		echo "<meta http-equiv='refresh' content='0;URL=" . ($_SERVER['HTTP_REFERER']) . "'>";
		die;
	}

	public function limpa_string_caracter_especial($control) {
		/* 24 de junho 2016 @D */
		$string = iconv('UTF-8', 'ASCII//TRANSLIT', $control);
		$string_space = preg_replace("/[\s]/", "-", $string);
		return preg_replace("/[^a-zA-Z0-9-.+]/", "", $string_space);
	}

}
