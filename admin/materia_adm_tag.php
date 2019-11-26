<?php
date_default_timezone_set("Brazil/East");
require 'class/conexao.php';
require 'class/Simple_Mysql.php';


$l = new conexao();
$l->manter();
$conn = $l->getconexao();
$id_adm = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);



/* Tags de Categoria */
$sqlTag = "SELECT * FROM tags";
$queryTag = mysqli_query($conn,$sqlTag);
$arrayTag = array();
while($rowTag = mysqli_fetch_array($queryTag)){ $arrayTag[$rowTag['id']]=$rowTag;}


/* Tags de Materia */
$arrayTagMateria = array();
if($id_adm!=''){
  $sqlTagMateria = "SELECT * FROM tag_materia WHERE idMateria =  $id_adm ";
  $queryTagMateria = mysqli_query($conn,$sqlTagMateria);

  while($rowTagMateria = mysqli_fetch_array($queryTagMateria)){ $arrayTagMateria[$rowTagMateria['idTag']]=$rowTagMateria;}
}


$arrayTagMateriax = array_intersect_key($arrayTag, $arrayTagMateria);
/* imagens pastas */
$dir_fotos_large = 'large/';
$dir_fotos_medium = 'medium/';
$dir_fotos_thumbnail = 'thumbnail/';
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
            if (isset($_GET['id']) && $_GET['id'] != 0):
              $simple = new Simple_Mysql();
            $simple->table = array('materias');
            $simple->column = array('*');
            $simple->where = array('id' => $id_adm);
            $simple->select();
            $query = $simple->execute();
            $row = mysqli_fetch_array($query);
            if (mysqli_num_rows($query) != 1):
              echo "<meta http-equiv='refresh' content='0;painel.php'>";
            die;
            endif;

            ?>
            Alterar 
          <?php else: ?>
            Cadastrar
          <?php endif; ?> Materia
        </h1>

      </div>

      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">


      <section class="container-fluid">
        <section class="row">
          <div class="clearfix"></div>

          <div class="col-xs-12 text-right " style="padding-bottom: 20px;padding-top: 10px;">
            <?php if (isset($_GET['id']) && $_GET['id'] != 0): ?>
              <a href="materia_control.php?acao=excluir&id=<?php echo $id_adm ?>" class='btn btn-danger  pull-left link_confirm'>Excluir</a>

              <?php if ($row['destaque'] == 0): ?>
               <a href="materia_control.php?acao=destaque&id=<?php echo $id_adm ?>" class='btn btn-default '>Destacar ?</a>
             <?php else: ?>
               <a href="materia_control.php?acao=semdestaque&id=<?php echo $id_adm ?>" class='btn btn-info '> Retirar destaque!</a>
             <?php endif; ?>
           
         <?php endif; ?>
       </div>
       <form action="materia_control.php" id="form" method="post" enctype='multipart/form-data'>
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
          <?php $arrayTag = array_diff_key($arrayTag,$arrayTagMateria); ?>
          var activeTag = document.querySelector("."+tagConfig.origem);
          <?php foreach ($arrayTag  as $key => $value) { ?>
            activeTag.appendChild(templateTag('<?php echo $value['nome']?>',<?php echo $key?>));
            <?php }?>

            <?php
            ?>
            var disabledTag = document.querySelector("."+tagConfig.destino);
            <?php foreach ($arrayTagMateriax   as $key => $value) { ?>
              disabledTag.appendChild(templateTag('<?php echo $value['nome']?>',<?php echo $key?>,tagConfig.destino));
              <?php }?>

            </script>
            <?php if (isset($_GET['id'])):
            ?>
            <input type="hidden" name="acao" value='alterar' />
            <input type="hidden" name="id" value='<?php echo $id_adm ?>'/>
          <?php else: ?>
            <input type="hidden" name="acao" value='inserir' />
          <?php endif; ?>


          <div class=" col-sm-12 col-md-12 col-xs-12  ">
            <label>Imagem de Capa</label>
            <input type="file" name="imagem" class="form-control" <?php echo (isset($row['imagem']))?'':'required' ?> />
            <?php if(isset($row['imagem'])){ ?>
            <img class="img-responsive" src="images/materias/medium/<?php echo $row['imagem']?>"/>
            <input type="hidden" name="imagemantiga" value="<?php echo $row['imagem']?>"/>
            <?php } ?>
          </div>

          <div class=" col-sm-12 col-md-12 col-xs-12  ">
            <label>Título</label>
            <input type="text" name="titulo" value='<?php echo (isset($row['titulo'])) ? $row['titulo'] : ''; ?>' class="form-control" maxlength="1500" required/>
          </div>

          <div class=" col-sm-12 col-md-12 col-xs-12  ">
            <label>Subtítulo</label>
            <input type="text" name="subtitulo" value='<?php echo (isset($row['subtitulo'])) ? $row['subtitulo'] : ''; ?>' class="form-control" maxlength="1500" />
          </div>

          <div class=" col-sm-6 col-md-6 col-xs-12  ">
            <div class=' form-group'>
              <label>Data</label>
              <input type="text" name="data" value='<?php 
              if(isset($row['data'])):
               $data = date('d/m/Y H:i:s',strtotime($row['data']));
             else:
               $data = date('d/m/Y H:i:s');
             endif;
             echo $data;
             ?>' class="form-control dates" placeholder="" maxlength="50" required/>
           </div>
         </div>

         <div class="br col-xs-12"></div>
         <div class="col-xs-12  bg-info">
          <div class=' text-center '>
            <label>Descrição</label>
          </div>
        </div>
        <div class="col-xs-12 br br-bottom">
          <div class="row">
            <textarea name="descricao" class="form-control"  ><?php echo (isset($row['descricao'])) ? $row['descricao'] : ''; ?></textarea>
            <script type="text/javascript">
              CKEDITOR.replace( 'descricao', {
                on: {
                  instanceReady: function() {
                    this.dataProcessor.htmlFilter.addRules( {
                      elements: {
                        img: function( el ) {
                          el.attributes.class = 'responsive-img';
                        },
                        table: function( el ) {
                          el.attributes.class = 'responsive-table';
                          el.attributes.style = '';
                        }
                      }
                    } );            
                  }
                }
              } );
             
              CKEDITOR.config.entities_greek = false;
              CKEDITOR.config.entities_latin = false;
              CKEDITOR.config.htmlEncodeOutput = false;
              CKEDITOR.config.fillEmptyBlocks = false;
              CKEDITOR.config.tabSpaces = 0;
              CKEDITOR.config.entities_additional = '';
              CKEDITOR.config.youtube_responsive = true;

            </script>
          </div>
        </div>



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


<style> .ui-datepicker-div{ z-index: 9999999; } </style>
<script type="text/javascript">
  $(function() {

    $('.dates').datetimepicker({
      timeFormat: 'HH:mm:ss',
      stepHour: 1,
      stepMinute: 1,
      stepSecond: 10
    });
  });
</script>
</body>

</html>
