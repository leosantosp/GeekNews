<?php
require 'class/conexao.php';
$login= new conexao();
$login->manter();
$l = new conexao();
$l->manter();
$conn = $l->getconexao();

$sql = "SELECT * FROM config";
$queryc = mysqli_query($conn,$sql);
$config = array();
while($rowc = mysqli_fetch_array($queryc)){
	$config[$rowc['id']]=$rowc;
}
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
</head>
<body>
	<div id="wrapper">
		<!-- Navigation -->
		<?php require 'menu.php';?>
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Configurações</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="container-fluid" style="background-color:#FFFFFF;">
					<div class="col-xs-12">
						<div class="">
							<div class="col-xs-12 ">
								<div class="row">
									<?php
									foreach ($config as $row){
										if($row['id']!=0){
											?>
											<form method="post" action="config_control.php" class="form-inline">
												<input type="hidden" name="control" value="updateChave"/>						
												<input type="hidden" name="chave" value="<?php echo $row['chave']; ?>"/>
												<label>Chave</label>
												<input type="text" class="form-control text-center" name="chave" value="<?php echo $row['chave']; ?>" readonly="" />
												<label>Valor</label>
												<input type="text" class="form-control " name="valor" value="<?php echo ($row['valor']) ; ?>" />
												<div class="btn-group ">
													<button class="btn btn-warning ">
														Alterar
													</button>
												</div>
											</form>
											<div class="clearfix "></div>
											<hr/>
											<?php } } ?>
										</div>	
									</div>	
								</div>					
							</div>
						</div>			
					</div>
					<!-- /.row -->
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
