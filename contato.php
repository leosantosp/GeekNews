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
	<title><?php echo Config::TITLE_SITE?></title>

</head>
<body>

	<section>
		
		<?php require 'menu.php'; ?>

		<div class="row header" style="background-image: url(<?php echo Config::DIRETORIO_SITE;?>images/contato.jpg);">
			<h1>Fale Conosco</h1>
		</div>

		<div class="row contato" style="">
    <div class="col m6 s12 offset-m3 center">
      <h5 style="margin-top: 40px !important;margin-bottom: 20px !important;">Caso precise de ajuda, pode enviar um e-mail para <?php echo Config::EMAIL_ENVIO; ?> ou preencha o formulário abaixo. Responderemos o mais rápido possível.</h5>
      <form class="col s12" action="<?php echo Config::DIRETORIO_SITE ?>enviamensagem.php" method="POST">
      <div class="row">
        <div class="input-field col s12">
          <input name="name" id="name" type="text" class="validate" required="">
          <label for="name">Nome:</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input name="email" id="email" type="email" class="validate" required="">
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="telefone" id="telefone" type="tel" class="validate" required="">
          <label for="telefone">Telefone:</label>
        </div>
        <div class="input-field col s6">
          <input name="whatsapp" id="whatsapp" type="tel" class="validate" required="">
          <label for="whatsapp">Whatsapp:</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <textarea name="mensagem" id="mensagem" class="materialize-textarea" required ></textarea>
          <label for="mensagem">Mensagem:</label>
        </div>
      </div>
      <button class="btn waves-effect" type="submit" style="margin-bottom: 40px !important;">Enviar</button>
    </form>
    </div>
 </div>


		<div class="row header" style="background-image: url(<?php echo Config::DIRETORIO_SITE;?>images/contato.jpg);">
			<h1></h1>
		</div>

		
			<?php
					$sqloutrosresultados = "SELECT * FROM materias ORDER BY materias.destaque DESC LIMIT 3";
					$queryoutrosresultados = mysqli_query($conn, $sqloutrosresultados);
					$numerooutrosresultados = mysqli_num_rows($queryoutrosresultados);
						?>
						<div class="row recent">
			<?php if($numerooutrosresultados > 0){ ?>
			<h2>Outras Materias com o Resultados de Marketing</h2>
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