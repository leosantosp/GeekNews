 <div class="text-center br40 menu-up">

 <?php

	$sql = "SELECT * FROM categoria_destaque" ;
	$query = mysqli_query($conn,$sql);         
    while($row = mysqli_fetch_assoc($query))
	{	$id = $row['categoria'];
		$sql_est = "SELECT * FROM categoria WHERE id = $id";
		$query_est = mysqli_query($conn,$sql_est);
		$resultado_est = mysqli_fetch_array($query_est);
		

 ?>
 <?php $string = $resultado_est['nome'];
 
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
	  ':' => '' , '"' => '' , "'" => '' , '(' => '',  ')' => '',  '!' => '',
	  '@' => '',  '#' => '' ,'$' => '' ,'%' => ''  ,  '¨' => '',  '&' => '',
	  '*' => '','?' => '','.' => '','=' => ''
    )
);
$categoria = strtolower($tr);
 ?> 
		<div class="col-xs-12 col-lg-3 col-md-3 col-sm-3" id="link<?php echo $row['id']; ?>">
			<a href="<?php echo $diretorio; ?>categoria/<?php echo $categoria; ?>/<?php echo $resultado_est['id']; ?>/0#index" class="text-center">
				<?php echo $resultado_est['nome']; ?>
			</a>
		</div>



<?php
	}
?>
		
 </div>


