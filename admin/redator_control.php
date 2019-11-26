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
        $this->dir_fotos = 'images/redatores/';
        $this->dir_fotos_large = '';

        $this->dir_fotos_medium = '';
        $this->dir_fotos_thumbnail = '';
    }

    public function inserir() {
        $simple = $this->simple;

        $dir_pasta = $this->dir_fotos;
        $dir_pasta_lg = $this->dir_fotos_large;

        $nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
        $cargo = trim(filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_STRING));
        $login = trim(filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING));
        $senha = trim(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING));
        $permissao = trim(filter_input(INPUT_POST, 'permissao', FILTER_SANITIZE_STRING));
   
        $content = array();
        $imagem = $_FILES['imagem']['name'];
        $ext = strtolower(substr($_FILES['imagem']['name'],-4));
        /* tipos aceitos */
        $types =array('.png', '.jpg','.gif','.PNG', '.JPG','.GIF');

        if(!in_array($ext, $types)):
            $formato_upper = strtoupper($ext);
        echo "<script>alert('Não foi possível realizar, formato \"$formato_upper\" inválido!');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=painel.php'>";
        die;
        endif;
        $imagem = $this->limpa_string_caracter_especial($imagem);

        if ($imagem != ""):
            $i = 1;
        $imagem_m =strtolower(substr($imagem,0,-4));
        while (file_exists($dir_pasta .$dir_pasta_lg. $imagem_m.$ext)) {
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

        $name_imagem = strtolower(substr($imagem,0,-4));
        move_uploaded_file($temp1, $dir_pasta.$dir_pasta_lg.$name_imagem.$ext);

        $content['foto'] = $name_imagem.$ext;

        $simple->table = array('admin');
        $content['nome'] = $nome;
        $content['cargo'] = $cargo;
        $content['login'] = $login;
        $content['senha'] = md5($senha);
        $content['permissao'] = $permissao;
        $simple->column = $content;
        $simple->insert();
        $simple->execute();

        $id_anuncios = $simple->insert_id();

        if ($id_anuncios == 0):
            echo "<script>alert('Não foi possível realizar');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=painel.php'>";

        die;
        endif;


        
        echo "<script>alert('Realizado com sucesso');</script>";
        
        echo "<meta http-equiv='refresh' content='0;redator_adm.php?id=" . $id_anuncios . "'>";
        die;
    }

    public function alterar() {
        $simple = $this->simple;

        $content = array();
        $dir_pasta = $this->dir_fotos;
        $dir_pasta_lg = $this->dir_fotos_large;


        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
        $cargo = trim(filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_STRING));
        $login = trim(filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING));
        $senha = trim(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING));
        $permissao = trim(filter_input(INPUT_POST, 'permissao', FILTER_SANITIZE_STRING));

        $imagem = $_FILES['imagem']['name'];


        if($imagem!=""){
            $ext = strtolower(substr($_FILES['imagem']['name'],-4));
            /* tipos aceitos */
            $types =array('.png', '.jpg','.gif','.PNG', '.JPG','.GIF');

            if(!in_array($ext, $types)){
                $formato_upper = strtoupper($ext);

                echo "<script>alert('Não foi possível realizar, formato \"$formato_upper\" inválido!');</script>";
                echo "<meta http-equiv='refresh' content='0;URL=painel.php'>";
                die;
            }
        }

        $imagem = $this->limpa_string_caracter_especial($imagem);

        if ($imagem != ""){
            $i = 1;
            $imagem_m =strtolower(substr($imagem,0,-4));
            while (file_exists($dir_pasta .$dir_pasta_lg. $imagem_m.$ext)) {
                $i = $i + 1;
                $imagem = $i . $imagem;
                $imagem_m = $i . $imagem_m;
            }
        }

        $temp1 = $_FILES['imagem']['tmp_name'];

        if ($imagem != ""){
            $name_imagem = strtolower(substr($imagem,0,-4));

            move_uploaded_file($temp1, $dir_pasta.$dir_pasta_lg.$name_imagem.$ext);
            $content['foto'] = $name_imagem.$ext;
            unlink($dir_pasta . $imagemantiga);     
        }



        $simple->table = array('admin');

        
        $content['nome'] = $nome;
        $content['cargo'] = $cargo;
        $content['login'] = $login;
        if(!empty($senha)){
        $content['senha'] = md5($senha);}
        
        $content['permissao'] = $permissao;

        $simple->column = $content;
        $simple->where = array('id' => $id);
        $simple->update();
        $simple->execute();


        if ($id == 0):
            echo "<script>alert('Não foi possível realizar');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=painel.php'>";
        die;
        endif;
        echo "<script>alert('Realizado com sucesso');</script>";
        echo "<meta http-equiv='refresh' content='0;" . ($_SERVER['HTTP_REFERER']) . "'>";
        die;
    }

    public function excluir() {
        $dir_pasta = $this->dir_fotos;
        $simple = $this->simple;

        $dir_fotos_large = $this->dir_fotos_large;

        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

        $simple->table = array('admin');
        $simple->column  = array("*");
        $simple->where = array('id' => $id);
        $simple->select();
        $query = $simple->execute();
        $row = mysqli_fetch_array($query);
        unlink($dir_pasta .$dir_fotos_large. $row['foto']);

        /* ----- */

        $simple->table = array('admin');
        $simple->where = 
        array('id' => $id);
        $simple->delete();
        $simple->sql;
        $simple->execute();

        echo "<script>alert('Realizado com sucesso');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=" . ($_SERVER['HTTP_REFERER']) . "'>";
    }


    public function limpa_string_caracter_especial($control) {
        /* 24 de junho 2016 @D */
        $string = iconv('UTF-8', 'ASCII//TRANSLIT', $control);
        $string_space = preg_replace("/[\s]/", "-", $string);
        return preg_replace("/[^a-zA-Z0-9-.+]/", "", $string_space);
    }

}
