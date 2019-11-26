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
	
	<title>Muzzi</title>
	
    <link href="<?php echo $diretorio; ?>css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo $diretorio; ?>css/estilo.css" rel="stylesheet">
    <script src="<?php echo $diretorio; ?>js/jquery-1.11.2.min.js"></script>	
	
	<script src="<?php echo $diretorio; ?>js/jquery.bxslider.min.js"></script>

	<link href="<?php echo $diretorio; ?>js/jquery.bxslider.css" rel="stylesheet" />

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
	<script>
	function bot(){

$('html, body').animate({
     scrollTop: $('#bot').offset().top
     }, 2000);


};

	function top(){

$('html, body').animate({
     scrollTop: $('#top').offset().top
     }, 2000);


};

	</script>
	
</head>

<body>
<?php
	require 'header.php';
	require 'banner-noticias.php';
?>

<main>

	<section class="container-fluid" id="index">
		<div class="row">
		
	<div class="col-xs-12 col-lg-2 col-md-2 col-sm-2">
		<div class="row">
			<?php
			 require 'menu-vertical.php';
			 $id=intval($_GET['id']);
			?>
		</div>
	</div>
    <div class=' col-xs-12 col-lg-10 col-md-10 col-sm-10 br bg-index br-bottom' style="background-color:#EEEEEE;">

       <div class="col-xs-12 col-lg-8 col-md-9 col-sm-12"> 
	   <div class="row">
	<div class="col-xs-12 destaque" style="">

 
</div>		
</div>	
			   <div class='row'>

                    <?php 
					
					$sql =	"SELECT * FROM cat_artigo WHERE id = $id";
					$query = mysqli_query($conn,$sql);
					while($row = mysqli_fetch_assoc($query))
					{
					?>
            
				<article class="col-xs-12">

						<div class="artigo text-justify">	
								<div class="col-xs-12 col-lg-11 col-md-10 col-sm-10">
									<h2 class="text-center br-bottom">
											<?php 									
											echo $titulo = $row['nome']; 				
											?>
									</h2>
								</div>
								<div class="col-xs-12 col-lg-1 col-md-2 col-sm-2 br">
									<a href="#" class="col-xs-12 br br-bottom"  onclick="bot()">
										<div class="glyphicon glyphicon-arrow-down" style="font-size:20px;"></div>
									</a>
								</div>
								
								<div class="clearfix"></div>
								
								<div class="text-justify">
									
										<?php
											echo $texto = $row['texto'];	
										?>
								</div>						

								<div class="col-xs-12 text-right br">
									<a href="#" class="col-xs-12 br br-bottom" id="bot" onclick="top()">
										<div class="glyphicon glyphicon-arrow-up" style="font-size:20px;"></div>
									</a>
								</div>
								
						</div>

				</article>
				
		
		<?php
					}
		?>
		  	
                </div>
            </div>	

				<div class="row">
		<?php
			require 'midias.php';
		?>
				</div>			
		</div>	
		</div>
	</section>

</main>

<?php
	require('footer.php');
?>

    <script src="<?php echo $diretorio; ?>js/bootstrap.min.js"></script>
</body>
</html>