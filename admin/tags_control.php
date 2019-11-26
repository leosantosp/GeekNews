<?php

//error_reporting(0);
date_default_timezone_set("Brazil/East");
require_once 'class/conexao.php';
require_once 'class/Simple_Mysql.php';
require_once 'class/SimpleImage.php';

$l = new conexao();
$l->manter();

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
        $this->dir_fotos = 'images/produto/';
        $this->dir_fotos_tags= 'tags/';
        $this->prefix = 'tags';
        $this->table = 'tags';
    }

    public function inserir() {
        $content = array();
        $simple = $this->simple;
        $dir_pasta = $this->dir_fotos;
        $dir_fotos_tags = $this->dir_fotos_tags;

        $nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
        $descricao = trim(str_replace('&nbsp;', " ", $_POST['descricao']));
        $imagem ='';
        if(isset($_FILES['imagem']['name'])){
            $imagem = $_FILES['imagem']['name'];
        }


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


        if ($imagem != ""):
            $i = 1;
        $imagem_m =strtolower(substr($imagem,0,-4));
        while (file_exists($dir_pasta .$dir_fotos_tags. $imagem_m.$ext)) {
            $i = $i + 1;
            $imagem = $i . $imagem;
            $imagem_m = $i . $imagem_m;
        }
        endif;
        
        $temp1='';
        if(isset($_FILES['imagem']['tmp_name'])){
            $temp1 = $_FILES['imagem']['tmp_name'];
        }

        if ($imagem != ""):
            $name_imagem = strtolower(substr($imagem,0,-4));
        move_uploaded_file($temp1, $dir_pasta . $imagem);


        $image = new \abeautifulsite\SimpleImage();

        $image
        ->fromFile($dir_pasta.$imagem)
        ->bestFit(250, 250)
        ->toFile($dir_pasta.$dir_fotos_tags.$name_imagem.$ext);


        unlink($dir_pasta . $imagem);
        $content['imagem'] = $name_imagem.$ext;
        endif;

        $simple->table = array($this->table);
        $content['nome'] = $nome;
        $content['descricao'] = $descricao;


        $simple->column = $content;
        $simple->insert();
        $simple->execute();

        $id_table = $simple->insert_id();
        if ($id_table == 0):
            echo "<script>alert('Não foi possível realizar');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=painel.php'>";

        die;
        endif;
        echo "<script>alert('Realizado com sucesso');</script>";
        echo "<meta http-equiv='refresh' content='0;".$this->prefix."_adm.php?id=" . $id_table . "'>";
        die;
    }

    public function alterar() {
        $content = array();
        $simple = $this->simple;
        $dir_pasta = $this->dir_fotos;
        $dir_fotos_tags = $this->dir_fotos_tags;
        $table = $this->table;

        

        $id = trim(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING));
        $nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
        $imagemantiga = trim(filter_input(INPUT_POST, 'imagemantiga', FILTER_SANITIZE_STRING));
        $descricao = trim(str_replace('&nbsp;', " ", $_POST['descricao']));
        $imagem = (isset($_FILES['imagem']['name']))?$_FILES['imagem']['name']:'';
        $temp =  (isset($_FILES['imagem']['tmp_name']))?$_FILES['imagem']['tmp_name']:'';
        $imagem = $this->limpa_string_caracter_especial($imagem);


        if($imagem!=""){
            $ext = strtolower(substr($_FILES['imagem']['name'],-4));
            /* tipos aceitos */
            $types =array('.png', '.jpg','.gif','.PNG', '.JPG','.GIF');

            if(!in_array($ext, $types)):
                $formato_upper = strtoupper($ext);
            echo "<script>alert('Não foi possível realizar, formato \"$formato_upper\" inválido!');</script>";
            echo "<meta http-equiv='refresh' content='0;URL=painel.php'>";
            die;
            endif;

            $i = 1;

            $imagem_m =strtolower(substr($imagem,0,-4));
            while (file_exists($dir_pasta . $dir_fotos_tags. $imagem_m.$ext)) {
                $i = $i + 1;
                $imagem = $i . $imagem;
                $imagem_m = $i . $imagem_m;
            }

            if ($imagemantiga != ""){
                unlink($dir_pasta . $imagemantiga);
            }


            $name_imagem = strtolower(substr($imagem,0,-4));
            move_uploaded_file($temp, $dir_pasta . $imagem);

            $image = new \abeautifulsite\SimpleImage();

            $image
            ->fromFile($dir_pasta.$imagem)
            ->bestFit(250, 250)
            ->toFile($dir_pasta.$dir_fotos_tags.$name_imagem.$ext);

            unlink($dir_pasta . $imagem);
            $content['imagem'] = $name_imagem.$ext;


        }

        if(isset($_POST['removerCheck'])){
            unlink($dir_pasta . $dir_fotos_tags . $imagemantiga );
            $content['imagem'] = '';
        }

        $content['nome'] = $nome;
        $content['descricao'] = $descricao;

        $simple->column = $content;
        $simple->table = array($table);
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
        $simple = $this->simple;
        $dir_pasta = $this->dir_fotos;
        $dir_fotos_tags = $this->dir_fotos_tags;
        $table = $this->table;

        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);


        /*  pesquisar imagens */
        $imagen_dele = new Simple_Mysql();
        $imagen_dele->table = array($table);
        $imagen_dele->column = array('*');
        $imagen_dele->where = array('id' => $id);
        $imagen_dele->select();
        $querys = $imagen_dele->execute();
        $rowImage = mysqli_fetch_array($querys);
        $imagem = $rowImage['imagem'];
        if($imagem!=''){
            unlink($dir_pasta . $dir_fotos_tags . $imagem);
        }
        /* pesquisar imagens */

        $simple->table = array($table);
        $simple->column = array('*');
        $simple->where =  array('id' => $id);
        $simple->delete();
        $simple->execute();

        /*  Exclui tag dos produtos */
        $tag_produto = new Simple_Mysql();
        $tag_produto->table = array('tag_produto');
        $tag_produto->column = array('*');
        $tag_produto->where = array('idTag' => $id);
        $tag_produto->delete();
        $querys = $tag_produto->execute();
        /*  Exclui tag dos produtos */

        /*  Exclui tag dos produtos */
        $tag_tag = new Simple_Mysql();
        $tag_tag->table = array('tag_tag');
        $tag_tag->column = array('*');
        $tag_tag->where = array('idTagParent' => $id, 'OR', 'idTagChild' => $id, );
        $tag_tag->delete();
        $querys = $tag_tag->execute();
        /*  Exclui tag dos produtos */

        /*  Exclui tag dos produtos */
        $tag_menu = new Simple_Mysql();
        $tag_menu->table = array('tag_menu');
        $tag_menu->column = array('*');
        $tag_menu->where = array('idTag' => $id, );
        $tag_menu->delete();
        $querys = $tag_menu->execute();
        /*  Exclui tag dos produtos */

        echo "<script>alert('Realizado com sucesso');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=" . ($_SERVER['HTTP_REFERER']) . "'>";
    }


    public function tagAssoc() {

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

        $tagTable = "tag_tag";

        $tag = new Simple_Mysql();
        $tag->table = array($tagTable);
        $tag->where = array(
            'idTagParent' => $id
            );
        $tag->delete();
        $tag->execute();

        if(isset($_POST['tagAdd'])){
            foreach ($_POST['tagAdd'] as $value) {
                $tag->execute("INSERT INTO $tagTable (idTagParent,idTagChild) VALUES ($id,$value)");
            }
        }

        echo "<script>alert('Realizado com sucesso');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=" . ($_SERVER['HTTP_REFERER']) . "'>";

    }


    public function tagAssocMenu() {



        $tagTable = "tag_menu";

        $tag = new Simple_Mysql();
        if(isset($_POST['tagRvm'])){
          foreach ($_POST['tagRvm'] as $value) {


            $tag->table = array($tagTable);
            $tag->where = array('idTag' => $value);
            $tag->delete();
            $tag->execute();
        }
    }
    if(isset($_POST['tagAdd'])){
        foreach ($_POST['tagAdd'] as $value) {
            $tag->execute("DELETE FROM $tagTable WHERE  `idTag`=$value");
            $tag->execute("INSERT IGNORE INTO $tagTable (idTag) VALUES ($value)");
        }
    }

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
