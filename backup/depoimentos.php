<?php
session_start();
require('admin/class/conexao.php');

$login= new conexao();
$l = new conexao();
$conn = $l->getconexao();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="shortcut icon" href="images/favicon.ico">

    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Depoimentos</title>
	
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/estilo.css" rel="stylesheet">
    <script src="js/jquery-1.11.2.min.js"></script>	
	
	<link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
	<script src="js/jquery.bxslider.min.js"></script>

	<link href="js/jquery.bxslider.css" rel="stylesheet" />

	
</head>

<body>
<?php
	require 'header.php';

?>

<main>

<div class="container-fluid">
	<div class="row">
		<div class="bg-sobreheader meio-br"></div>
	</div>
</div>

<?php
	require 'carousel.php';
?>


<div class="container-fluid">
	<div class="row">
		<div class="bg-sobreheader br"></div>
	</div>
</div>

<section class="container">
	
	<article>
		<div class="col-xs-12 col-lg-8 col-lg-offset-2">
			<h1 class="text-center">
				Depoimentos
			
			</h1>
			<div class="bg-sobreheader meio-br"></div>
			<?php
			
			$sql = "SELECT * FROM depoimentos WHERE status = 1";
			$query = mysqli_query($conn,$sql);
			while($row = mysqli_fetch_assoc($query))
			{
			?>
			<div class="col-xs-12">
				<h3>
					<?php echo $row['nome']; ?>
				</h3>
				<p>
					<?php echo $row['depoimento']; ?>
				</p>
			</div>
			<div class="col-xs-12">
				<hr/>
			</div>
			<?php
			}
			?>
		</div>
	</article>
	
</section>

	<aside class="container">
			<div class="col-xs-12 bg-form">
			<h3 class="text-center meio-br-bottom">
				Deixe o seu depoimento!
			</h3>	
				<form method="post" action="envia.php">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label for="empresa ">Nome*</label>
						<input type="text" class="form-control" id="empresa" name="nome" required/>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label for="cnpj">E-mail*</label>
						<input type="email" class="form-control" id="cnpj" name="email" required/>
					</div>			
					<div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-sm-offset-0 ">
						<label for="nome">Mensagem*</label>
						<textarea class="form-control" name="mensagem" required></textarea>
					</div>
					<div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-sm-offset-0 meio-br meio-br-bottom text-center">
						<input type="submit" class="btn-form btn-form-default " value="Enviar">
					</div>
				</form>	
			</div>
	</aside>


</main>

<?php
	require('footer.php');
?>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>