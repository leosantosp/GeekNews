<footer>
	<div class="row footer">
		<div class="col l4 s12">
			<div class="logos">
			<figure>
			  <a href="https://mazukim.com.br">
				<img style="margin-top: -15px;" class="lazy" data-original="<?php echo Config::DIRETORIO_SITE; ?>images/logo.png" alt="<?php echo Config::TITLE_SITE; ?> - Mazukim">
				<figcaption><?php echo Config::TITLE_SITE; ?></figcaption>
			  </a>
			</figure>
			</div>

			<p>O site Geek Notices criado por 8 pessoas, foi desenvolvido com a intenção de te manter atualizado sobre tudo que acontece no mundo Geek, seja relacionado a tecnologia, comics, animes, games e etc.</p>
		</div>


		<div class="col l8 s12 categories">
			<div class="col m5 s12 offset-m1">
				<h2>Categorias</h2>
				<ul>
					<?php 
					$sqlcategorias = "SELECT * FROM tag_menu, tags WHERE tags.id = tag_menu.idTag ORDER BY tags.nome  ASC LIMIT 8";
					$querycategorias = mysqli_query($conn, $sqlcategorias);

					while($rowcategoria = mysqli_fetch_array($querycategorias)){ ?>
					<li><a href="<?php echo Config::DIRETORIO_SITE; ?>categoria.php?id=<?php echo $rowcategoria['id']; ?>&titulo=<?php echo caracteres_especiais($rowcategoria['nome']); ?>"><?php echo $rowcategoria['nome'] ?></a></li>
					<?php
					}
					 ?>
				</ul>
			</div>

			<div class="col m6 s12 follow-us">
				<h2>Redes Sociais</h2>
				<ul>
					<li><a href="#"><img class="social-media-icon" src="images/facebook.svg" alt=""> </a></li>
					<li><a href="#"><img class="social-media-icon" src="images/instagram.svg" alt=""> </a></li>
					<li><a href="#"> <img class="social-media-icon" src="images/twitter.svg" alt=""></a></li>
				</ul>
			</div>

		</div>
		
		
	</div>

	
	
</footer>
<div class="row copyright-row">
	<div class="col s12 copyright">
		  <p>Desenvolvido por <a href="#"><strong>Grupo 08</strong></a></p>
		</div>
	</div>