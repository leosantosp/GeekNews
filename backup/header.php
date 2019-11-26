<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-74510809-1', 'auto');
  ga('send', 'pageview');

</script>

 <!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1285527874833637'); // Insert your pixel ID here.
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1285527874833637&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->

<?php
//apresentar a data por extenso
    $data = date('D');
    $mes = date('M');
    $dia = date('d');
    $ano = date('Y');
    
    $semana = array(
        'Sun' => 'Domingo', 
        'Mon' => 'Segunda-Feira',
        'Tue' => 'Terca-Feira',
        'Wed' => 'Quarta-Feira',
        'Thu' => 'Quinta-Feira',
        'Fri' => 'Sexta-Feira',
        'Sat' => 'Sábado'
    );
    
    $mes_extenso = array(
        'Jan' => 'Janeiro',
        'Feb' => 'Fevereiro',
        'Mar' => 'Marco',
        'Apr' => 'Abril',
        'May' => 'Maio',
        'Jun' => 'Junho',
        'Jul' => 'Julho',
        'Aug' => 'Agosto',
        'Nov' => 'Novembro',
        'Sep' => 'Setembro',
        'Oct' => 'Outubro',
        'Dec' => 'Dezembro'
    );
    
    
?>

<header>
<div class="visible-xs">
   <!-- <a href="https://www.softhar.com.br" target="_blank"><img src='<?php echo $diretorio; ?>images/merece.png' class="img-responsive"/></a> -->
  </div>
 
  <div class="hidden-xs">
    <a href="https://www.softhar.com.br" target="_blank">
        <!-- <img src='<?php echo $diretorio; ?>images/merece.png' class="img-responsive"/></a> -->
  </div>
	<section class="container-fluid header ">
		<div class="row">
		<?php
		date_timezone_set("America", "Sao_Paulo");
		
			$sql = "SELECT * FROM telefone_rodape WHERE id = '1'";
			$query = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($query);
		?>
			<div class="col-xs-12 col-lg-4 col-md-4 col-sm-5 bg-sobreheader meio-br" style="color:#E0AF2A;font-family:22px; height:40px">
			
			
			
			Pergunte-nos o que preparamos para o seu negócio <a href="http://www.softhar.com.br" target="_blank"><strong>Neste Mês<strong></a>
			
			</div>
			
			<div class="col-xs-12 col-lg-8 col-md-8 col-sm-7  bg-sobreheader meio-br">
			<ul class="pull-right">
				<li>
                                    <a href="<?php echo $diretorio; ?>index">

					Estamos Sempre Online. <strong> Reinventado o seu Negócio : ) </strong>
				</a>       
				</li>

				
			</ul>
			</div>
                        <div class='clearfix'></div> 
			<div class="col-lg-3  col-md-3  col-sm-3  col-xs-12 ">

					<div class="row">
						<figure class="col-lg-12 col-md-10 col-sm-12  col-xs-12 br">
                             <a href="<?php echo $diretorio; ?>index">
							 <?php
								$sql = "SELECT * FROM banner_fixo";
								$query = mysqli_query($conn,$sql);
								$row = mysqli_fetch_assoc($query);
								{
							 ?>
								<img src="<?php echo $diretorio; ?>admin/images/<?php echo $row['nome']; ?>" id='logo' class="img-responsive img-center" width="250px"/>
							<?php
								}
							?>
							</a>
							
							<br/>
						</figure>
					</div>
			</div>
		
			<div class="col-xs-12 col-lg-6 col-md-6 col-sm-9">
				<?php
					require 'menu.php';
				?>
			</div>
		
			<div class="hidden-xs col-lg-3 col-lg-offset-0 col-md-3 col-sm-12 col-sm-offset-0 number br30">
										<!--busca.php-->
				<form action="<?php echo $diretorio; ?>buscar.php?to=0&busca=#index"  method="get"  class="row col-xs-12 bg-white">
					<div class="input-group">
							<span class="input-group-btn">
								<button type="submit" class="btn button" style="background-color:#FFF; border-color:#999">
									<img src="<?php echo $diretorio; ?>images/lupa.png"  width="27px"/>
								</button>
							</span>
						<input type="text" name="busca" class="form-control-header br br-bottom" style="background-color:#FFF; border-width:1px; border-color:#999"  placeholder="Digite sua Busca..."/>
					</div><!-- /input-group -->
				</form>
			</div>

			<div class="col-xs-12 hidden-sm hidden-md hidden-lg col-lg-4 col-lg-offset-2 col-md-5 col-md-offset-0 col-sm-5 col-sm-offset-0  number br ">

				<form name='busca' action="<?php echo $diretorio; ?>buscar.php?to=0&busca=#index"  method="get"  class="row col-xs-12 bg-white">
					<div class="input-group">
						<span class="input-group-btn">
							<button class="btn button pull-left" type="submit">
								<img src="<?php echo $diretorio; ?>images/lupa.png"  width="30px"/>
							</button>
						</span>
						<input type="text" name="busca" class="form-control-header br" placeholder="O que está procurando?"/>
					</div>
				</form>

			</div>
			
			
		</div>
	</section>
</header>
<div class="clearfix"></div>
	