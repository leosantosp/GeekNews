<?php
;
require 'class/conexao.php';
$log = new conexao();
$log->manter();
$l = new conexao();
$l->manter();
$conn = $l->getconexao();
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
    
    <script src="../ckeditor/ckeditor.js"></script>

    <?php require 'links_header.php';?>
    

</head>

<body>
    

    
   <div id="wrapper">

    <!-- Navigation -->

    <?php require 'menu.php';?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Banner Rotativo Adicionar</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">

            <?php
            $sql = "SELECT * FROM banner" ;

            $query = mysqli_query($conn,$sql);
            ?>

            <section class="container-fluid">
              <section class="row">
               
                  <form action="control_banner_adicionar.php" method="post" enctype='multipart/form-data'>
                      <div class="col-xs-12 borda br-bottom">
                        <h3 class="col-sm-12 text-center">
                            Tamanho recomendado:990x450
                        </h3>
                        

                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12"><hr/></div>
                    <div class="col-xs-12 borda br-bottom">
                        <div class="col-xs-12 brm text-left">
                           <h3 class="text-center">
                              Adicione um banner
                          </h3>
                          <div class="col-xs-12">
                              <input type="file" name="fileUpload" class="form-control" required/>
                          </div>
                          <div class="col-xs-12 text-left">
                           <label class="">URL</label>

                           <input class="form-control" type="url" name="url" placeholder="Não obrigatório"/>

                       </div>
                       <div class="col-xs-12 br">
                        <button class="form-control btn btn-success">Adcionar banner</button>
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
</body>

</html>
