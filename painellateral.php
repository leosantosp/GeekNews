				<div class="col l3 s12 center score-table">
				<table>
					<h3>SNAKE GAME SCORE</h3>
					<hr>
                  <thead>
                       <tr>
                         <th>Nickname</th>
                         <th>Score</th>
                     </tr>
                   </thead>
           
                   <tbody>
                     <tr>
                       <td> <img width="20px" height="20px" src="images/crown.svg" alt=""> Leonardo</td>
                       <td>950pts</td>
                     </tr>
					 
					 <tr>
                       <td>Alan</td>
                       <td>750pts</td>
					 </tr>
					 
                     <tr>
                       <td>Matheus</td>
                      <td>650pts</td>
					 </tr>

					 <tr>
                       <td>Leonardo</td>
                       <td>750pts</td>
					 </tr>
					 
                     <tr>
                       <td>Matheus</td>
                      <td>650pts</td>
					 </tr>
					 
					 <tr>
                       <td>Alan</td>
                       <td>750pts</td>
					 </tr>
					 
                     <tr>
                       <td>Leonardo</td>
                      <td>650pts</td>
					 </tr>
					 
					 <tr>
                       <td>Alan</td>
                       <td>750pts</td>
					 </tr>
					 
                     <tr>
                       <td>Matheus</td>
                      <td>650pts</td>
					 </tr>
					 
					 <tr>
                       <td>Leonardo</td>
                       <td>750pts</td>
					 </tr>
					 

                   </tbody>
                 </table>
            
			    </div>
				<div class="col l3 s12 center cursos">


					<h2>VEJA TAMBÉM</h2>

					<?php 
					$sqlbannerlateral = "SELECT * FROM banner LIMIT 5";
					$querybannerlateral = mysqli_query($conn, $sqlbannerlateral);
					while($rowbannerlateral = mysqli_fetch_array($querybannerlateral)){
						?>
					<div class="col l12 m6 s12">
				<a href="<?php echo $rowbannerlateral['link']; ?>">
						
						<!-- <p>Aprenda todas as Ferramentas do Photoshop e seja um profissional da área Criativa.</p> -->
						<figure>
							<img  src="<?php echo Config::DIRETORIO_SITE; ?>admin/images/banner/<?php echo $rowbannerlateral['imagem']; ?>" alt="<?php echo Config::TITLE_SITE; ?> - Photoshop">
							<figcaption><?php echo Config::TITLE_SITE; ?> - <?php echo $rowbannerlateral['titulo']; ?></figcaption>
						</figure>
						<h3><?php echo $rowbannerlateral['titulo']; ?></h3>

						<hr style="border: 1px solid #DC143C; width: 120px;">
				</a>
					</div>
					<?php } ?>
					<div class="clearfix"></div>
					<h3>Veja Todas as Nossas Notícias Diariamente</h3>
					<p>Preparamos os melhores conteúdos pensando em você e deixando atualizado sobre o Mundo Geek.</p>
					<a href="<?php echo Config::DIRETORIO_SITE; ?>index.php/" class="btn waves-effect">Confira</a>
				</div>