<?php
date_default_timezone_set("Brazil/East");
;
require 'class/conexao.php';
require 'class/Simple_Mysql.php';
$log = new conexao();
$log->manter();
$conn = $log->getconexao();

$chave = filter_input(INPUT_GET, 'chave',FILTER_SANITIZE_STRING);
if($chave==''):
  echo "<script>"
. "window.history.back();"
. "</script>";
die;
endif;

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

  <?php require 'links_header.php';?>


</head>

<body>



 <div id="wrapper">

  <!-- Navigation -->

  <?php require 'menu.php';?>

  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
          <?php 
          $simple =  new Simple_Mysql();
          $simple->table = array('estatico');
          $simple->column =array('*');
          $simple->where =array('chave'=>$chave);
          $simple->select();
          $query = $simple->execute();
          $row = mysqli_fetch_array($query);

          ?>
          <?php echo $row['nome'];?>
        </h1>
      </div>

      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">


      <section class="container-fluid">
        <section class="row">

          <form action="estatico_control.php" method="post" enctype='multipart/form-data'>
            <input type="hidden" name="acao" value='alterarestatico' />
            <input type="hidden" name="chave" value='<?php echo $chave ?>'/>
            <div class="col-xs-12  br-bottom">

              <label>Conteúdo</label>
              <textarea name="conteudo" class="form-control"  ><?php echo (isset($row['conteudo']))?$row['conteudo']:'';?></textarea>
              <script type="text/javascript">
                CKEDITOR.replace( 'conteudo', {
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
  <!-- /.row -->
  <div class="row">
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
  $(".valor").maskMoney({thousands:',', decimal:'.', allowZero:true, suffix: '',prefix:' ',affixesStay:false});
  $('#datatime').datetimepicker({
   timeFormat: 'HH:mm:ss',
   stepHour: 1,
   stepMinute: 1,
   stepSecond: 10
 });
</script>

<style>
  .ui-datepicker-div{
    z-index: 9999999;
  }
</style>
</body>

</html>
