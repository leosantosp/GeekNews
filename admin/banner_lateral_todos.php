<?php
;
require 'class/conexao.php';
require 'class/Simple_Mysql.php';

$l = new conexao();
$l->manter();
$conn = $l->getconexao();
$busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);
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
            $simple->table = array('banner');
            $simple->column =array('*');
            $simple->limit=2000;
            $simple->select();
            $query = $simple->execute();

            ?>
            Banner Lateral
          </h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->

      <section class="container-fluid">
        <section class="row">
          <?php 
          while ($row = mysqli_fetch_array($query)):?>

          <div class="col-sm-8 col-xs-12">
            <div class="row">
              <div class="col-sm-6 col-xs-12">
                <p>
                  <strong>Titulo: </strong> 
                  <?php echo (isset($row['titulo']))?$row['titulo']:'';?>
                </p>              </div>
                <div class="col-sm-6 col-xs-12">
                  <p>
                    <?php if(isset($row['imagem'])){ ?>
                    <img class="img-responsive" src="images/banner/<?php echo $row['imagem']?>"/>
                    <?php } ?>
                  </p>
                </div>
                <div class="col-xs-12">
                  <p>
                    <strong>
                      Link: 
                    </strong>
                    <?php echo (isset($row['link']))?$row['link']:'';?>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-4 col-xs-12">
              <a class='btn btn-warning pull-right' href='banner_lateral_adm.php?id=<?php echo $row['id']?>'>Ver / Alterar</a>
            </div>

            <div class="clearfix"></div>
            <hr/>
          <?php endwhile; ?>
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
