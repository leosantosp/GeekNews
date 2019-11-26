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
            if (isset($_GET['id']) && $_GET['id'] != 0):
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


            ?>
            Alterar 
          <?php else: ?>
            Cadastrar
          <?php endif; ?> Tag
        </h1>

        <?php
        if (isset($_GET['id']) && $_GET['id'] != 0){?>
        <div class="text-center">
          <a href="tags_adm.php" class="btn btn-info">Cadastrar outra Tag</a>
        </div>
        <?php  } ?>
        
      </div>

      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">


      <section class="container-fluid">
        <section class="row">

          <form action="tags_control.php" id="form" method="post" enctype='multipart/form-data'>
            <?php if (isset($_GET['id'])):
            ?>
            <input type="hidden" name="acao" value='alterar' />
            <input type="hidden" name="id" value='<?php echo $id_adm ?>'/>
          <?php else: ?>
            <input type="hidden" name="acao" value='inserir' />
          <?php endif; ?>
          <div class=" col-sm-12 col-md-12 col-xs-12  ">
            <label>Nome</label>
            <input type="text" name="nome" value='<?php echo (isset($row['nome'])) ? $row['nome'] : ''; ?>' class="form-control" maxlength="1500" required/>
          </div>
<!--
          <div class="col-xs-12  br">
            <label>
              Imagem 
              <?php if(isset($_GET['id']) && $_GET['id'] != 0){ ?>

              <input type="hidden" name="imagemantiga" value="<?php echo $row['imagem']; ?>"/>
              <img class="img-responsive" src="<?php echo $dir_fotos.$dir_fotos_tags.$row['imagem']; ?>" alt='' />
              <?php }?>
              <input type="file" name="removerImagem" class="form-control btn btn-default" />
            </label>
          </div>

          <?php if($id_adm!='' && $row['imagem']!=''){ ?>
          <div class="col-xs-12  br">
            <label>
            Remover Imagem <input type="checkbox" name="removerCheck"  />
           </label>
         </div>

         <?php } ?>

         <div class="col-xs-12 br br-bottom">
          <label>Descrição</label>
          <textarea name="descricao" class="form-control"  ><?php echo (isset($row['descricao'])) ? $row['descricao'] : ''; ?></textarea>
          <script type="text/javascript">
            CKEDITOR.replace('descricao');
            CKEDITOR.config.entities = false;
            CKEDITOR.config.entities_greek = false;
            CKEDITOR.config.entities_latin = false;
            CKEDITOR.config.htmlEncodeOutput = false;
            CKEDITOR.config.fillEmptyBlocks = false;
            CKEDITOR.config.tabSpaces = 0;
            CKEDITOR.config.entities_additional = '';
            CKEDITOR.config.allowedContent = 'u li p b i  strong ul h1 h2 h3 h4 h5 h6 a iframe';
            CKEDITOR.config.removePlugins  = 'youtube, bootstrapTabs, glyphicons';
          </script>
        </div>

      -->
      <input type="hidden" name="descricao"/>
      <input type="hidden" name="imagemantiga"/>
      <input type="hidden" name="removerImagem"/>
      

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
