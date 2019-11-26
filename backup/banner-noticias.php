<div class="container-fluid ">
<div class="row">

		<div id="carousel-example-generic" class="carousel slide " data-ride="carousel">

  <ol class="carousel-indicators hidden-xs hidden-sm">
  
 <?php
  $cont = 0;
	$sql = mysqli_query($conn,"SELECT * FROM estrutura WHERE banner = 1 ORDER By id DESC");
	
	while($query = mysqli_fetch_array($sql))
	{ 

		if($cont == 0)
		{ $active = "active";}
		else
		{$active = '';}
		
?>
	<li data-target="#carousel-example-generic" data-slide-to="<?php echo $cont ?>" class=" <?php echo $active; ?>"></li>
<?php
	$cont = $cont + 1;
	}

?>
    


  </ol> 

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
  <?php 
  
  $cont = 0;
	$sql = mysqli_query($conn,"SELECT * FROM estrutura WHERE banner = 1 ORDER By id DESC");
	
	while($query = mysqli_fetch_array($sql))
	{ $cont = $cont + 1;
		if($cont == 1)
		{ $active = "active";}
		else
		{$active = '';}
	
 $string = $query['titulo'];
 
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

    <div class=" item <?php echo $active; ?>" >
	  <a href="<?php echo $diretorio; ?>artigo/<?php echo $query['id']; ?>/<?php echo $titulo; ?>">
		<div class="col-lg-8 col-md-8 col-sm-8 banner-height" style="background:url('<?php echo $diretorio; ?>admin/fotos/<?php echo $query['foto']; ?>');background-repeat:no-repeat;background-size:100% auto;height:400px;">
		
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 banner">
			<h2 class="" style="color:#EEEEEE;border-top:1px solid #666666;border-bottom:1px solid #666666;">
				<?php
					echo $query['titulo'];
				?>
			</h2>
		</div>
	</a>
    </div>

<?php 
	}
?>
	
  </div>

</div>
</div>
</div>