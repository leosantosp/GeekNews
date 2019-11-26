<?php
session_start();
require 'admin/class/conexao.php';

$l = new conexao();
$conn = $l->getconexao();

?>
<!DOCTYPE html>
<html lang="pt-Br">
<head>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="css/estilo.css" rel="stylesheet">
  <script src="js/jquery-1.11.2.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Sansita+One' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>

	<script src="js/script.js"></script>
</head>

<body >
  <header>
    <section class="row row-custom">
    <?php
    require 'header.php';
	require 'menu-horizontal.php'
    ?>
    </section>
  </header>
  <?php
 require 'carousel.php';

  ?>
  <main>

<section class="container-fluid " id="index">
	<div class="row">
	<article>
		<figure class="col-xs-12 col-lg-8 col-md-3 col-sm-6 " >

	<?php
		$id = $_POST['id'];
	?>

				<div class="row">
		<?php
		
		
		$sql1 = mysqli_query($conn,"SELECT * FROM estrutura WHERE id = $id");
		while($query1 = mysqli_fetch_assoc($sql1))
		{
			
		?>
				<div class="col-xs-12  br-bottom ">
				<h3 class="text-center" style="color:#000;">
					<?php echo $query1['nome']; ?>
				</h3>
				<div class="col-xs-12 col-lg-6 col-md-4 col-sm-4 br-bottom" >
				<figure class="col-xs-12 ">
					<div class="row">
					<img src="admin/fotos/<?php echo $query1['foto']; ?>" class="img-responsive img-center" alt=""  />
					</div>
				</figure>
				</div>
				<div class="text-left col-xs-12 col-lg-6 col-lg-offset-0 col-md-4 col-sm-4 text-justify" >
				<h2 class="text-center">
					<?php echo  $query1['titulo'];?>
				</h2>				
				<p class="" style="font-family:'Century Gothic';font-size:30px;">
					<?php echo $query1['texto']; ?> 
				</p>				
				</div>

				</div>


	<?php

		}
		
	?>
			</div>
		</figure>
					
			<div class="col-lg-4 bg-form" style="background-color:#000000;">
			
				<header class="text-center">
					<h2 class='font-camp'>
						Mais informações?
					</h2>	
				</header>

			  <form class="col-xs-12 " name="fcontato"  action="envia.php" method="post">

				  <div class="form-group">
					<label for="form-nome"> Seu Nome: </label>
					<input type="text" name="Nome" id="form-nome" class="form-control" required> 


					<label for="form-tel">Seu whatsapp: </label>
					<input type="text" name="Whatsapp" id="form-tel" class="form-control" > 

					<label for="form-tel">Seu telefone: </label>
					<input type="text" name="Telefone" id="form-tel" class="form-control" required> 

					<label for="form-email">Seu e-mail: </label>
					<input type="text" name="E-mail" id="form-email" class="form-control"  required> 
				   
				  </div>

				  <label for="form-msg">Como podemos lhe ajudar? </label>
				  <textarea name="Mensagem" id="form-msg" cols="30" rows="7" class="form-control"></textarea>

				  <p class="text-center br ">
					<button type="submit" class="enviar-contato font-camp btn btn-success" >
						Enviar
					</button>
				  </p>

			  </form>
			  
			</div>
			
		</article>
	</div>

</section>
</main>

<div class="container-fluid">
	<div class="row">
		<?php
			require 'footer.php';
		?>
	</div>
</div>
<script src="js/bootstrap.min.js"></script>
</body>
</html>