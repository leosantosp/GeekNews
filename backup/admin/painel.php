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
  if( confirm( 'Tem certeza que deseja excluir esta imagem?' ) ) {
  location="class/control_estrutura.php?var="+id+"&control=delete";

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
                    <h2 class="page-header">Painel Administrativo</h2>
                </div>
               <div class="col-lg-12">
                    <h2 class="page-header">Você pode mudar o banner</h2>
					<h2 class="page-header">Adicionar, alterar e excluir uma categoria</h2>
					<h2 class="page-header">Adicionar uma imagem no banco de imagens</h2>					
					<h2 class="page-header">Adicionar, alterar e excluir uma notícia</h2>			 
					 <h2 class="page-header">Destacar a categoria</h2>
                </div> 
				<?php
				
				$sql = "SELECT * FROM depoimentos WHERE status = 0";
				$query = mysqli_query($conn,$sql);
				while($row = mysqli_fetch_assoc($query))
				{
				?>

				<div class="col-xs-12 col-lg-10 col-md-10 col-sm-10">
					<h3>
						Nome: <?php echo $row['nome']; ?>
					</h3>
					<h4>
						Depoimento: <?php echo $row['depoimento']; ?>
					</h4>
					<h5>
						E-mail: <?php echo $row['email'];?>
					</h5>
				</div>
				<div class="col-xs-12 col-lg-2 col-md-2 col-sm-2">
					<form method="post" action="class/control_depoimentos.php">
						<input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
						<input type="hidden" name="control" value="update"/>
						<button class="btn btn-success col-xs-6">
							Aprovar
						</button>
					</form>
					<form method="post" action="class/control_depoimentos.php?id=">
					<input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
					<input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
					<button class="btn btn-danger col-xs-6">
						Excluir
					</button>
					</form>
				</div>
				<div class="col-xs-12">
				<hr/>
				</div>
				<?php
				}
				?>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">


                   
               
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

</body>

</html>
