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
$prefix = 'materia';
$table = 'tags';


/* Tags de Categoria */
$sqlTag = "SELECT * FROM $table";
$queryTag = mysqli_query($conn,$sqlTag);
$arrayTag = array();
while($rowTag = mysqli_fetch_array($queryTag)){ 
  $arrayTag[$rowTag['id']]=$rowTag;
}

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
            Busca por Tags
          </h1>

        </div>

        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div class="row">


        <section class="container-fluid">
          <section class="row">
            <div class="col-xs-12">
              <form action="<?php echo $prefix?>_control.php" id="form" method="post" >
                <input type="hidden" name="acao" value='buscaPorTag' />
                <div class="col-xs-12 ">
                  <h2 class="title-tag text-center">Escolha tags para buscar pelos produtos desejados.</h2>
                </div>
                <div class="col-xs-12 text-right br-bottom">
                  <button class="btn btn-warning">
                    Buscar
                    <span class="glyphicon glyphicon-search"></span>
                  </button>
                </div>
                <div class="col-xs-12 col-sm-6">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title text-center">Disponíveis</h3>
                    </div>
                    <div class="panel-body space-tag active-tag">

                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                  <div class="panel panel-info">
                    <div class="panel-heading">
                      <h3 class="panel-title text-center ">Incluidas</h3>
                    </div>
                    <div class="panel-body space-tag  disable-tag">
                    </div>
                  </div>
                </div>
                <script>
                  <?php $arrayTag = $arrayTag; ?>
                  var activeTag = document.querySelector("."+tagConfig.origem);
                  <?php foreach ($arrayTag  as $key => $value) { ?>
                    activeTag.appendChild(templateTag('<?php echo $value['nome']?>',<?php echo $key?>));
                    <?php }?>

                  </script>
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
