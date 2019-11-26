<?php
session_start();
require('admin/class/conexao.php');
require('diretorio.php');

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

	<title>Contato</title>

    <link href="<?php echo $diretorio; ?>css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo $diretorio; ?>css/estilo.css" rel="stylesheet">
    <script src="<?php echo $diretorio; ?>js/jquery-1.11.2.min.js"></script>	
	
	
	<link href='https://fonts.googleapis.com/css?family=Crimson+Text:400,700italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Cantarell:400,400italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Istok+Web:400,400italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,300' rel='stylesheet' type='text/css'>

  <script src="<?php echo $diretorio; ?>js/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="<?php echo $diretorio; ?>js/jquery.bxslider.css" rel="stylesheet" />

<script>
$(document).ready(function(){
  $('.bxslider').bxSlider();
});
</script>
	
</head>

<body>
	<?php
		require 'header.php';
		require 'banner-noticias.php';
	?>
<main>
<div class=""></div>
<section class="container-fluid  texto-ubuntu  bg-body" style="padding:0px;background-size:100% auto; background-color:#FFFFFF;">

		<div class="row">

	<div class="col-xs-12 col-lg-2 col-md-2 col-sm-2">
		<div class="row">
			<?php
			 require 'menu-vertical.php';
			?>
		</div>
	</div>
		
		
	<div class="col-xs-12 col-lg-10 col-md-10 col-sm-10 br-bottom br bg-form form-contato">
	<div class="row">
	<div class="   " >
		<h1 class="text-center br-bottom" >Entre em contato conosco</h1>
		<div class="linha"></div>
		<form method="post" action="<?php echo $diretorio; ?>contatocliente.php" name="form" >
		<div class="col-sm-12 col-sm-offset-0 br" style="padding-right:0px;">
			<div class="col-sm-8 col-sm-offset-2">
				<label for="nome" >Nome</label>
			</div>
			<div class="col-sm-8 col-sm-offset-2">
				<input type="text" name="nome" class="form-control" style="border-radius:0px;" required id="nome" placeholder="Digite o seu nome" required/>
			</div>
			<div class="col-sm-8 col-sm-offset-2">
				<label for="email" >E-mail</label>
			</div>
			<div class="col-sm-8 col-sm-offset-2">
				<input type="email" name="email" class="form-control" style="border-radius:0px;" required id="email" placeholder="Digite o seu e-mail" required/>
			</div>

			<div class="col-sm-8 col-sm-offset-2">
				<label for="telefone" >Telefone</label>
			</div>		
			<div class="col-sm-8 col-sm-offset-2">
				<input type="text" name="telefone" class="form-control" style="border-radius:0px;" required id="telefone" placeholder="Digite o seu telefone" required/>
			</div>
			<div class="col-sm-8 col-sm-offset-2">
				<label for="telefone" >Whatsapp</label>
			</div>		
			<div class="col-sm-8 col-sm-offset-2">
				<input type="text" name="zapzap" class="form-control" style="border-radius:0px;"  id="telefone" placeholder="Digite o seu telefone" />
			</div>
		<br/>
		</div>
			<div class="col-sm-8 col-sm-offset-2 br" >
				<label for="mensagem" >Mensagem:</label>
				<textarea rows="10"  class="form-control" style="border-radius:0px;" name="mensagem" id="mensagem" placeholder="Digite a sua mensagem" required></textarea>
			</div>
		<br/>

			<div class="text-center col-sm-8 col-sm-offset-2 br">
				<button type="submit" class="btn btn-default col-xs-12">
					Enviar
				</button>
			</div>
		
		</form>
		<br/>

	</div>
	</div>
	</div>
	
</div>
</section>
</main>	
	<?php
		require 'footer.php';
	?>
    <script src="<?php echo $diretorio; ?>js/bootstrap.min.js"></script>
</body>
</html>