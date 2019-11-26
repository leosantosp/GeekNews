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

	<title>Contato</title>

    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/estilo.css" rel="stylesheet">
    <script src="js/jquery-1.11.2.min.js"></script>	
	
	
	<link href='https://fonts.googleapis.com/css?family=Crimson+Text:400,700italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Cantarell:400,400italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Istok+Web:400,400italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,300' rel='stylesheet' type='text/css'>

  
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

		

		</div>
	</div>
	</div>
	
</div>
</section>
</main>	
	<?php
		require 'footer.php';
	?>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>