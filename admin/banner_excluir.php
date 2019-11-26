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
                    <h1 class="page-header">Banner Rotativo Excluir</h1>
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
	
<form action="control_banner_excluir.php" method="post" enctype='multipart/form-data'>
  <div class="col-xs-12 borda br-bottom">
						  
							

	<div class="btn-group col-xs-12" data-toggle="buttons">

                       <?php
					   $cont=0;
                $dir="images/";
                while($row = mysqli_fetch_array($query)){
				$cont++;
                echo "
<div class='col-xs-12 col-sm-4'>
<label class='btn btn-default' for='option".$cont."'>
        <img class='img-responsive' src='$dir".$row['nome']."' alt='Promoção' />
    <input type='radio' name='img' id='option".$cont."' autocomplete='off' checked='checked' value='".$row['id']."' checked/>
    </label>
<p style='word-break: break-all;'>
<strong>Url:</strong>".$row['url']."</p>
</div>

                ";
                }

               
                ?>
	</div>

</div>
				<div class="clearfix"></div>
				<div class="col-xs-12"><hr/></div>
				<div class="col-xs-12 borda br-bottom">
                    <div class="col-sm-4 col-sm-offset-4 brm text-left">
					<div class="col-xs-12 br">
                    <button class="form-control btn btn-success">Excluir</button>
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
