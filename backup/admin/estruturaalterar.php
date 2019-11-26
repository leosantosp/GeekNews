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
				<h1 class="page-header">Estrutura</h1>
                    <h3 class="page-header">Edição</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
        
        <?php


    date_default_timezone_set("Brazil/East"); //Definindo timezone padrão
    $dir = 'fotos/'; //Diretório para uploads


    $id = $_GET['id'];
        ?>

    <section class="container-fluid">
      <section class="row br">
        
    <form class="col-sm-12 text-center" action="class/control_estrutura.php" method="post" enctype='multipart/form-data'>
	  <input type="hidden" name="control" value="update"/>
       <?php
echo "<input  type='hidden'  name='id' value='$id' />";
        try {

$sql = "SELECT * FROM estrutura WHERE id= $id ";
$query =mysqli_query($conn,$sql);

$row = mysqli_fetch_array($query);

} catch (Exception $e) {
echo 'Exceção capturada: ',  $e->getMessage();
echo "<script>  alert('Exceção capturada:, ".$e->getMessage()." '); </script>";
}
        
        ?>


<fieldset class='col-sm-12 col-xs-12 br'>
					<div class="form-group col-xs-12 col-lg-3 col-md-3 col-sm-3">
						<h3 for="exampleInputFile" class="text-center">
							Nome
						</h3>

						<div class="">
							<input type="text" name="titulo" value='<?php echo $row['titulo']; ?>' class="form-control" required />
						</div>
					</div>	
					
					<div class="form-group col-xs-12 col-lg-3 col-md-3 col-sm-3">
						<h3 for="exampleInputFile" class="text-center">
							Categoria
						</h3>

						<select name="categoria" class="form-control"  required >
							<option value="<?php echo $row['categoria']; ?>"> Categoria
							<?php
								$sql = "SELECT * FROM categoria";
								$query = mysqli_query($conn,$sql);
								while($result = mysqli_fetch_array($query))
								{
							?>	
								<option value="<?php echo $result['id']; ?>"> <?php echo $result['nome']; ?>
							<?php
								}
							?>
						</select>
					</div>	
<div class='col-sm-6 col-xs-12'>
						<h3 for="exampleInputFile" class="text-center">
							Trocar imagem
						</h3>
<div class="col-sm-8 col-xs-12">
<input class='col-sm-4 col-xs-12 form-control' name='foto' type='file' value='teste' />

</div>
<div class="col-sm-4">
<?php
    echo "
    <img src='".$dir.$row['foto']."' class='img-responsive'/>
    <input name='foto' type='hidden' value='".$row['foto']."' />

    ";
    ?>

</div>
<div class="col-xs-12">
<h5>Legenda</h5>
<h5>
	<input type="text" name="legenda" value='<?php echo $row['legenda']; ?>' class="form-control" required />
</h5>
</div>
</div>

					<div class="form-group col-xs-12 col-lg-12 col-md-12 col-sm-12">
						<h3 for="exampleInputFile" class="text-center">
							Descrição
						</h3>

						<textarea name="descricao" class="form-control" required ><?php echo $row['texto']; ?></textarea>
						<script type="text/javascript">				
						CKEDITOR.replace('descricao');
						</script>
					</div>

</fieldset>
<div class="clearfix"></div>
<fieldset class="col-sm-12 col-xs-12 br">
<input type="submit" class="btn btn-success" value="Alterar"/>
</fieldset> 
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
