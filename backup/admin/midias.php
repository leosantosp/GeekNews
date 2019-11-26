<?php
session_start();
require 'class/conexao.php';
$login= new conexao();
$login->manter();
$l = new conexao();
$l->manter();
$conn = $l->getconexao();
?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Painel</title>

<?php require 'links_header.php';?>

<script>
function ConfirmaExclusao(id) {
  if( confirm( 'Tem certeza que deseja excluir esta midia?' ) ) {
  location="class/control_midias.php?var="+id+"&control=delete";

}
};

</script>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->

<?php require 'menu.php';?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
					 <h1 class="page-header">Estrutura</h1>
                    <h3 class="page-header">Midias Sociais</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">

 <div class="container-fluid" style="background-color:#FFFFFF;">
        

		<div class="col-xs-12">
			<div class="form-group col-xs-12">
				<form method="post" action="class/control_midias.php">
					<input type="hidden" name="control" value="insert"/>
					<div class="col-xs-12 col-lg-6 col-md-6 col-sm-12">
						<h3 class="text-center">
							Criar Midia
						</h3>
						<div class="col-xs-12 col-lg-9 col-md-9 col-sm-9">
							<input type="text" name="nome" class=" form-control" placeholder="Nome da mídia social"/>
						</div>
						<div class="col-xs-12 col-lg-9 col-md-9 col-sm-9 br">
							<input type="text" name="url" class=" form-control" placeholder="Link/url da mídia social"/>
						</div>
						<button class="btn btn-success col-xs-12 col-lg-3 col-md-3 col-sm-3">
							Criar
						</button>
				</form>
					
						
					</div>
					
					

				
				<div class="col-xs-12 col-lg-6 col-md-6 col-sm-12" style="border-left:2px solid #EEEEEE;min-height:350px;">
					<h3 class="text-center">
						Midias existentes
					</h3>
					<?php
					 $sql = "SELECT * FROM midias";
					 $query = mysqli_query($conn,$sql);
					 while($row = mysqli_fetch_array($query))
					 {
					?>
					<form method="post" action="class/control_midias.php">
						<input type="hidden" name="control" value="update"/>
						
						<input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
					
						<div class="col-xs-12 col-lg-4 col-md-4 col-sm-6 br-bottom">
							<input type="text" class="form-control" name="nome" value="<?php echo $row['nome']; ?>" />
						 </div>
						<div class="col-xs-12 col-lg-4 col-md-8 col-sm-6 br-bottom">
							<input type="text" class="form-control" name="url" value="<?php echo $row['url']; ?>" />
						 </div>						
						<button class="btn btn-warning col-xs-12 col-lg-2 col-md-2 col-sm-3">
							Alterar
						</button>
					</form>
					<button  onclick='ConfirmaExclusao(<?php echo $row['id']; ?>);' class='text-right btn btn-danger'>
						Excluir
					</button>
					
					<div class="clearfix"></div>
					 <?php
					 }
					?>

				</div>
		</div>
		
	</div>			

            

            </div>
            <!-- /.row -->
            <div class="row">
                </div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

  
    <!-- /#wrapper -->

<?php 
require 'scripts_footer.php';
?>

</body>

</html>
