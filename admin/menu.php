<?php require '../class/Config.php';

if(!class_exists('conexao')):
	require 'class/conexao.php';
endif;
if(!class_exists('Simple_Mysql')):
	require 'class/Simple_Mysql.php';
endif;

$loginusuario = $_SESSION['user'];
$simplepermissao = new Simple_Mysql();
$querypermissao = $simplepermissao->execute("SELECT * FROM admin WHERE admin.login = '$loginusuario' LIMIT 1");

$rowpermissao = mysqli_fetch_assoc($querypermissao);
$permissao = $rowpermissao['permissao'];

?>

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Navegação</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="">
			Panel v1.0
		</a>
	</div>
	<!-- /.navbar-header -->

	<ul class="nav navbar-top-links navbar-right">

		<!-- /.dropdown -->
	</ul>
	<!-- /.navbar-top-links -->

	<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav navbar-collapse">

			<ul class="nav" id="side-menu">
				<li>
					<a href="painel.php">
						<i class="fa fa-desktop fa-fw "></i> 
						Home
					</a>
				</li>	
				<?php if($permissao == 1){?>
				<!-- <li>
					<a href="#"><i class="glyphicon glyphicon-home"></i> Banner<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="banner_fixo.php">Banner Fixo</a>
						</li>
				</ul>
			</li> -->

			<li>
					<a href="#"><i class="glyphicon glyphicon-user"></i> Redatores<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="redator_adm.php">Adicionar Redator</a>
						</li>
						<li>
							<a href="redator_todos.php">Ver Redatores</a>
						</li>
					</ul>

			</li>
<!--
			<li>
				<a href="#">
					<i class="fa fa-list-alt"></i>
					Configurações
					<span class="fa arrow"></span>
				</a>
				<ul class="nav nav-second-level">
					<li>
						<a href="tags_adm_menu.php">
							Cadastrar Tag no Menu
						</a>
					</li>
					<li>
						<a href="config_value_adm.php">
							Configurações
						</a>
					</li>

				</ul>
			</li>
-->
<!-- 			<li>
				<a href="#"><i class="glyphicon glyphicon-thumbs-up"></i>
					Gerenciar
					<span class="fa arrow"></span>
				</a>
				<ul class="nav nav-second-level">
					<?php 
					$simpleEst =  new Simple_Mysql();
					$simpleEst->table = array('estatico');
					$simpleEst->column =array('*');
					$simpleEst->select();
					$queryEst = $simpleEst->execute();
					while($rowEst = mysqli_fetch_array($queryEst)){?>
					<li>
						<a href="estatico_adm.php?chave=<?php echo $rowEst['chave'] ; ?>"><?php echo $rowEst['nome'] ; ?></a>
					</li>
					<?php } ?>
				</ul>
			</li> -->
			<li>
				<a href="#"><i class="glyphicon glyphicon-eye-open"></i> Banner Lateral<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="banner_lateral_adm.php">
							Criar Banner Lateral
						</a>
					</li>
					<li>
						<a href="banner_lateral_todos.php">
							Ver Banner Lateral
						</a>
					</li>
				</ul>
			</li>
				<?php }else{ ?>
					<li>
					<a href="#"><i class="glyphicon glyphicon-user"></i> Usuário<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="redator_adm.php?id=<?php echo $rowpermissao['id']; ?>">Alterar Dados</a>
						</li>
					</ul>

			</li>
				<?php } ?>
			<li>
				<a href="#"><i class="fa fa-file-text-o"></i> Post's<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<li>
							<a href="#"><i class="fa fa-tags  "></i> Categorias<span class="fa arrow"></span></a>
							<ul class="nav nav-third-level">
								<li>
									<a href="tags_adm.php">
										Cadastrar Categorias
									</a>
								</li>
								<li>
									<a href="tags_todos.php">
										Ver Categorias
									</a>
								</li>
								<li>
									<a href="tags_adm_menu.php">
										Cadastrar Categorias no Menu
									</a>
								</li>
							</ul>
						</li>
						<!--
						<li>
							<a href="tamanho.php">
								Tamanhos
							</a>
						</li>
					-->
					<li>
						<a href="materia_adm_tag.php">
							Criar Post
						</a>
					</li>
					<li>
						<a href="materia_busca_tag.php">
							Ver Post por Categoria
						</a>
					</li>
					<li>
						<a href="materia_todos.php">
							Busca de Post
						</a>
					</li>
					<!-- <li>
						<a href="imagens_adm.php">
							Banco de Imagens
						</a>
					</li> -->
				</ul>
			</li>
<!--
			<li>
				<a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Cliente<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">

					<li>
						<a href="busca_de_cliente.php">Busca</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Pedidos<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">

					<li>
						<a href="busca_de_pedidos.php">Busca</a>
					</li>
				</ul>
			</li>
			-->
			<li>
				<a href="logout.php">
					<i class="fa fa-sign-out fa-fw">
					</i> 
					Logout
				</a>
			</li>

		</ul>
	</div>
	<!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>