<?php
date_default_timezone_set("Brazil/East");
require 'class/conexao.php';
require 'class/Simple_Mysql.php';


$l = new conexao();
$l->manter();
$conn = $l->getconexao();
$id_adm = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);


/* imagens pastas */
$dir_fotos_large = 'large/';
$dir_fotos_medium = 'medium/';
$dir_fotos_thumbnail = 'thumbnail/';
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

	<script src="ckeditor/ckeditor.js"></script>
	<script src="js/tag.js"></script>
	<?php require 'links_header.php'; ?>


</head>

<body>



	<div id="wrapper">

		<!-- Navigation -->

		<?php require 'menu.php'; ?>

		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">
						<?php
						if (isset($_GET['id']) && $_GET['id'] != 0):
							$simple = new Simple_Mysql();
						$simple->table = array('banner');
						$simple->column = array('*');
						$simple->where = array('id' => $id_adm);
						$simple->select();
						$query = $simple->execute();
						$row = mysqli_fetch_array($query);
						if (mysqli_num_rows($query) != 1):
							echo "<meta http-equiv='refresh' content='0;painel.php'>";
						die;
						endif;

						?>
						Alterar 
					<?php else: ?>
						Cadastrar
					<?php endif; ?> Banner Lateral
				</h1>

			</div>

			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		<div class="row">


			<section class="container-fluid">
				<section class="row">
					<div class="clearfix"></div>

					<div class="col-xs-12 text-right " style="padding-bottom: 20px;padding-top: 10px;">
						<?php if (isset($_GET['id']) && $_GET['id'] != 0): ?>
							<a href="banner_lateral_control.php?acao=excluir&id=<?php echo $id_adm ?>" class='btn btn-danger  pull-left link_confirm'>Excluir</a>

						<?php endif; ?>
					</div>
					<form action="banner_lateral_control.php" id="form" method="post" enctype='multipart/form-data'>
						<?php if (isset($_GET['id'])):
						?>
						<input type="hidden" name="acao" value='alterar' />
						<input type="hidden" name="id" value='<?php echo $id_adm ?>'/>
					<?php else: ?>
						<input type="hidden" name="acao" value='inserir' />
					<?php endif; ?>


					<div class=" col-sm-12 col-md-12 col-xs-12  ">
						<label>Imagem</label>
						<input type="file" name="imagem" class="form-control" <?php echo (isset($row['imagem']))?'':'required' ?> />
						<?php if(isset($row['imagem'])){ ?>
						<img class="img-responsive" src="images/banner/<?php echo $row['imagem']?>"/>
						<input type="hidden" name="imagemantiga" value="<?php echo $row['imagem']?>"/>
						<?php } ?>
					</div>

					<div class=" col-sm-12 col-md-12 col-xs-12  ">
						<label>Título</label>
						<input type="text" name="titulo" value='<?php echo (isset($row['titulo'])) ? $row['titulo'] : ''; ?>' class="form-control" maxlength="1500" required/>
					</div>

					<div class=" col-sm-12 col-md-12 col-xs-12  ">
						<label>Link</label>
						<input type="url" name="link" value='<?php echo (isset($row['link'])) ? $row['link'] : ''; ?>' placeholder='http://www.google.com' class="form-control" maxlength="1500" />
					</div>

					<div class="clearfix"></div>
					<div class="col-xs-12"><hr/></div>
					<div class="col-xs-12 borda br-bottom">
						<div class="col-sm-4 col-sm-offset-4 brm text-left">
							<div class="col-xs-12 br">
								<button class="form-control btn btn-success">Gravar</button>
							</div>
						</div>
					</div>
				</form>

			</section>
		</section>
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


<style> .ui-datepicker-div{ z-index: 9999999; } </style>
<script type="text/javascript">
	$(function() {

		$('.dates').datetimepicker({
			timeFormat: 'HH:mm:ss',
			stepHour: 1,
			stepMinute: 1,
			stepSecond: 10
		});
	});
</script>
</body>

</html>
