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
  location="class/control_imagem.php?var="+id+"&control=delete";

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
                    <h3 class="page-header">Criação/Edição/Exclusão</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">

 <div class="container-fluid" style="background-color:#FFFFFF;">
        

		<div class="col-xs-12">
       
		
		<br/>
		<form method="post" action="class/control_imagem.php" enctype="multipart/form-data">
			<br/>

			<div class="form-group col-xs-12">
				
				<input type="hidden" name="control" value="insert"/>				

					<div class="form-group col-xs-12 col-lg-4 col-md-4 col-sm-4">
						<h3 for="exampleInputFile" class="text-center">
							Nome
						</h3>

						<div class="">
							<input type="text" name="titulo" value="" class="form-control" required />
						</div>
					</div>	
				
					<div class="form-group col-xs-12 col-lg-4 col-md-4 col-sm-4">
						<h3 for="exampleInputFile" class="text-center">
							Insira a foto aqui
						</h3>
						<input type="file" id="exampleInputFile" class="form-control" name="foto" required />
					</div>	
	
					<div class="col-xs-12 ">
						<button type="submit" class="btn btn-success  col-xs-12">
							Enviar
						</button>
					</div>

			</div>			
		</form>
		</div>
		
		<div class="col-xs-12 br">
			<h3 class="text-center">
				Utilize a busca digitando o que deseja
			<h3/>
			<form method="post" action="" class="">
				<div class="col-xs-12 col-lg-8 col-md-4 col-sm-4">
					<input type="text" name="search" class="form-control" placeholder="Pesquise texto ou titulo desejado"/>
				</div>
				<div class="col-xs-12 col-lg-4 col-md-4 col-sm-4">
					<button class="btn btn-success col-xs-12">
						Buscar
					</button>
				</div>
			</form>
		</div>
		
		<div class="col-lg-12 br" >
		
			<?php
	
				if($_POST['search'] != '')
				{	
					$search = $_POST['search'];
					$resultado = mysqli_query($conn,"SELECT * FROM `imagem` WHERE `titulo` LIKE '%$search%' OR `url` LIKE '%$search%' order by `id`");		
				}else{
					$sql = "SELECT * FROM `imagem` order by `id`";
					$resultado = mysqli_query($conn,$sql);
				}
			
			?>
			
			<table border='0' width='100%' class='table bg-admin col-xs-12'>
				<tr>
					<th>
						Código
					</th>
					<th>
						Imagem
					</th>
					<th>
						Nome
					</th>
					<th>
						Ação
					</th>


				</tr>
			<?php
				while ($retorno = mysqli_fetch_assoc($resultado))
				{
			?>
				<tr>
					<td>
						<?php
							echo $retorno['id'];
							$id = $retorno['id'];
						?>
					</td>
					<td>
						<img src="fotos/<?php echo  $retorno['foto']; ?>" width="200" alt=""/>
					</td>
					<td>
						<?php echo  $retorno['titulo']; ?>
					</td>

					<td>
						<form method="post" action="imagemalterar.php">
							<input type="hidden" name="id" value="<?php echo $id; ?>"/>
							<button class="btn btn-warning">
								Alterar
								<br/>
							</button>
						</form>
						<button  onclick='ConfirmaExclusao(<?php echo $id; ?>);' class='text-right btn btn-danger'>
							Excluir
							<br/>
						</button>
					</td>
				</tr>
					<?php
						}
						mysqli_free_result($resultado);
					?>
			</table>
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

    </div>
    <!-- /#wrapper -->

<?php 
require 'scripts_footer.php';
?>

</body>

</html>
