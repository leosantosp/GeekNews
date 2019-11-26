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
            $exibindo =0 ;
            if(isset($_GET['busca'])):

              $simple =  new Simple_Mysql();
            $simple->table = array('materias');
            $simple->column =array('*');
            $simple->operador='LIKE';
            $simple->where= array('(','titulo'=>'%'.$busca.'%',
              'OR',
              'descricao'=>'%'.$busca.'%',')');
            $simple->limit=2000;
            $simple->select();
            $query = $simple->execute();


            $exibindo = mysqli_num_rows($query);
            endif;

            $sim =  new Simple_Mysql();
            $sim->table = array('materias');
            $sim->column =array('*');
            $sim->select();
            $existem = mysqli_num_rows($sim->execute());

            ?>
            Busca
          </h1>
          <h3>Exibindo: <?php echo $exibindo;?> de <?php echo $existem;?> </h3>
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-lg-12 br-bottom">
          <form method="get">
            <div class="form-group">
              <label for="exampleInputEmail1">Busca</label>
              <input type="text" name='busca' class="form-control" id="exampleInputEmail1">
            </div>
            <button type="submit" class="btn btn-default pull-right">Buscar</button>
          </form>
        </div>
        <div class='clearfix br br-bottom'></div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->

      <section class="container-fluid">
        <section class="row">
          <?php if(isset($_GET['busca'])):
          while ($row = mysqli_fetch_array($query)):?>

          <div class="col-sm-8 col-xs-12">
            <div class="row">
              <div class="col-sm-6 col-xs-12">
                <p>
                  <label>Titulo: </label> 
                  <?php echo (isset($row['titulo']))?$row['titulo']:'';?>
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-4 col-xs-12">
            <a class='btn btn-warning pull-right' href='materia_adm_tag.php?id=<?php echo $row['id']?>'>Ver / Alterar</a>
          </div>

          <div class="clearfix"></div>
          <hr/>
        <?php endwhile; endif;?>
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
