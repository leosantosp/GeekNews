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
                    <h3 class="page-header">Criação/Edição/Exclusão</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">

 <div class="container-fluid" style="background-color:#FFFFFF;">
        

		<div class="col-xs-12">
       
		
		<br/>
		<form method="post" action="class/control_estrutura.php" enctype="multipart/form-data">
			<br/>

			<div class="form-group col-xs-12">
				
				<input type="hidden" name="control" value="insert"/>

					<div class="form-group col-xs-12 col-lg-4 col-md-4 col-sm-4">
						<h3 for="exampleInputFile" class="text-center">
							Selecione uma categoria
						</h3>

						<select name="categoria" class="form-control" required>
							<option value=""> Categoria
							<?php
								$sql = "SELECT * FROM categoria";
								$query = mysqli_query($conn,$sql);
								while($row = mysqli_fetch_array($query))
								{
							?>	
								<option value="<?php echo $row['id']; ?>"> <?php echo $row['nome']; ?>
							<?php
								}
							?>
						</select>
					</div>	
				
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
						<h5 for="exampleInputFile" class="text-center">
							Legenda para a foto
						</h5>
						<input type="text" class="form-control" name="legenda" required />
					</div>
					
					
					<div class="form-group col-xs-12 col-lg-12 col-md-12 col-sm-12">
						<h3 for="exampleInputFile" class="text-center">
							Descrição
						</h3>

						<textarea name="descricao" class="form-control"  required></textarea>
						<script type="text/javascript">
						CKEDITOR.replace('descricao');
						</script>
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
					$resultado = mysqli_query($conn,"SELECT * FROM `estrutura` WHERE `titulo` LIKE '%$search%' OR `texto`  LIKE '%$search%' order by `id` DESC LIMIT 5");		
				}else{
					$sql = "SELECT * FROM `estrutura` order by `id` DESC LIMIT 5";
					$resultado = mysqli_query($conn,$sql);
				}
			
			?>
				<form method="post" action="class/control_estrutura.php">
				<input type="hidden" name="control" value="delete_more"/>
				<div class="col-xs-12 br">
					<button class='text-right btn btn-danger'>
								Excluir Artigos
								<br/>
					</button>
				</div>
			<?php
				$i=0;
				while ($retorno = mysqli_fetch_assoc($resultado))
				{
					$id = $retorno['id'];
			?>

					<div class="col-xs-12 col-lg-4 col-md-4 col-sm-4">
						<div class="row">
							<div class="col-xs-12 ">
								
								<h3 class="text-center">
								<input type="checkbox" class="pull-left" name="opcao[]" value="<?php echo $id; ?>"></input>
								Id:
								<?php
									echo $retorno['id'];
									$id = $retorno['id'];
								?>
								</h3>
							</div>
							<div class="col-xs-12">
								<img src="fotos/<?php echo  $retorno['foto']; ?>" width="300" alt=""/>
								<h5 class="text-center"><?php echo  $retorno['legenda']; ?></h5>
							</div>
							<div class="col-xs-12 text-center">
									<h4>
										Categoria:
										<?php
										$sql_cat = "SELECT * FROM categoria WHERE id = ".$retorno['categoria'];
										$query_cat = mysqli_query($conn,$sql_cat);
										$row_cat = mysqli_fetch_assoc($query_cat);
										echo $row_cat['nome'];

										?>
									</h4>
						<div class="col-xs-12">
								<a href="estruturaalterar.php?id=<?php echo $id; ?>" class="btn btn-warning">
									Alterar
									<br/>
								</a>
							<a href="class/control_estrutura.php?var=<?php echo $id; ?>&control=delete" onclick='ConfirmaExclusao(<?php echo $id; ?>);' class='text-right btn btn-danger'>
								Excluir
								<br/>
							</a>

								<?php
								if($retorno['banner'] == 0)
								{
									$botao = 'btn-info';
								}else
								{
									$botao = 'btn-primary';
								}
								?>
								<a href="class/control_estrutura.php?id=<?php echo $id; ?>&control=banner" class="btn <?php echo $botao; ?>">
									Banner
									<br/>
								</a>

						</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-lg-8 col-md-8 col-sm-8">
						<h3 class="text-center">
							<?php echo  $retorno['titulo']; ?>
						</h3>
					</div>
					<div class="col-xs-12 col-lg-8 col-md-8 col-sm-8">
						<?php echo  $retorno['texto']; ?>
					</div>

				<div class="clearfix"></div>
					<?php
						}
						mysqli_free_result($resultado);
					?>
			</form>
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
