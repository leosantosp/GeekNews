<?php
//error_reporting(0);
date_default_timezone_set("Brazil/East");
require_once 'class/conexao.php';
require_once 'class/Simple_Mysql.php';
require_once 'class/Persistence.php';
require_once 'class/SimpleImage.php';
$log = new conexao();
$log->manter();
if(isset($_GET['acao']))
	{
		$control = filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_STRING);
	}
else
	{
		$control = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);	
	}
	
$classe = new curso();

    /* 24 de junho 2016 @D*/
    $string = iconv('UTF-8', 'ASCII//TRANSLIT', $control);
    $string_space = preg_replace("/[\s]/", "-", $string);
    $control =  preg_replace("/[^a-zA-Z0-9+]/", "", $string_space);

if(method_exists('curso',$control)):
    $classe->$control();
else:
    		echo "<meta http-equiv='refresh' content='0;URL=".conexao::DIRETORIO_SITE."index/'>"; 
                    die;
endif;
?>

<?php
class curso{
    
	private $simple;
	protected $data_anuciante;
        private $dir_pasta;
        private $dir_fotos;
        
        public function __construct(){
      		$this->simple =  new Simple_Mysql();
      		$this->dir_fotos = 'fotos/';

      	}

        public function alterarestatico(){
            $simple = $this->simple;
              $chave = trim(filter_input(INPUT_POST, 'chave', FILTER_SANITIZE_STRING));
            if($chave==null):
                echo "<script>alert('Não foi possível realizar');</script>";
                echo "<meta http-equiv='refresh' content='0;URL=painel.php'>"; 
                die;
            endif;
             $conteudo = trim(str_replace('&nbsp;', " ", $_POST['conteudo']));
             $content=array();
            $simple->table = array('estatico');
            $content['conteudo']=$conteudo;
            
            $simple->column =$content;
            $simple->where =array('chave'=>$chave);
            $simple->update();
            $simple->sql;
            $simple->execute();
                echo "<script>"
                . "window.history.back();"
                    . "</script>";
                die;
        }


}
 