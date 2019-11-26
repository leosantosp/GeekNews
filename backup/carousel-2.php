<div class="container-fluid  ">
<div class="row">

		<div id="carousel-example-generic2" class="carousel slide " data-ride="carousel">

  <ol class="carousel-indicators hidden-xs hidden-sm">
  
    
 <?php
$i = 0;
	$sql = mysqli_query($conn,"SELECT * FROM banner");
	
	while($query = mysqli_fetch_array($sql))
	{		
	 $i = $i + 1;
	}

?>
  
 <?php
  $i=$i/2;
$cont = $i;
 
	$sql = mysqli_query($conn,"SELECT * FROM banner ORDER By id LIMIT $i OFFSET $i");
	
	while($query = mysqli_fetch_array($sql))
	{ 

		if($cont == $i)
		{ $active = "active";}
		else
		{$active = '';}
		
?>
	<li data-target="#carousel-example-generic2" data-slide-to="<?php echo $cont ?>" class=" <?php echo $active; ?>"></li>
<?php
	$cont = $cont + 1;
	}

?>
   
  </ol> 

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
  <?php 
  
  $cont = 0;
	$sql = mysqli_query($conn,"SELECT * FROM banner ORDER By id LIMIT $i OFFSET $i");
	
	while($query = mysqli_fetch_array($sql))
	{ $cont = $cont + 1;
		if($cont == 1)
		{ $active = "active";}
		else
		{$active = '';}
  ?>

    <div class="item <?php echo $active; ?>">
	  <a href="<?php echo $query['url']; ?>">
      <img src="/admin/images/<?php echo $query['nome']; ?>" class='img-responsive'>
		  </a>
    </div>

<?php 
	}
?>
	
  </div>

</div>
</div>
</div>