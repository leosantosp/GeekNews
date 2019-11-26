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
                    <h3 class="page-header">Destaque</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">

 <div class="container-fluid" style="background-color:#FFFFFF;">
        

		<div class="col-xs-12">
       
		  <?php
				$sql = "SELECT * FROM destaque" ;
				$query = mysqli_query($conn,$sql);         
                while($row = mysqli_fetch_assoc($query))
				{
					$id_p = $row['id_p'];
					$sql_est = "SELECT * FROM estrutura WHERE id = $id_p";
					$query_est = mysqli_query($conn,$sql_est);
					$resultado_est = mysqli_fetch_array($query_est);
			?>
					
					<figure class='col-sm-3 text-center'>

					<img class='img-responsive' src='fotos/<?php echo $resultado_est['foto']; ?>' alt='' />

					<figcaption>
					<br/>
					</figcaption>

					</figure>
					<div class="col-sm-9">
					<h3>
						<?php echo $resultado_est['titulo'];?>
					</h3>
					<p>
						<?php echo $resultado_est['texto'];?>
					</p>
					</div>
					<div class="clearfix"></div>
			<?php
				}

            ?>
		<br/>

		</div>
		
		<div class="col-xs-12 br">
			<h3 class="text-center">
				Utilize a busca digitando o link ou titulo desejado
			<h3/>
			<form method="post" action="" class="">
				<div class="col-xs-12 col-lg-8 col-md-4 col-sm-4">
					<input type="text" name="search" class="form-control" placeholder="Pesquise link ou titulo desejado"/>
				</div>
				<div class="col-xs-12 col-lg-4 col-md-4 col-sm-4">
					<button class="btn btn-success col-xs-12">
						Buscar
					</button>
				</div>
			</form>
		</div>
		
		<div class="col-lg-9 br" >
		
			<?php
	
				if($_POST['search'] != '')
				{	
					$search = $_POST['search'];
					$resultado = mysqli_query($conn,"SELECT * FROM `estrutura` WHERE `titulo` LIKE '%$search%' OR `url` LIKE '%$search%' order by `id`");		
				}else{
					$sql = "SELECT * FROM `estrutura` order by `id`";
					$resultado = mysqli_query($conn,$sql);
				}
			
			?>
			
			<table border='0' width='100%' class='table bg-admin'>
				<tr>
					<th>
						Código
					</th>
					<th>
						Imagem
					</th>
					<th>
						Título
					</th>
					<th>
						Link
					</th>
					<th>
						Tipo
					</th>
					<th>
					</th>
					<th>
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
						<?php echo  $retorno['url']; ?>
					</td>
					<td>
						<?php 
							$tipo = $retorno['tipo']; 
							if($tipo == 0)
							{
								echo 'Texto';
							}else{
								echo 'Video';
							}
						?>
					</td>
					<td>
						<form method="post" action="class/control_destaque.php">
							<input type="hidden" name="id" value="<?php echo $id; ?>"/>

							<select name="destaque" class="form-control">
								<option name="destaque" value="1" > Destaque 1 
								<option name="destaque" value="2"> Destaque 2 
								<option name="destaque" value="3"> Destaque 3
								<option name="destaque" value="4"> Destaque 4
							</select>
							<button class="btn btn-default">
								Destaque
								<br/>
							</button>
						</form>
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
