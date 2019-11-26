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
        $this->dir_fotos = 'images/materias/';
        $this->dir_fotos_large = 'large/';
        $this->dir_fotos_medium = 'medium/';
        $this->dir_fotos_thumbnail = 'thumbnail/';
    }

    public function inserir() {

        $redator = $this->simple;
        $login = $_SESSION["user"];
        $queryredator = $redator->execute("SELECT * FROM admin WHERE login = '$login'");
        $rowredator = mysqli_fetch_assoc($queryredator);
        $redator = $rowredator['id'];

        $simple = $this->simple;
        $dir_pasta = $this->dir_fotos;
        $dir_pasta_lg = $this->dir_fotos_large;
        $dir_pasta_md = $this->dir_fotos_medium;
        $dir_pasta_th = $this->dir_fotos_thumbnail;

        $titulo = trim(filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING));
        $subtitulo = trim(filter_input(INPUT_POST, 'subtitulo', FILTER_SANITIZE_STRING));
        $data = trim(filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING));
        $descricao = trim(str_replace('&nbsp;', " ", $_POST['descricao']) and str_replace("'", "\'", $_POST['descricao']));

       
        $titulo = trim(filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING));
        $subtitulo = trim(filter_input(INPUT_POST, 'subtitulo', FILTER_SANITIZE_STRING));
        $data = trim(filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING));
        $descricao = trim(str_replace('&nbsp;', " ", $_POST['descricao']));

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
        while (file_exists($dir_pasta .$dir_pasta_th. $imagem_m.$ext)) {
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
        move_uploaded_file($temp1, $dir_pasta . $imagem);


        $image = new \abeautifulsite\SimpleImage();

        $image
        ->fromFile($dir_pasta.$imagem)
        ->bestFit(250, 250)
        ->toFile($dir_pasta.$dir_pasta_th.$name_imagem.$ext);

        $image
        ->fromFile($dir_pasta.$imagem)
        ->bestFit(600, 600)
        ->toFile($dir_pasta.$dir_pasta_md.$name_imagem.$ext);

        $image
        ->fromFile($dir_pasta.$imagem)
        ->bestFit(1200, 1200)
        ->toFile($dir_pasta.$dir_pasta_lg.$name_imagem.$ext);

        unlink($dir_pasta . $imagem);
        $content['imagem'] = $name_imagem.$ext;


        $simple->table = array('materias');
        $content['titulo'] = $titulo;
        $content['subtitulo'] = $subtitulo;
        $dataarray = explode(' ',str_replace('/','-',$data));               
        $content['data'] = date('Y-m-d', strtotime($dataarray[0])).' '.$dataarray[1];
        $content['descricao'] = $descricao;
        $content['redator'] = $redator;
        $simple->column = $content;
        $simple->insert();
        $simple->execute();

        $id_anuncios = $simple->insert_id();
        if ($id_anuncios == 0):
            echo "<script>alert('Não foi possível realizar');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=painel.php'>";

        die;
        endif;


        /*atualizado tags */
        $tagTable = "tag_materia";

        $tag = new Simple_Mysql();

        $tag->table = array($tagTable);
        $tag->where = array(
            'idMateria'=>$id_anuncios,
            );
        $tag->delete();
        $tag->execute();

        if(isset($_POST['tagAdd'])){
            foreach ($_POST['tagAdd'] as $value) {
                $tag->execute("INSERT IGNORE INTO $tagTable (idMateria,idTag) VALUES ($id_anuncios,$value)");
            }
        }


        
        echo "<script>alert('Realizado com sucesso');</script>";
        
        echo "<meta http-equiv='refresh' content='0;materia_adm_tag.php?id=" . $id_anuncios . "'>";
        die;
    }

    public function alterar() {
        $simple = $this->simple;

        $content = array();
        $dir_pasta = $this->dir_fotos;
        $dir_pasta_lg = $this->dir_fotos_large;
        $dir_pasta_md = $this->dir_fotos_medium;
        $dir_pasta_th = $this->dir_fotos_thumbnail;

        $tagTable = "tag_materia";

        $tag = new Simple_Mysql();

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $titulo = trim(filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING));
        $subtitulo = trim(filter_input(INPUT_POST, 'subtitulo', FILTER_SANITIZE_STRING));
        $data = trim(filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING));
        $descricao = trim(str_replace('&nbsp;', " ", $_POST['descricao']));
        $imagemantiga = trim(filter_input(INPUT_POST, 'imagemantiga', FILTER_SANITIZE_STRING));

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
            while (file_exists($dir_pasta .$dir_pasta_th. $imagem_m.$ext)) {
                $i = $i + 1;
                $imagem = $i . $imagem;
                $imagem_m = $i . $imagem_m;
            }
        }

        $temp1 = $_FILES['imagem']['tmp_name'];



        if ($imagem != ""){
            $name_imagem = strtolower(substr($imagem,0,-4));

            move_uploaded_file($temp1, $dir_pasta . $imagem);


            $image = new \abeautifulsite\SimpleImage();

            $image
            ->fromFile($dir_pasta.$imagem)
            ->bestFit(250, 250)
            ->toFile($dir_pasta.$dir_pasta_th.$name_imagem.$ext);

            $image
            ->fromFile($dir_pasta.$imagem)
            ->bestFit(400, 400)
            ->toFile($dir_pasta.$dir_pasta_md.$name_imagem.$ext);

            $image
            ->fromFile($dir_pasta.$imagem)
            ->bestFit(1200, 1200)
            ->toFile($dir_pasta.$dir_pasta_lg.$name_imagem.$ext);

            unlink($dir_pasta . $imagem);
            $content['imagem'] = $name_imagem.$ext;
            unlink($dir_pasta . $dir_pasta_lg . $imagemantiga);
            unlink($dir_pasta . $dir_pasta_md . $imagemantiga);
            unlink($dir_pasta . $dir_pasta_th . $imagemantiga);
        }


        $simple->table = array('materias');

        $content['titulo'] = $titulo;
        $content['subtitulo'] = $subtitulo;

        $dataarray = explode(' ',str_replace('/','-',$data));               
        $content['data'] = date('Y-m-d', strtotime($dataarray[0])).' '.$dataarray[1];

        $content['descricao'] = $descricao;
        $content['atualizadodata'] = date('Y-m-d H:i:s');

        $simple->column = $content;
        $simple->where = array('id' => $id);
        $simple->update();
        $simple->execute();


        /*atualizado tags */

        $tag->table = array($tagTable);
        $tag->where = array(
            'idMateria'=>$id,);
        $tag->delete();
        $tag->execute();
        
        
        if(isset($_POST['tagAdd'])){
            foreach ($_POST['tagAdd'] as $value) {
                $tag->execute("INSERT IGNORE INTO $tagTable (idMateria,idTag) VALUES ($id,$value)");
            }
        }


        if ($id == 0):
            echo "<script>alert('Não foi possível realizar');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=painel.php'>";
        die;
        endif;
        echo "<script>alert('Realizado com sucesso');</script>";
        echo "<meta http-equiv='refresh' content='0;" . ($_SERVER['HTTP_REFERER']) . "'>";
        die;
    }

    public function destaque() {
        $simple = $this->simple;
        $id = trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING));
        if ($id == 0):
            echo "<script>alert('Não foi possível realizar');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=painel.php'>";
        die;
        endif;


        $content = array();
        $simple->table = array('materias');
        $content['destaque'] = 1;
        // $content['destaque_date'] = date('Y-m-d');
        $simple->column = $content;
        $simple->where = 
        array('id' => $id);
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

    public function semdestaque() {
        $simple = $this->simple;
        $id = trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING));
        if ($id == 0):
            echo "<script>alert('Não foi possível realizar');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=painel.php'>";
        die;
        endif;


        $content = array();
        $simple->table = array('materias');
        $content['destaque'] = 0;
        // $content['destaque_date'] = date('Y-m-d');
        $simple->column = $content;
        $simple->where = 
        array('id' => $id);
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

    public function sempromocao() {
        $simple = $this->simple;
        $id = trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING));
        if ($id == 0):
            echo "<script>alert('Não foi possível realizar');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=painel.php'>";
        die;
        endif;


        $content = array();
        $simple->table = array('materias');
        $content['promocao'] = 0;
        $content['promocao_date'] = '0000-00-00';
        $simple->column = $content;
        $simple->where = 
        array('id' => $id);
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

    public function promover() {
        $simple = $this->simple;
        $id = trim(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING));
        $precoantigo = trim(filter_input(INPUT_POST, 'precoantigo', FILTER_SANITIZE_STRING));
        if ($id == 0):
            echo "<script>alert('Não foi possível realizar');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=painel.php'>";
        die;
        endif;


        $content = array();
        $valor = trim(str_replace(',', ".", trim($_POST['valor'])));
        $simple->table = array('materias');
        $content['promocao'] = 1;
        $content['promocao_date'] = date('Y-m-d');
        $content['preco'] = $valor;
        $content['precoantigo'] = $precoantigo;
        $simple->column = $content;
        $simple->where = 
        array('id' => $id);
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
        $dir_fotos_medium = $this->dir_fotos_medium;
        $dir_fotos_thumbnail = $this->dir_fotos_thumbnail;

        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

        $simples = new Simple_Mysql();
        $simples->table = array('materias');
        $simples->column = array('*');
        $simples->where = 
        array('id' => $id);
        $simples->select();

        $querys = $simples->execute();

        $imagens = mysqli_fetch_array($querys);

        $data123 = $imagens['imagem'];

        if (file_exists($dir_pasta . $dir_fotos_thumbnail . $data123)):
            unlink($dir_pasta . $dir_fotos_thumbnail . $data123);
        endif;

        if (file_exists($dir_pasta . $dir_fotos_medium . $data123)):
            unlink($dir_pasta . $dir_fotos_medium . $data123);
        endif;

        if (file_exists($dir_pasta . $dir_fotos_large . $data123)):
            unlink($dir_pasta . $dir_fotos_large . $data123);
        endif;        

        $simple->table = array('materias');
        $simple->where = 
        array('id' => $id);
        $simple->delete();
        $simple->execute();

        $tag_produto = new Simple_Mysql();
        $tag_produto->table = array('tag_produto');
        $tag_produto->column = array('*');
        $tag_produto->where = array('idProduto' => $id);
        $tag_produto->delete();
        $querys = $tag_produto->execute();

        echo "<script>alert('Realizado com sucesso');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=" . ($_SERVER['HTTP_REFERER']) . "'>";
    }

    public function buscaPorTag() {

        $build_query = array();
        if(isset($_POST['tagAdd'])){
            $tagsFiltre = filter_var_array($_POST['tagAdd'], FILTER_SANITIZE_NUMBER_INT);
            $build_query['tags']  = implode('|', $tagsFiltre);

        }else{

        }

        echo http_build_query($build_query);

        header('Location:materia_busca_result.php?'.http_build_query($build_query));
    }


    public function inseririmagem() {
        $name_imagem ="";
        $simple = $this->simple;
        $dir_pasta = $this->dir_fotos;
        $dir_pasta_lg = $this->dir_fotos_large;
        $dir_pasta_md = $this->dir_fotos_medium;
        $dir_pasta_th = $this->dir_fotos_thumbnail;

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
        while (file_exists($dir_pasta .$dir_pasta_th. $imagem_m.$ext)) {
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
            $name_imagem = strtolower(substr($imagem,0,-4));
        move_uploaded_file($temp1, $dir_pasta . $imagem);


        $image = new \abeautifulsite\SimpleImage();

        $image
        ->fromFile($dir_pasta.$imagem)
        ->bestFit(250, 250)
        ->toFile($dir_pasta.$dir_pasta_th.$name_imagem.$ext);

        $image
        ->fromFile($dir_pasta.$imagem)
        ->bestFit(400, 400)
        ->toFile($dir_pasta.$dir_pasta_md.$name_imagem.$ext);

        $image
        ->fromFile($dir_pasta.$imagem)
        ->bestFit(1200, 1200)
        ->toFile($dir_pasta.$dir_pasta_lg.$name_imagem.$ext);

        unlink($dir_pasta . $imagem);
        $content['imagem'] = $name_imagem.$ext;
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

    public function alterarimagem() {
        $simple = $this->simple;

        $dir_pasta_lg = $this->dir_fotos_large;
        $dir_pasta_md = $this->dir_fotos_medium;
        $dir_pasta_th = $this->dir_fotos_thumbnail;

        $id_img = trim(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING));
        $imagemantiga = trim(filter_input(INPUT_POST, 'imagemantiga', FILTER_SANITIZE_STRING));

        if ($imagemantiga == ''):
            echo "<script>alert('Não foi possível realizar');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=painel.php'>";
        die;
        endif;

        $content = array();
        $simple->table = array('imagens');
        $dir_pasta = $this->dir_fotos;
        $imagem = $_FILES['imagem']['name'];
        $temp = $_FILES['imagem']['tmp_name'];
        $imagem = $this->limpa_string_caracter_especial($imagem);

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

        if ($imagem != ""):
            $i = 1;
        $imagem_m =strtolower(substr($imagem,0,-4));
        while (file_exists($dir_pasta . $dir_pasta_th. $imagem_m.$ext)) {
            $i = $i + 1;
            $imagem = $i . $imagem;
            $imagem_m = $i . $imagem_m;
        }

        if ($imagemantiga != ""):

            $name_imagem = strtolower(substr($imagem,0,-4));
        move_uploaded_file($temp, $dir_pasta . $imagem);

        $image = new \abeautifulsite\SimpleImage();

        $image
        ->fromFile($dir_pasta.$imagem)
        ->bestFit(300, 300)
        ->toFile($dir_pasta.$dir_pasta_th.$name_imagem.$ext);

        $image
        ->fromFile($dir_pasta.$imagem)
        ->bestFit(400, 400)
        ->toFile($dir_pasta.$dir_pasta_md.$name_imagem.$ext);

        $image
        ->fromFile($dir_pasta.$imagem)
        ->bestFit(1200, 1200)
        ->toFile($dir_pasta.$dir_pasta_lg.$name_imagem.$ext);

        unlink($dir_pasta . $imagem);
        $content['imagem'] = $name_imagem.$ext;
        unlink($dir_pasta . $dir_pasta_lg . $imagemantiga);
        unlink($dir_pasta . $dir_pasta_md . $imagemantiga);
        unlink($dir_pasta . $dir_pasta_th . $imagemantiga);
        endif;

        else:
            echo "<script>alert('Não foi possível realizar');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=painel.php'>";
        die;
        endif;


        $simple->column = $content;
        $simple->where = array('id' => $id_img);
        $simple->update();
        $simple->execute();

        if ($id_img == 0):
            echo "<script>alert('Não foi possível realizar');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=painel.php'>";
        die;


        endif;
        echo "<script>alert('Realizado com sucesso');</script>";
        echo "<meta http-equiv='refresh' content='0;URL=" . ($_SERVER['HTTP_REFERER']) . "'>";
        ;
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
        unlink($dir_pasta . $dir_fotos_large . $data1);
        unlink($dir_pasta . $dir_fotos_medium . $data1);
        unlink($dir_pasta . $dir_fotos_thumbnail . $data1);
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
