<?php
date_default_timezone_set("Brazil/East");
require 'class/conexao.php';
require 'class/Simple_Mysql.php';


$l = new conexao();
$l->manter();
$conn = $l->getconexao();
$id_adm = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);


$loginusuario = $_SESSION['user'];
$simplepermissao = new Simple_Mysql();
$querypermissao = $simplepermissao->execute("SELECT * FROM admin WHERE admin.login = '$loginusuario' LIMIT 1");

$rowpermissao = mysqli_fetch_assoc($querypermissao);
$permissao = $rowpermissao['permissao'];

if($permissao != 1 && $_GET['id'] != $rowpermissao['id']){
	echo "<script>window.location.href='painel.php';</script>";
}


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
						$simple->table = array('admin');
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
					<?php endif; ?> Redator
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
							<a href="redator_control.php?acao=excluir&id=<?php echo $id_adm ?>" class='btn btn-danger  pull-left link_confirm'>Excluir</a>

						<?php endif; ?>
					</div>
					<form action="redator_control.php" id="form" method="POST" enctype='multipart/form-data'>
						<?php if (isset($_GET['id'])):
						?>
						<input type="hidden" name="acao" value='alterar' />
						<input type="hidden" name="id" value='<?php echo $id_adm ?>'/>
					<?php else: ?>
						<input type="hidden" name="acao" value='inserir' />
					<?php endif; ?>


					<div class=" col-sm-12 col-md-12 col-xs-12 ">
						<div style="display: flex;flex-direction: column;justify-content: center;align-items: center;max-width: 500px;margin:20px auto;">
						<label>Foto</label>
						<?php if(isset($row['foto'])){ ?>
						<img class="img-responsive" style="max-width: 200px;margin:10px;" src="images/redatores/<?php echo $row['foto']?>"/>
						<input type="hidden" name="imagemantiga" value="<?php echo $row['foto']?>"/>
						<?php } ?>
						<input type="file" name="imagem" class="form-control" <?php echo (isset($row['foto']))?'':'required' ?> />
					</div>
						
					</div>

					<div class="col-md-6 col-xs-12  ">
						<label>Nome</label>
						<input type="text" name="nome" value='<?php echo (isset($row['nome'])) ? $row['nome'] : ''; ?>' class="form-control" maxlength="100" required/>
					</div>

					<div class="col-md-6 col-xs-12  ">
						<label>Cargo</label>
						<input type="text" name="cargo" value='<?php echo (isset($row['cargo'])) ? $row['cargo'] : ''; ?>' class="form-control" maxlength="100" required/>
					</div>


					<div class="col-md-6 col-xs-12  ">
						<label>Login</label>
						<input type="text" name="login" value='<?php echo (isset($row['login'])) ? $row['login'] : ''; ?>' class="form-control" maxlength="100" required/>
					</div>


					<div class="col-md-6 col-xs-12  ">
						<label>Senha</label>
						<input type="text" name="senha" placeholder='<?php echo (isset($row['senha'])) ? $row['senha'] : ''; ?>' class="form-control" maxlength="100" <?php echo (isset($row['senha'])) ? '' : 'required'; ?>/>
					</div>


					<div class="col-md-6 col-xs-12  ">
						<label>Administrador</label><br>
						<input type="checkbox" name="permissao" <?php echo (isset($row['permissao']) && $row['permissao'] == 1) ? "checked" : ''; ?> value='1'/> Adicionar/Remover Contas
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
