<?php require 'load.php'; 
$l = new conexao();
$conn = $l->getconexao();
emulador_de_get();

if(isset($_GET['id'])){
	$idmateria = $_GET['id'];
	$sqlmateria = "SELECT * FROM tags, tag_materia, admin, materias WHERE materias.id = '$idmateria' AND tag_materia.idMateria = materias.id AND tags.id = tag_materia.idTag AND admin.id = materias.redator";
	$querymateria = mysqli_query($conn, $sqlmateria);
	$rowmateria = mysqli_fetch_array($querymateria);
	$numeromateria = mysqli_num_rows($querymateria);
}
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

		<div class="row header" style="background-image: url(<?php echo Config::DIRETORIO_SITE;?>admin/images/materias/medium/<?php echo $rowmateria['imagem'];?>); background-position: center;
    height: 350px;
    display: flex;
    align-items: flex-end;">
			<h1><?php echo $rowmateria['titulo'];?></h1>
		</div>

		<div class="row cabeçalho">
			<div class="col l8 offset-l2 s12">
				<div class="col m8 s12">
					<img style="margin-right: 10px;" src="<?php echo Config::DIRETORIO_SITE; ?>admin/images/redatores/<?php echo $rowmateria['foto'];?>">
					<h2>Por <?php echo $rowmateria['nome'];?></h2>
					<h2><?php echo $rowmateria['cargo'];?></h2>
					<h2>Publicado em <?php echo ucfirst(strftime('%d de', strtotime($rowmateria['data']))); ?> <?php echo ucfirst(strftime('%B de %Y', strtotime($rowmateria['data']))); ?>  ás <?php echo date('H:i', strtotime($rowmateria['data'])); ?> 
					<?php 
					if(isset($rowmateria['atualizadodata']) && $rowmateria['atualizadodata'] > $rowmateria['data']){?>
					| Atualizado em <?php echo ucfirst(strftime('%d de', strtotime($rowmateria['atualizadodata']))); ?> <?php echo ucfirst(strftime('%B de %Y', strtotime($rowmateria['atualizadodata']))); ?>  ás <?php echo date('H:i', strtotime($rowmateria['atualizadodata'])); ?>
					<?php } ?>	
					</h2>
				</div>
			</div>
		</div>

		<div class="row artigo">
			<div class="col l8 offset-l2 s12">
				<?php echo $rowmateria['descricao'];?>
			</div>
		</div>

		<div class="row">
 <div class="container">
   <div id="fb-root"></div>
   <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10&appId=1421023797978856";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
  <div class="fb-comments" data-href="https://developers.facebook.com/sites.mazukim.<?php echo $rowmateria['id']; ?>" data-width="100%" data-numposts="5"></div>
</div>
</div>

		
			<?php
				$idtag = $rowmateria['idTag'];
				$idmateria = $rowmateria['id'];
					$sqloutrosresultados = "SELECT * FROM tag_materia, materias WHERE tag_materia.idTag = '$idtag' AND materias.id = tag_materia.idMateria AND materias.id <> '$idmateria' ORDER BY materias.destaque DESC LIMIT 3";
					$queryoutrosresultados = mysqli_query($conn, $sqloutrosresultados);
					$numerooutrosresultados = mysqli_num_rows($queryoutrosresultados);
						?>
						<div class="row recent">
			<?php if($numerooutrosresultados > 0){ ?>
			<h2>Outras Matérias</h2>
			<?php while($rowoutrosresultado = mysqli_fetch_array($queryoutrosresultados)){ ?>
			<a href="<?php echo Config::DIRETORIO_SITE;?>artigo.php?id=<?php echo $rowoutrosresultado['id'];?>&titulo=<?php echo caracteres_especiais($rowoutrosresultado['titulo']);?>">
				<div class="col m4 s12">
					<img src="<?php echo Config::DIRETORIO_SITE; ?>admin/images/materias/thumbnail/<?php echo $rowoutrosresultado['imagem']; ?>">
					<h3><?php echo $rowoutrosresultado['titulo']; ?></h3>
				</div>
			</a>
			<?php }} ?>

		</div>


		<?php require 'footer.php'; ?>

	</section>

	<?php require("links.php"); ?>
	<?php require("scripts.php"); ?>

</body>
</html>