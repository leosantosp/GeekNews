<nav  class="bg-menu" id="menu" >
			<div class="row">
				<div class="navbar-header navbar-default col-xs-12">
					<button type="button" class="navbar-toggle  col-xs-12" data-toggle="collapse" data-target="#menu-nav">
                       Confira Nossos Produtos
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
				 <a href="produtos.php?id=<?php echo $row['id']; ?>#index" class="col-xs-12 col-lg-1 meio-br meio-br-bottom  categoria text-center"><?php echo $row['nome']; ?></a>
				 <?php
					}
				 ?>					
				</div>
			</div>
			</div>
		</nav>