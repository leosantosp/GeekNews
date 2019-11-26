<?php
session_start();
require('admin/class/conexao.php');
require('diretorio.php');

$login= new conexao();
$l = new conexao();
$conn = $l->getconexao();

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="images/favicon.ico">

    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Blog Sobre Marketing Digital - Agência SoftHar</title>
	
    <link href="<?php echo $diretorio; ?>css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo $diretorio; ?>css/estilo.css" rel="stylesheet">
    <script src="<?php echo $diretorio; ?>js/jquery-1.11.2.min.js"></script>	
	
	<link href='https://fonts.googleapis.com/css?family=Crimson+Text:400,700italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Cantarell:400,400italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Istok+Web:400,400italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,300' rel='stylesheet' type='text/css'>



<!-- bxSlider Javascript file -->
<script src="<?php echo $diretorio; ?>js/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="<?php echo $diretorio; ?>js/jquery.bxslider.css" rel="stylesheet" />
	
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>
$(document).ready(function(){
	
  $('.bxslider').bxSlider({
  auto: true,
});

});

</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-74510809-1', 'auto');
  ga('send', 'pageview');

</script>
</head>

<body>


<?php
	require 'header.php';
	require 'banner-noticias.php';

?>

<main>

<aside class="container-fluid">
<div class="row">
	<div class="col-xs-12 col-lg-2 col-md-2 col-sm-2">
		<div class="row">
			<?php
			 require 'menu-vertical.php';
			?>
		</div>
	</div>
	
    <div class=' col-xs-12 col-lg-10 col-md-10 col-sm-10 br bg-index br-bottom' style="background-color:#EEEEEE;">
       <div class="col-xs-12 col-lg-8 col-md-9">       
			   <div class='row'>
   <?php
	$cont = 0;
	$paginacao=0;
	$itenspag=9;
	$sql =	"SELECT * FROM estrutura";
					$query = mysqli_query($conn,$sql);
					while($row = mysqli_fetch_assoc($query))
					{$paginacao++;}

	
	
   if($paginacao>9){
            echo "<div class='col-xs-12 text-center' id='to'>";
     $paginas = ceil($paginacao/9);
          
      $count = 0;
 
 
   for ($i=0; $i < ($paginas*$itenspag); $i=$i+9) { 

      $string ="?to=".$i.'#to';
      $count++;
	  $primeiro =  $_GET['to'] - 9;
	  $pontos = $_GET['to'] + 9;  
	  
	  if($i <= $pontos &&  $i >= $primeiro) //exibe o número atual o próximo e o anterior
	  {
		  if($i==$primeiro)
		  {
			echo "<a class='btn btn-default' href='".$diretorio."index.php$string' ><span class='glyphicon glyphicon-menu-left'></span></a>";
		  }
		  elseif($i==$pontos)
		  {
			 echo "<a class='btn btn-default' href='".$diretorio."index.php$string' ><span class='glyphicon glyphicon-menu-right'></span></a>";
		  }
		  else
		  {		  
			echo "<a class='btn btn-default' href='".$diretorio."index.php$string' >$count</a>";
		  }
		  	  
	  }
		
   }
   
   echo " <div class='btn' style='background-color:#FFFFFF;color:#999999;border:1px solid #999999' > de $paginas</div>";

      echo "</div>";
          }

if(isset($_GET['to'])){
$to = $_GET['to'];
}else{
  $to = 0;
}

?>	
               
                <?php 
				$sql = "SELECT * FROM estrutura ORDER By id DESC  LIMIT $itenspag OFFSET $to";
				$query = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_array($query))
				{
    
 $string = $row['titulo'];
 
$tr = strtr(
 
    $string,
 
    array (
 
      'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
      'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
      'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N',
      'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O',
      'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Ŕ' => 'R',
      'Þ' => 's', 'ß' => 'B', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
      'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
      'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
      'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
      'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y',
      'þ' => 'b', 'ÿ' => 'y', 'ŕ' => 'r', ' ' => '-', '_' => '-', ',' => '',
	  ':' => '', '"' => '', "'" => '', '(' => '',')' => '','!' => '','@' => '',
	  '#' => '','$' => '','%' => '','¨' => '','&' => '','*' => '','?' => '','.' => '','=' => ''
	  )
);
$titulo = strtolower($tr);
	
?>
	
      <form method="get" action="<?php echo $diretorio; ?>artigo.php?id=<?php echo $row['id']; ?>">
		<div class="col-xs-12 col-lg-4 col-md-4 col-sm-4 br br-bottom ">
		<a href="<?php echo $diretorio; ?>artigo/<?php echo $row['id']; ?>/<?php echo $titulo; ?>" class="opacity">
			<div class="col-xs-12 ">
				<div class="row">
					<figure class="col-xs-12 borda br br-bottom text-center img-center " style="min-height: 335px">
						<div class="col-xs-12 " style="background:url(<?php echo $diretorio; ?>admin/fotos/<?php echo $row['foto']; ?>);background-size:auto 100%;height:300px;background-position:center;">
						</div>
						<div class="container-fluid">
						<figcaption class="col-xs-12 col-sm-12 col-md-12 col-lg-12 product text-left br " style="height:250px;">
							<div class="row">
										<?php
											$titulo = $row['titulo'];
											echo $resumo = substr("$titulo", 0,140);
											echo '';								
										?>
							</div>
						</figcaption>
						</div>
					</figure>
				</div>
			</div>
		</a>
		</div>
	</form>
	
<?php 
					$cont++;
						if($cont==3)
						{
							$cont = 0;
							echo "<div class='clearfix'></div>";
						}
					}
          
?>
           <div class="clearfix"></div>
<?php

   if($paginacao>9){
            echo "<div class='col-xs-12 text-center' id='to'>";
     $paginas = ceil($paginacao/9);
          
      $count = 0;
 
 
   for ($i=0; $i < ($paginas*$itenspag); $i=$i+9) { 

      $string ="?to=".$i.'#to';
      $count++;
	  $primeiro =  $_GET['to'] - 9;
	  $pontos = $_GET['to'] + 9;  
	  
	  if($i <= $pontos &&  $i >= $primeiro) //exibe o número atual o próximo e o anterior
	  {
		  if($i==$primeiro)
		  {
			echo "<a class='btn btn-default' href='".$diretorio."index.php$string' ><span class='glyphicon glyphicon-menu-left'></span></a>";
		  }
		  elseif($i==$pontos)
		  {
			 echo "<a class='btn btn-default' href='".$diretorio."index.php$string' ><span class='glyphicon glyphicon-menu-right'></span></a>";
		  }
		  else
		  {		  
			echo "<a class='btn btn-default' href='".$diretorio."index.php$string' >$count</a>";
		  }
		  	  
	  }
		
   }
   
   echo " <div class='btn' style='background-color:#FFFFFF;color:#999999;border:1px solid #999999' > de $paginas</div>";

      echo "</div>";
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
		



		
		
		<div class="clearfix br"></div>

		
	
	</div>
</aside>

<aside class="container-fluid busca br">
	<div class="row">
	</div>
</aside>
</main>

<?php
	require('footer.php');
?>

    <script src="<?php echo $diretorio; ?>js/bootstrap.min.js"></script>
</body>
</html>