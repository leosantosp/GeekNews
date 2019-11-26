<nav  class="bg-menu" id="menu" >
			<div class="row">
				<div class="navbar-header navbar-default col-xs-12 text-center">
					<button type="button" class="navbar-toggle  text-center" data-toggle="collapse" data-target="#menu-nav">
                       Menu
					</button>
				</div>
 
			<div class="collapse navbar-collapse menu-spy " id="menu-nav">  
				<div class="">
				<?php
					$sql = "SELECT * FROM categoria";
					$query = mysqli_query($conn,$sql);
					while($row = mysqli_fetch_assoc($query))
					{		
				?>
				
 <?php $string = $row['nome'];
 
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
      'þ' => 'b', 'ÿ' => 'y', 'ŕ' => 'r', ' ' => '-', '_' => '-', ',' => ''
    )
);
$categoria = strtolower($tr);
 ?>


				 <div class="col-xs-12 menu-button">
				 <a href="<?php echo $diretorio; ?>categoria/<?php echo $categoria; ?>/<?php echo $row['id']; ?>/0#index" class="col-xs-12 meio-br meio-br-bottom  categoria text-center"><?php echo $row['nome']; ?></a>
				 </div>
				 <?php
					}
				 ?>
				 
				<?php
					$sql = "SELECT * FROM cat_artigo";
					$query = mysqli_query($conn,$sql);
					while($row = mysqli_fetch_assoc($query))
					{		
				?>
				
 <?php $string = $row['nome'];
 
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
$categoria = strtolower($tr);
 ?>


				 <div class="col-xs-12 menu-button">
				 <a href="<?php echo $diretorio; ?>extra/<?php echo $categoria; ?>/<?php echo $row['id']; ?>/#index" class="col-xs-12 meio-br meio-br-bottom  categoria text-center"><?php echo $row['nome']; ?></a>
				 </div>
				 <?php
					}
				 ?>
				<div class="col-xs-12 menu-button">
				 <a href="<?php echo $diretorio; ?>faleconosco.php#index" class="col-xs-12 meio-br meio-br-bottom  categoria text-center">Fale Conosco</a>
				 </div>
				</div>
			</div>
			</div>
		</nav>