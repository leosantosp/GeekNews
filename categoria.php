<?php require 'load.php'; 
$l = new conexao();
$conn = $l->getconexao();
emulador_de_get();

if(isset($_GET['id'])){
	$idcategoria = addslashes($_GET['id']);
	$sqlcategoria = "SELECT * FROM tags, tag_materia, materias WHERE tags.id = '$idcategoria' AND tag_materia.idMateria = materias.id AND tags.id = tag_materia.idTag";
	$querycategoria = mysqli_query($conn, $sqlcategoria);
	$rowcategoriatag = mysqli_fetch_array($querycategoria);
	$numerocategoriatag = mysqli_num_rows($querycategoria);
}
	// echo "<script>window.location.href='".Config::DIRETORIO_SITE."index/'</script>";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<link rel="icon" href="<?php echo Config::DIRETORIO_SITE; ?>images/icon.png" type="image/gif" sizes="16x16">
	<title>Geek News - <?php echo $rowcategoriatag['nome']; ?></title>
	<meta name="keywords" content="<?php echo $rowcategoriatag['nome']; ?>">
	<meta name="description" content="Quer ficar por dentro de tudo sobre <?php echo $rowcategoriatag['nome']; ?> ? Então Acesse e fique por dentro das nossas postagens">

</head>
<body>

	<section>
		
		<?php require 'menu.php'; ?>

		<article>
			<div class="row index" id="top">
				<h1 style="display: none;"><?php echo $rowcategoriatag['nome']; ?></h1>
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

					<?php
					if($numerocategoriatag == 0){
					$sqloutrosresultados = "SELECT * FROM materias ORDER BY materias.destaque DESC LIMIT 3";
					$queryoutrosresultados = mysqli_query($conn, $sqloutrosresultados);
						?>
					<center><h2 class="nenhuma-postagem">Nenhuma postagem foi encontrada</h2></center>
						<div class="row recent">
			<h2 style="font-weight: bold;">Outras Materias</h2>
			<?php while($rowoutrosresultado = mysqli_fetch_array($queryoutrosresultados)){ ?>
			<a href="<?php echo Config::DIRETORIO_SITE;?>artigo.php?id=<?php echo $rowoutrosresultado['id'];?>&titulo=<?php echo caracteres_especiais($rowoutrosresultado['titulo']);?>">
				<div class="col m4 s12">
					<img src="<?php echo Config::DIRETORIO_SITE; ?>admin/images/materias/thumbnail/<?php echo $rowoutrosresultado['imagem']; ?>">
					<h3 class="others-posts"><?php echo $rowoutrosresultado['titulo'];?></h3>
				</div>
			</a><?php } ?>


		</div>
						<?php
					}
					?>

					<!-- Paginação PHP -->
					<?php
					$postpagina = 5; 
					$sqlcontagempaginacao = "SELECT * FROM admin, tag_materia, materias WHERE tag_materia.idTag = '$idcategoria' AND tag_materia.idMateria = materias.id AND materias.redator = admin.id";
					$querycontagempaginacao = mysqli_query($conn, $sqlcontagempaginacao);
					$numpaginas = ceil($numpaginas = mysqli_num_rows($querycontagempaginacao)/$postpagina);

					$count = 0; $postpaginacount=0;
					while($count < $numpaginas){
						?>
					<div class="page" >

						<?php 
					$sqlpostdestaque = "SELECT * FROM tag_materia, admin, materias WHERE tag_materia.idTag = '$idcategoria' AND tag_materia.idMateria = materias.id AND materias.redator = admin.id ORDER BY materias.data DESC LIMIT ".$count.",1";
					$querypostdestaque = mysqli_query($conn, $sqlpostdestaque);
					while($rowpostdestaque = mysqli_fetch_array($querypostdestaque)){
						$iddestaque = $rowpostdestaque['id'];
						?>
						<a href="<?php echo Config::DIRETORIO_SITE; ?>artigo.php?id=<?php echo $rowpostdestaque['id']; ?>&titulo=<?php echo caracteres_especiais($rowpostdestaque['titulo']); ?>">
						<aside style="padding: 2%;"><a href="<?php echo Config::DIRETORIO_SITE; ?>artigo.php?id=<?php echo $rowpostdestaque['id']; ?>&titulo=<?php echo caracteres_especiais($rowpostdestaque['titulo']); ?>">
							<div class="destaque" style="background-image: url(<?php echo Config::DIRETORIO_SITE; ?>admin/images/materias/large/<?php echo $rowpostdestaque['imagem']; ?>);">
								<!-- <figure>
									<img  src="<?php echo Config::DIRETORIO_SITE; ?>admin/images/materias/large/<?php echo $rowpostdestaque['imagem']; ?>" alt="<?php echo Config::TITLE_SITE; ?> - SEO">
									<figcaption><?php echo Config::TITLE_SITE; ?> - <?php echo $rowpostdestaque['titulo']; ?></figcaption>
								</figure> -->
								<h2><?php echo $rowpostdestaque['titulo']; ?></h2>
								<p><?php echo $rowpostdestaque['subtitulo']; ?></p></a>
								<!-- <p style="text-align: right; font-size: 0.9em;">Por  <?php echo $rowpostdestaque['nome']; ?>  |  <?php echo ucfirst(strftime('%d de', strtotime($rowpostdestaque['data']))); ?>
									<?php echo ucfirst(strftime('%B de %Y', strtotime($rowpostdestaque['data']))); ?> ás <?php echo date('H:i', strtotime($rowpostdestaque['data'])) ?></p> -->
								<!-- <div class="center">
									<a href="<?php echo Config::DIRETORIO_SITE; ?>artigo/<?php echo $rowpostdestaque['id']; ?>/<?php echo caracteres_especiais($rowpostdestaque['titulo']); ?>"> <button class="btn-large btn-destaque">	 Continuar Lendo [...] </button> </a>
								</div> -->
								
							</div>
						
						</aside>
						</a>
						<?php } ?>

						<?php 
					$sqlmaterias = "SELECT * FROM admin, tag_materia, materias WHERE tag_materia.idTag = '$idcategoria' AND tag_materia.idMateria = materias.id AND materias.redator = admin.id AND materias.id <> '$iddestaque' ORDER BY materias.data DESC LIMIT ".$postpaginacount.",".$postpagina."";
					$querymaterias = mysqli_query($conn, $sqlmaterias);
					while($rowmateria = mysqli_fetch_array($querymaterias)){ ?>
						<a href="<?php echo Config::DIRETORIO_SITE; ?>artigo.php?id=<?php echo $rowmateria['id']; ?>&titulo=<?php echo caracteres_especiais($rowmateria['titulo']); ?>">
						<aside>
							<div class="col m4 s12">
								<figure style="padding: 5%;">
									<img class="lazy" data-original="<?php echo Config::DIRETORIO_SITE; ?>admin/images/materias/large/<?php echo $rowmateria['imagem']; ?>" alt="<?php echo Config::TITLE_SITE; ?> - <?php echo $rowmateria['titulo']; ?>">
									<figcaption><?php echo Config::TITLE_SITE; ?> - Leads</figcaption>
								</figure>
							</div>
							<div class="col m8 s12 categories-other">								
								<h2><?php echo $rowmateria['titulo']; ?></h2>
								<small>Por  <?php echo $rowmateria['nome']; ?>  |  <?php echo ucfirst(strftime('%d de', strtotime($rowmateria['data']))); ?>
									<?php echo ucfirst(strftime('%B de %Y', strtotime($rowmateria['data']))); ?> ás <?php echo date('H:i', strtotime($rowmateria['data'])) ?></small>
								<p><?php echo $rowmateria['subtitulo']; ?></p>
							</div>
								<div class="center btnmaterias">
									<a href="<?php echo Config::DIRETORIO_SITE; ?>artigo.php?id=<?php echo $rowmateria['id']; ?>&titulo=<?php echo caracteres_especiais($rowmateria['titulo']); ?>"><button class="btn-large btn-destaque">	 Continuar Lendo [...] </button></a>
								</div>
							<div class="clearfix"></div>
						</aside>
						</a>
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
				<h2>UM DIA EU SEREI UM GRANDE HOKAGE!</h2>
				<h3>Mas é meio complicado ser um Hokage se não estiver por dentro do que acontece no Mundo Ninja! Assine nossa newsletter e fique por dentro das novidades.</h3>
				<fieldset>
					<form action="<?php echo Config::DIRETORIO_SITE; ?>envianewsletter.php" method="post">
						<div class="col l9 m6 s12">
							<input type="email" name="email" required placeholder="Seu e-mail*">
						</div>
						<div class="col l3 m6 s12">
							<button type="submit" class="btn waves-effect">Enviar</button>
						</div>
					</form>
				</fieldset>
			</div>
		</div>
	</article>

	<?php require 'footer.php'; ?>

</section>

<?php require("links.php") ?>
<?php require("scripts.php") ?>

</body>
</html>