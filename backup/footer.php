<footer class="container-fluid">
	<section class="br">
			<div class="col-xs-12 number br30">
										<!--busca.php-->
				<form name='busca' action="<?php echo $diretorio; ?>buscar.php?to=0&busca=#index"  method="get"  class="row col-xs-12 bg-white">
					<div class="input-group">
							<span class="input-group-btn" >
								<button type="submit" class="btn button" style="background-color:#FFF; border-color:#999" type="button">
									<img src="<?php echo $diretorio; ?>images/lupa.png"  width="27px"/>
								</button>
							</span>
						<input type="text" name="busca" class="form-control-header br br-bottom"  style="border:1px solid #DDD;" placeholder="Escreva aqui a sua Busca..."/>
					</div><!-- /input-group -->
				</form>
			</div>

		<div class="col-xs-12 text-center footer-arial">
			<?php
				require 'menu.php';
			?>
		</div>
		
			<div class="col-xs-12 divisor br">
				<div class="row">
					<hr/>
				</div>
			</div>
			
		<div class="col-xs-12">
		<?php
			$sql = "SELECT * FROM telefone_rodape WHERE id = '2'";
			$query = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($query);
		?>		
			<?php echo $row['texto']; ?>
		</div>
		
			<div class="col-xs-12 divisor br">
				<div class="row">
					<hr/>
				</div>
			</div>
		<?php
			$sql = "SELECT * FROM telefone_rodape WHERE id = '3'";
			$query = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($query);
		?>		
	
		<div class="col-xs-12 col-lg-5 col-lg-offset-0 col-md-5 col-sm-4 text-left height footerp">
			<?php echo $row['texto']; ?>	
		</div>

		
		<div class="col-xs-12 col-lg-2 col-lg-offset-0 col-md-2 col-sm-4 text-left height footerp br-bottom">
			<?php
				$sql = "SELECT * FROM banner_fixo";
				$query = mysqli_query($conn,$sql);
				$row = mysqli_fetch_assoc($query);
				{
			 ?>
					<img src="<?php echo $diretorio; ?>admin/images/<?php echo $row['nome']; ?>" class="img-responsive" alt=""/>
				<?php
				}
				?>
		</div>

		<div class="col-xs-12 col-lg-4 col-lg-offset-0 col-md-4 col-sm-4 text-left height footerp">
			<p class="footer-footer text-right">
				
			</p>
		</div>
		
	</section>

</footer>