<?php require 'load.php'; 
$l = new conexao();
$conn = $l->getconexao();
emulador_de_get();

if(isset($_GET['b'])){
	$busca = addslashes(urldecode($_GET['b']));
	
}else{
	$busca = "Marketing";}

	$sqlbusca = "SELECT * FROM admin, tags, tag_materia, materias WHERE (tags.id = tag_materia.idTag AND materias.id = tag_materia.idMateria) AND materias.titulo LIKE '%$busca%' OR  materias.descricao LIKE '%$busca%' OR  materias.titulo LIKE '%$busca%' OR  materias.titulo LIKE '%$busca%' OR admin.nome LIKE '%$busca%' OR admin.cargo LIKE '%$busca%'";
	$querybusca = mysqli_query($conn, $sqlbusca);
	$rowbusca = mysqli_fetch_array($querybusca);
	$numerobusca = mysqli_num_rows($querybusca);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<link rel="icon" href="<?php echo Config::DIRETORIO_SITE; ?>images/icon.png" type="image/gif" sizes="16x16">
	<title><?php echo Config::TITLE_SITE?></title>

</head>
<body>

	<section>
		
		<?php require 'menu.php'; ?>
		<?php require 'header.php'; ?>

		<article>
			<div class="row index" id="top">
				<h1 style="margin: 0; padding: 2%;">Buscando por: <strong style="color:#DC143C;"><?php echo $busca; ?></strong></h1>
				<!-- <ul class="col s12 botoes center">
					<?php 
					$sqlcategorias = "SELECT * FROM tag_menu, tags WHERE (tags.id = tag_menu.idTag) AND tags.nome LIKE '%$busca%' ORDER BY tags.nome  ASC LIMIT 8";
					$querycategorias = mysqli_query($conn, $sqlcategorias);

					while($rowcategoria = mysqli_fetch_array($querycategorias)){ ?>
					<li><a href="<?php echo Config::DIRETORIO_SITE; ?>categoria.php?id=<?php echo $rowcategoria['id']; ?>&titulo=<?php echo caracteres_especiais($rowcategoria['nome']); ?>"><?php echo $rowcategoria['nome'] ?></a></li>
					<?php
					}
					 ?>
				</ul> -->

				<div class="pag paginacao col s12 l9">

					<?php
					if($numerobusca == 0){
					$sqloutrosresultados = "SELECT * FROM materias ORDER BY materias.destaque DESC LIMIT 3";
					$queryoutrosresultados = mysqli_query($conn, $sqloutrosresultados);
						?>
					<center><h2>Nenhuma postagem foi encontrada</h2></center>
						<div class="row recent">
			<h2>Outras Matérias</h2>
			<?php while($rowoutrosresultado = mysqli_fetch_array($queryoutrosresultados)){ ?>
			<a href="<?php echo Config::DIRETORIO_SITE;?>artigo.php?id=<?php echo $rowoutrosresultado['id'];?>&titulo=<?php echo caracteres_especiais($rowoutrosresultado['titulo']);?>">
				<div class="col m4 s12">
					<img src="<?php echo Config::DIRETORIO_SITE; ?>admin/images/materias/thumbnail/<?php echo $rowoutrosresultado['imagem']; ?>">
					<h3><?php echo $rowoutrosresultado['titulo'];?></h3>
				</div>
			</a><?php } ?>


		</div>
						<?php
					}
					?>

					<!-- Paginação PHP -->
					<?php
					$postpagina = 5; 
					$sqlcontagempaginacao = "SELECT * FROM admin, tags, tag_materia, materias WHERE (tags.id = tag_materia.idTag AND materias.id = tag_materia.idMateria) AND materias.titulo LIKE '%$busca%' OR  materias.descricao LIKE '%$busca%' OR  materias.titulo LIKE '%$busca%' OR  materias.titulo LIKE '%$busca%' OR admin.nome LIKE '%$busca%' OR admin.cargo LIKE '%$busca%' GROUP BY materias.id";
					$querycontagempaginacao = mysqli_query($conn, $sqlcontagempaginacao);
					$numpaginas = ceil($numpaginas = mysqli_num_rows($querycontagempaginacao)/$postpagina);

					$count = 0; $postpaginacount=0;
					while($count < $numpaginas){
						?>
					<div class="page" >

						<?php 
					$sqlpostdestaque = "SELECT * FROM admin, tags, tag_materia, materias WHERE (tags.id = tag_materia.idTag AND materias.id = tag_materia.idMateria) AND materias.titulo LIKE '%$busca%' OR  materias.descricao LIKE '%$busca%' OR  materias.titulo LIKE '%$busca%' OR  materias.titulo LIKE '%$busca%' OR admin.nome LIKE '%$busca%' OR admin.cargo LIKE '%$busca%' GROUP BY materias.id ORDER BY materias.data DESC LIMIT ".$count.",1";
					$querypostdestaque = mysqli_query($conn, $sqlpostdestaque);
					while($rowpostdestaque = mysqli_fetch_array($querypostdestaque)){
						$iddestaque = $rowpostdestaque['id'];
						?>
						<a href="<?php echo Config::DIRETORIO_SITE; ?>artigo.php?id=<?php echo $rowpostdestaque['id']; ?>&titulo=<?php echo caracteres_especiais($rowpostdestaque['titulo']); ?>">
						<aside>
							<div class="destaque">
								<figure>
									<img class="lazy" data-original="<?php echo Config::DIRETORIO_SITE; ?>admin/images/materias/large/<?php echo $rowpostdestaque['imagem']; ?>" alt="<?php echo Config::TITLE_SITE; ?> - SEO">
									<figcaption><?php echo Config::TITLE_SITE; ?> - <?php echo $rowpostdestaque['titulo']; ?></figcaption>
								</figure>
								<h2><?php echo $rowpostdestaque['titulo']; ?></h2>
								<p><?php echo $rowpostdestaque['subtitulo']; ?></p>
								<small>Por  <?php echo $rowpostdestaque['nome']; ?>  |  <?php echo ucfirst(strftime('%d de', strtotime($rowpostdestaque['data']))); ?>
									<?php echo ucfirst(strftime('%B de %Y', strtotime($rowpostdestaque['data']))); ?> ás <?php echo date('H:i', strtotime($rowpostdestaque['data'])) ?></small>
								<div class="center">
									<a href="<?php echo Config::DIRETORIO_SITE; ?>artigo.php?id=<?php echo $rowpostdestaque['id']; ?>&titulo=<?php echo caracteres_especiais($rowpostdestaque['titulo']); ?>"><button class="btn-large btn-destaque">	 Continuar Lendo [...] </button></a>
								</div>
								<hr>
							</div>
						</aside>
						</a>
						<?php } ?>

						<?php 
					$sqlmaterias = "SELECT * FROM tags, admin, tag_materia, materias WHERE (tags.id = tag_materia.idTag AND materias.id = tag_materia.idMateria) AND materias.titulo LIKE '%$busca%' OR  materias.descricao LIKE '%$busca%' OR  materias.titulo LIKE '%$busca%' OR  materias.titulo LIKE '%$busca%' OR admin.nome LIKE '%$busca%' OR admin.cargo LIKE '%$busca%' AND tag_materia.idTag = tags.id AND tag_materia.idMateria = materias.id AND materias.redator = admin.id AND materias.id <> '$iddestaque' GROUP BY materias.id ORDER BY materias.data DESC LIMIT ".$postpaginacount.",".$postpagina."";
					$querymaterias = mysqli_query($conn, $sqlmaterias);
					while($rowmateria = mysqli_fetch_array($querymaterias)){ ?>
						<a href="<?php echo Config::DIRETORIO_SITE; ?>artigo.php?id=<?php echo $rowmateria['id']; ?>&titulo=<?php echo caracteres_especiais($rowmateria['titulo']); ?>">
						<aside>
							<div class="col m4 s12">
								<figure>
									<img class="lazy" data-original="<?php echo Config::DIRETORIO_SITE; ?>admin/images/materias/large/<?php echo $rowmateria['imagem']; ?>" alt="<?php echo Config::TITLE_SITE; ?> - <?php echo $rowmateria['titulo']; ?>">
									<figcaption><?php echo Config::TITLE_SITE; ?> - Leads</figcaption>
								</figure>
							</div>
							<div class="col m8 s12  categories-other">								
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
				<h2>QUE PAPO É ESSE WILLIS?</h2>
				<h3>Eu ia esqueci de pedir pra você assinar a newsletter, mas é que me escapuliu! Antes que o chefe chegue e me dê um piripaque, assina logo, anda diz que sim vai, só uma vez, anda vai, SIIIIIIIIIIM!</h3>
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