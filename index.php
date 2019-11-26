<?php require 'load.php'; 
$l = new conexao();
$conn = $l->getconexao();
emulador_de_get();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<link rel="icon" href="<?php echo Config::DIRETORIO_SITE; ?>images/icon.png" type="image/gif" sizes="16x16">
	<title><?php echo Config::TITLE_SITE; ?></title>


</head>
<body>

	<section>
		
		<?php require 'menu.php'; ?>

		<article>
			<div class="row index" id="top">
				<ul class="col s12 botoes center">
					<?php 
					$sqlcategorias = "SELECT * FROM tag_menu, tags WHERE tags.id = tag_menu.idTag ORDER BY tags.nome  ASC LIMIT 8";
					$querycategorias = mysqli_query($conn, $sqlcategorias);

					while($rowcategoria = mysqli_fetch_array($querycategorias)){ ?>
					<li><a href="<?php echo Config::DIRETORIO_SITE; ?>categoria.php?id=<?php echo $rowcategoria['id']; ?>&titulo=<?php echo caracteres_especiais($rowcategoria['nome']); ?>"><?php echo $rowcategoria['nome'] ?></a></li>
					<?php
					}
					 ?>
				</ul>

				<div class="pag paginacao col s12 l9">

					<!-- <h3 class="destaque-title">DESTAQUE</h3>
					<hr> -->

					<!-- Paginação PHP -->
					<?php
					$postpagina = 5; 
					$sqlcontagempaginacao = "SELECT * FROM admin, materias WHERE materias.redator = admin.id";
					$querycontagempaginacao = mysqli_query($conn, $sqlcontagempaginacao);
					$numpaginas = ceil($numpaginas = mysqli_num_rows($querycontagempaginacao)/$postpagina);

					$count = 0; $postpaginacount=0;
					while($count < $numpaginas){
						?>
					<div class="page" >

						<?php 
					$sqlpostdestaque = "SELECT * FROM admin, materias WHERE materias.redator = admin.id ORDER BY materias.data DESC LIMIT ".$count.",1";
					$querypostdestaque = mysqli_query($conn, $sqlpostdestaque);
					while($rowpostdestaque = mysqli_fetch_array($querypostdestaque)){
						$iddestaque = $rowpostdestaque['id'];
						?>
						
						<aside style="padding: 2%;"><a href="<?php echo Config::DIRETORIO_SITE; ?>artigo.php?id=<?php echo $rowpostdestaque['id']; ?>&titulo=<?php echo caracteres_especiais($rowpostdestaque['titulo']); ?>">
							<div class="destaque" style="background-image: url(<?php echo Config::DIRETORIO_SITE; ?>admin/images/materias/large/<?php echo $rowpostdestaque['imagem']; ?>);">
								<!-- <figure>
									<img  src="<?php echo Config::DIRETORIO_SITE; ?>admin/images/materias/large/<?php echo $rowpostdestaque['imagem']; ?>" alt="<?php echo Config::TITLE_SITE; ?> - SEO">
									<figcaption><?php echo Config::TITLE_SITE; ?> - <?php echo $rowpostdestaque['titulo']; ?></figcaption>
								</figure> -->
								<div class="destaque-linear">
								<h2><?php echo $rowpostdestaque['titulo']; ?></h2>
								<p><?php echo $rowpostdestaque['subtitulo']; ?></p></a>
								</div>
								
								<!-- <p style="text-align: right; font-size: 0.9em;">Por  <?php echo $rowpostdestaque['nome']; ?>  |  <?php echo ucfirst(strftime('%d de', strtotime($rowpostdestaque['data']))); ?>
									<?php echo ucfirst(strftime('%B de %Y', strtotime($rowpostdestaque['data']))); ?> ás <?php echo date('H:i', strtotime($rowpostdestaque['data'])) ?></p> -->
								<!-- <div class="center">
									<a href="<?php echo Config::DIRETORIO_SITE; ?>artigo/<?php echo $rowpostdestaque['id']; ?>/<?php echo caracteres_especiais($rowpostdestaque['titulo']); ?>"> <button class="btn-large btn-destaque">	 Continuar Lendo [...] </button> </a>
								</div> -->
								
							</div>
							
						
						</aside>
						<?php } ?>

						<?php 
					$sqlmaterias = "SELECT * FROM admin, materias WHERE materias.redator = admin.id AND materias.id <> '$iddestaque' ORDER BY materias.data DESC LIMIT ".$postpaginacount.",".$postpagina."";
					$querymaterias = mysqli_query($conn, $sqlmaterias);
					while($rowmateria = mysqli_fetch_array($querymaterias)){ ?>
						<a href="<?php echo Config::DIRETORIO_SITE; ?>artigo.php?id=<?php echo $rowmateria['id']; ?>&titulo=<?php echo caracteres_especiais($rowmateria['titulo']); ?>">
						<aside>
							<div class="col m6 s12 ">
								
								<figure class="figure-another-news">
									<img  src="<?php echo Config::DIRETORIO_SITE; ?>admin/images/materias/large/<?php echo $rowmateria['imagem']; ?>" alt="<?php echo Config::TITLE_SITE; ?> - <?php echo $rowmateria['titulo']; ?>">
									<figcaption ><?php echo Config::TITLE_SITE; ?> - Leads</figcaption>
								</figure>
							</div>
							<div class="col m6 s12 another-news">								
								<h2 class="another-news-title"><?php echo $rowmateria['titulo']; ?></h2>
								<small><?php echo ucfirst(strftime('%d de', strtotime($rowmateria['data']))); ?>
									<?php echo ucfirst(strftime('%B de %Y', strtotime($rowmateria['data']))); ?> ás <?php echo date('H:i', strtotime($rowmateria['data'])) ?></small>
								<p><?php echo $rowmateria['subtitulo']; ?></p>
								 <p><?php echo substr($rowmateria['descricao'], 0, 270); ?></p>
							</div>
							<div class="center btnmaterias">
									<a href="<?php echo Config::DIRETORIO_SITE; ?>artigo.php?id=<?php echo $rowmateria['id']; ?>&titulo=<?php echo caracteres_especiais($rowmateria['titulo']); ?>"><button class="btn-large btn-another-news">	 Continuar Lendo [...] </button></a>
							</div>
							<div class="clearfix"></div>
							<hr style="border: 1px solid #DC143C">
						</aside></a>
					<?php } ?>


					</div>
					<?php 
						$count++; $postpaginacount = $postpaginacount + $postpagina;} ?>
					<!-- Paginação PHP -->



				</div>
				

				<?php include('painellateral.php'); ?>

				
			</div>
		</div>
	</article>

	<article>
		<div class="row news center">
			<div class="col m8 offset-m2 s12">
				<h2>QUE A NOSSA NEWSLETTER ESTEJA COM VOCÊ, JOVEM PADAWAN!</h2>
				<h3>Ouvi falar que quem assina a nossa newsletter, além de ficar por dentro de todas as notícias, tem mais chances de conseguir uma vaga na Escola de Magia e Bruxaria de Hogwarts</h3>
				<fieldset>
					<form action="<?php echo Config::DIRETORIO_SITE; ?>envianewsletter.php" method="post">
						<div class="col l9 m6 s12">
							<input type="email" name="email" required placeholder="Seu e-mail*">
						</div>
						<div class="col l3 m6 s12">
							<button type="submit" class="btn waves-effect">LINK START</button>
						</div>
					</form>
				</fieldset>
			</div>
		</div>
	</article>

	<?php require 'footer.php'; ?>

</section>
<?php require("links.php"); ?>

<?php require("scripts.php"); ?>

</body>
</html>