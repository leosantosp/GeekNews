<?php
session_start();
require('admin/class/conexao.php');

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
	
	<title>Blog de Conteúdo Softhar</title>
	
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
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</head>

<body>
<?php
	require 'header.php';
	require 'banner-noticias.php';

?>

<main>

<aside class="container-fluid" id="index">
<div class="row">
	<div class="col-xs-12 col-lg-2 col-md-2 col-sm-3">
		<div class="row">
			<?php
			 require 'menu-vertical.php';
			?>
		</div>
	</div>
	
    <div class=' col-xs-12 col-lg-10 col-md-10 col-sm-9 br bg-index br-bottom' style="background-color:#EEEEEE;">
       <div class="col-xs-12 col-lg-12 col-md-12">       
			   <div class='row'>
   <?php
   $search = $_GET['busca'];
	$cont = 0;
	$paginacao=0;
	$itenspag=9;
	$sql =	"SELECT * FROM estrutura WHERE titulo LIKE '%$search%' OR texto LIKE '%$search%'";
					$query = mysqli_query($conn,$sql);
					while($row = mysqli_fetch_assoc($query))
					{$paginacao++;}

	
	
   if($paginacao>9){
            echo "<div class='col-xs-12 text-center' id='to'>";
     $paginas = ceil($paginacao/9);
          
      $count = 0;
 
 
   for ($i=0; $i < ($paginas*$itenspag); $i=$i+9) { 

      $string =$i.'#index';
      $count++;
	  $primeiro =  $_GET['to'] - 9;
	  $pontos = $_GET['to'] + 9;  
	  $ultima=($paginas-1)*$itenspag;
	  
	  if($i <= $pontos &&  $i >= $primeiro) //exibe o número atual o próximo e o anterior
	  {
		  if($i==$primeiro)
		  {
			echo "<a class='btn btn-default' href='".$diretorio."buscar.php?busca=facebook&to=0#index' >Início</a>";
			echo "<a class='btn btn-default' href='".$diretorio."buscar.php?busca=facebook&to=$i#index' ><span class='glyphicon glyphicon-menu-left'></span></a>";
		  }
		  elseif($i==$pontos)
		  {
			 echo "<a class='btn btn-default' href='".$diretorio."buscar.php?busca=facebook&to=$i#index' ><span class='glyphicon glyphicon-menu-right'></span></a>";
			 echo "<a class='btn btn-default' href='".$diretorio."buscar.php?busca=facebook&to=$ultima#index' >Última</a>";
		  }
		  else
		  {		  
			echo "<a class='btn btn-default' href='".$diretorio."buscar.php?busca=facebook&to=$i#index' >$count</a>";
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
				$sql = "SELECT * FROM estrutura WHERE titulo LIKE '%$search%' OR texto LIKE '%$search%' ORDER By id DESC  LIMIT $itenspag OFFSET $to";

				$query = mysqli_query($conn,$sql);		
				$num=mysqli_num_rows($query);

				if($num>=1){				
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
	
      <form method="get" action="artigo.php?id=<?php echo $row['id']; ?>">
	  <div class="container-fluid">
		<div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 br br-bottom ">
		<a href="<?php echo $diretorio; ?>artigo/<?php echo $row['id']; ?>/<?php echo $titulo; ?>"  class="opacity">
			<div class="col-xs-12 ">
				<div class="row">
					<figure class="col-xs-12  borda br br-bottom text-center img-center " style="min-height: 320px">
						<div class="col-xs-12 col-lg-5 col-md-5 col-sm-12" style="background:url(<?php echo $diretorio; ?>admin/fotos/<?php echo $row['foto']; ?>);background-size:auto 100%;height:300px;background-position:center;">
							<!--<img src="admin/fotos/<?php echo $row['foto']; ?>" class="img-responsive img-center image-height-p" style="height:200px" alt=""/> -->
						</div>
						<figcaption class="col-xs-12 col-lg-7 col-md-7 col-sm-12 product text-justify br-bottom" style="border-bottom:5px solid #666666;">
						
										<?php						

											$titulo = $row['titulo'];
											echo $resumo = substr("$titulo", 0,172);
											//echo '...';								
										?>

						</figcaption>
						<div class="col-xs-12 col-lg-7 col-md-7 col-sm-12 text-justify br">
										<?php										
											$titulo = $row['texto'];
											echo $resumo = strip_tags(substr("$titulo", 0,1500));
						
										?>	
							<div class='clearfix'></div>		
						</div>
					</figure>
				</div>
			</div>
		</a>
		</div>
		</div>
	</form>

	
<?php 
					$cont++;
						if($cont==1)
						{
							$cont = 0;
							echo "<div class='clearfix'></div>";
						}
					}
				}else
				{
			
?>
					<h1>O termo <strong><span style="border-bottom:5px solid #666666;">'<?php echo $search ?>'</span></strong> não foi encontrado</h1>
					<h2>Tente mudar o seu método de pesquisa, utilize:</h2>
					<ol>
						<li>
							<h3>
								Sinônimos;
							</h3>
						<li>
							<h3>
								Frases curtas;
							</h3>
						</li>
						<li>
							<h3>
								Parte de uma frase caso não a conheça completamente.
							</h3>
						</li>
					</ol>
<?php
				}
?>
          
<?php

   if($paginacao>9){
            echo "<div class='col-xs-12 text-center' id='to'>";
     $paginas = ceil($paginacao/9);
          
      $count = 0;
 
 
   for ($i=0; $i < ($paginas*$itenspag); $i=$i+9) { 

      $string =$i.'#index';
      $count++;
	  $primeiro =  $_GET['to'] - 9;
	  $pontos = $_GET['to'] + 9;  
	  $ultima=($paginas-1)*$itenspag;
	  
	  if($i <= $pontos &&  $i >= $primeiro) //exibe o número atual o próximo e o anterior
	  {
		  if($i==$primeiro)
		  {
			echo "<a class='btn btn-default' href='".$diretorio."buscar.php?busca=facebook&to=0#index' >Início</a>";
			echo "<a class='btn btn-default' href='".$diretorio."buscar.php?busca=facebook&to=$i#index' ><span class='glyphicon glyphicon-menu-left'></span></a>";
		  }
		  elseif($i==$pontos)
		  {
			 echo "<a class='btn btn-default' href='".$diretorio."buscar.php?busca=facebook&to=$i#index' ><span class='glyphicon glyphicon-menu-right'></span></a>";
			 echo "<a class='btn btn-default' href='".$diretorio."buscar.php?busca=facebook&to=$ultima#index' >Última</a>";
		  }
		  else
		  {		  
			echo "<a class='btn btn-default' href='".$diretorio."buscar.php?busca=facebook&to=$i#index' >$count</a>";
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