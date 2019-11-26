<?php
session_start();
require 'class/conexao.php';
require 'class/banner.php';
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
                    <h1 class="page-header">Banner Rotativo</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">

<?php
$ban = new banner();
        $sql = "SELECT * FROM banner_fixo" ;

        $query = mysqli_query($conn,$sql);
        
        

        ?>

    <section class="container-fluid">
      <section class="row">
<form action="class/control_banner_fixo.php" method="post" enctype='multipart/form-data'>
        <h3 class="col-sm-12 text-center">
		 Tamanho recomendado: 1368x331
		</h3>
                       <?php
                $dir="images/";
                while($row = mysqli_fetch_array($query)){

                echo "
                <figure class='col-sm-3 text-center'>

                <img class='img-responsive' src='$dir".$row['nome']."' alt='Promoção' />

                <figcaption>
                <input name='img' type='radio' value='".$row['id']."' checked/>
                </figcaption>

                </figure>

                ";
                }

               
                ?>
				<div class="clearfix"></div>
                    <div class="col-sm-4 col-sm-offset-4 brm text-left">
					<h3 class="text-center">
						Troque o banner
					</h3>
					<div class="col-xs-12">
						<input type="file" name="fileUpload" class="form-control" required/>
					</div>
                   <!--  <div class="col-xs-12 text-left">
                     <label class="pull-left  ">URL</label>

                     <input class="col-sm-6  col-xs-12" type="url" name="url" required/>

                 </div> -->
					<div class="col-xs-12 br">
                    <button class="form-control btn btn-success">Trocar banner</button>
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
