<?php
require 'class/conexao.php';

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


	<?php require 'links_header.php'; ?>


</head>

<body>



	<div id="wrapper">

		<!-- Navigation -->

		<?php require 'menu.php'; ?>

		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Banner Fixo</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">

				<?php
				$sql = "SELECT * FROM banner_fixo";

				$query = mysqli_query($conn, $sql);
				?>

				<section class="container-fluid">
					<section class="row">

						<form action="control_banner_fixo.php" method="post" enctype='multipart/form-data'>
							<div class="col-xs-12 borda br-bottom">
								<div class=" col-xs-12" data-toggle="buttons">

									<?php
									$cont = 0;
									$dir = "images/";
									$string = '';
									while ($row = mysqli_fetch_array($query)) {
										$cont++;
										$url = (isset($row['url'])) ? $row['url'] : 'Nenhuma';

										$column = ($cont == 1)?'col-xs-12 text-center':'col-xs-12 col-sm-6 text-center';

										$string .= "
										<div class='$column' >
											<label class='btn btn-default' for='option" . $cont . "' style='margin:0px auto;'>
												<img class='img-responsive' src='$dir" . $row['nome'] . "' alt=''  />
												<input type='radio' name='img' id='option" . $cont . "' autocomplete='off' checked='checked' value='" . $row['id'] . "'  checked/>
											</label>
											<p style='word-break: break-all;'>
												<strong>Url:</strong>" . $url . "</p>
											</div>

											";
										} ?>


										<?php  echo $string;?>
									</div>

								</div>
								<div class="clearfix"></div>
								<div class="col-xs-12"><hr/></div>
								<div class="col-xs-12 borda br-bottom">
									<div class="col-xs-12 brm text-left">
										<h3 class="text-center">
											Troque o banner
										</h3>
										<div class="col-xs-12">
											<input type="file" name="fileUpload" class="form-control" required/>
										</div>
										<div class="col-xs-12 text-left">
											<label class="">URL</label>

											<input  type="url"  class="form-control" name="url" />

										</div> 

										<div class="col-xs-12 text-left">
											<div class="checkbox ">
												<label>
													<input type="checkbox"  class="radio" name="retirarurl" value="true" > Retirar Url
												</label>
											</div>
											<div class="col-xs-12 br">
												<button class="form-control btn btn-success">Trocar banner</button>
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
