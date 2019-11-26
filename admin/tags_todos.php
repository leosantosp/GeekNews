<?php
;
require 'class/conexao.php';
require 'class/Simple_Mysql.php';

$l = new conexao();
$l->manter();
$conn = $l->getconexao();

$dir_fotos = 'images/produto/';
$dir_fotos_tags= 'tags/';
$prefix = 'tag';
$table = 'tags';


$exibindo =0 ;

$simple =  new Simple_Mysql();
$simple->table = array($table);
$simple->column =array('*');
$simple->select();
$query = $simple->execute();


$exibindo = mysqli_num_rows($query);
$rowTag = array();
while ($row = mysqli_fetch_array($query)){

  $rowTag[] = $row;
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

            ?>
            Tags
          </h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->

      <section class="container-fluid">
        <section class="row">

          <?php 
          foreach ($rowTag  as $row){

            ?>
            <div class="btn btn-default popover-x" style="padding: 5px;border-radius: 5px; border: 1px solid #CCC;     margin-bottom: 5px;" >
            <?php echo (isset($row['nome']))?$row['nome']:'';?>
            <a class='btn btn-danger btn-circle btn-md link_confirm' href='<?php echo $table ?>_control.php?id=<?php echo $row['id']?>&acao=excluir' > <span class="fa fa-times  
              "></span></a>
              <a class='btn btn-success btn-circle btn-md ' href='<?php echo $table ?>_adm.php?id=<?php echo $row['id']?>'> <span class="glyphicon glyphicon-pencil"></span></a>
              <a class='btn btn-info btn-circle btn-md ' href='<?php echo $table ?>_adm_child.php?id=<?php echo $row['id']?>'> <span class="fa fa-share  "></span></a>
             
            </div>
            <div style="display: inline-block;"></div>
            <?php } ?>

            <?php 
            if ($exibindo==0){?>
            <h2 class="text-center" style="font-size:2rem">
              Não há
            </h2>
            <?php } ?>
            
          </section>
        </section>


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

</body>

</html>
