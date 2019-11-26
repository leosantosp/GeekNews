<?php
date_default_timezone_set("Brazil/East");
require 'class/conexao.php';
require 'class/Simple_Mysql.php';


$l = new conexao();
$l->manter();
$conn = $l->getconexao();
$id_adm = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$dir_fotos = 'images/produto/';
$dir_fotos_tags= 'tags/';
$prefix = 'tag';
$table = 'tags';

/* imagens pastas */
$dir_fotos_large = 'large/';
$dir_fotos_medium = 'medium/';
$dir_fotos_thumbnail = 'thumbnail/';

/* Tags de Categoria */
$sqlTag = "SELECT * FROM $table";
$queryTag = mysqli_query($conn,$sqlTag);
$arrayTag = array();
while($rowTag = mysqli_fetch_array($queryTag)){ 
if($rowTag['id']!= $id_adm){
  $arrayTag[$rowTag['id']]=$rowTag;
}

}

/* Tags de Produto */
$arrayTagProduto = array();
if($id_adm!=''){
  $sqlTagProduto = "SELECT * FROM tag_tag WHERE idTagParent =  $id_adm ";
  $queryTagProduto = mysqli_query($conn,$sqlTagProduto);

  while($rowTagProduto = mysqli_fetch_array($queryTagProduto)){ $arrayTagProduto[$rowTagProduto['idTagChild']]=$rowTagProduto;}
}


$arrayTagTag = array_intersect_key($arrayTag, $arrayTagProduto);


?>
<!DOCTYPE html>
<html lang="pt-Br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Painel</title>

  <script src="ckeditor/ckeditor.js"></script>

  <script src="js/tag.js"></script>
  <?php require 'links_header.php'; ?>


</head>

<body>



  <div id="wrapper">

    <!-- Navigation -->

    <?php require 'menu.php'; ?>

    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            <?php
            $row = array('tipo'=>'','formato'=>'1');
            if (isset($_GET['id']) && $_GET['id'] != 0){
              $simple = new Simple_Mysql();

              $simple->table = array($table);
              $simple->column = array('*');
              $simple->where = array('id' => $id_adm);
              $simple->select();
              $query = $simple->execute();
              $row = mysqli_fetch_array($query);
              if (mysqli_num_rows($query) != 1):
                echo "<meta http-equiv='refresh' content='0;painel.php'>";
              die;
              endif;
            }else{
              echo "<meta http-equiv='refresh' content='0;painel.php'>";
              die;
            } ?> Conectar Tags
          </h1>

        </div>

        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div class="row">


        <section class="container-fluid">
          <section class="row">
            <div class="col-xs-12">
              <div class="media">
                <div class="media-left">
                  <?php if(isset($_GET['id']) && $_GET['id'] != 0){ ?>

                  <img style="width: 150px;" src="<?php echo $dir_fotos.$dir_fotos_tags.$row['imagem']; ?>" alt='' />
                  <?php }?>
                </div>
                <div class="media-body">
                  <h4 class="media-heading"><?php echo (isset($row['nome'])) ? $row['nome'] : ''; ?></h4>
                  <h3 class="media-heading">Descrição:</h4>
                    <?php 
                    echo (isset($row['descricao'])) ? limita_caracteres($row['descricao'], 20) : '';
                     ?>
                  </div>
                </div>
              </div>
              <form action="tags_control.php" id="form" method="post" enctype='multipart/form-data'>
                <input type="hidden" name="acao" value='tagAssoc' />
                <input type="hidden" name="id" value='<?php echo $id_adm ?>'/>
                <div class="col-xs-12 ">
                  <h2 class="title-tag text-center">Tags</h2>
                </div>
                <div class="col-xs-12 col-sm-6">
                  <div class="panel panel-info">
                    <div class="panel-heading">
                      <h3 class="panel-title text-center">Disponíveis</h3>
                    </div>
                    <div class="panel-body space-tag active-tag">

                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                  <div class="panel panel-success">
                    <div class="panel-heading">
                      <h3 class="panel-title text-center ">Linkadas</h3>
                    </div>
                    <div class="panel-body space-tag  disable-tag">
                    </div>
                  </div>
                </div>
                <script>
                <?php $arrayTag = array_diff_key($arrayTag,$arrayTagProduto); ?>
                  var activeTag = document.querySelector("."+tagConfig.origem);
                  <?php foreach ($arrayTag  as $key => $value) { ?>
                    activeTag.appendChild(templateTag('<?php echo $value['nome']?>',<?php echo $key?>));
                    <?php }?>

                    var disabledTag = document.querySelector("."+tagConfig.destino);
                    <?php foreach ($arrayTagTag   as $key => $value) { ?>
                      disabledTag.appendChild(templateTag('<?php echo $value['nome']?>',<?php echo $key?>,tagConfig.destino));
                      <?php }?>

                    </script>
                    <div class="clearfix"></div>
                    <div class="col-xs-12"><hr/></div>
                    <div class="col-xs-12 borda br-bottom">
                      <div class="col-sm-4 col-sm-offset-4 brm text-left">
                        <div class="col-xs-12 br">
                          <button class="form-control btn btn-success">Gravar</button>
                        </div>
                      </div>
                    </div>
                  </form>

                </section>
              </section>
            </div>


          </div>
          <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

      </div>
      <!-- /#wrapper -->

      <?php
      require 'scripts_footer.php';
      ?>
      <script src="../js/bootstrap.min.js"></script>
      <script>
        $(".valor").maskMoney({thousands: '', decimal: ',', allowZero: true, suffix: '', prefix: 'R$ ', affixesStay: false});

      </script>

      <style>
        .ui-datepicker-div{
          z-index: 9999999;
        }
      </style>
    </body>

    </html>
