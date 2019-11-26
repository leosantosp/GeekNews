<div class="container-fluid  ">
	<?php 
	  
		$cont = 0;
		$sql = mysqli_query($conn,"SELECT * FROM banner ORDER By id");
		$num = mysqli_num_rows($sql);
		if($num > 0)
		{
		
	?>
	
	<div class="row">
	
		<ul class="bxslider">
		
			<?php 
			  
				$cont = 0;
				$sql = mysqli_query($conn,"SELECT * FROM banner ORDER By id");
					
				while($query = mysqli_fetch_array($sql))
				{ 
					if($cont == 0)
					{ $active = "active";}
					else
					{$active = '';}
			?>

			<a href="<?php echo $query['url']; ?>" rel="nofollow">
				<li class="col-xs-12 img-center"><img src="<?php echo $diretorio; ?>admin/images/<?php echo $query['nome']; ?>" class='img-responsive img-center'></li>
			</a>
		   
			<?php 
			$cont = $cont + 1;
				}
			?>

		</ul>

	</div>
	
	<?php
		}
	?>
</div>