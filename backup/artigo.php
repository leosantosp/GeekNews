<?php
session_start();
require('admin/class/conexao.php');
require('diretorio.php');
$login= new conexao();
$l = new conexao();
$conn = $l->getconexao();
$urlcompleta = $_SERVER['REQUEST_URI'];
$url = explode("/",$_SERVER['REQUEST_URI']);
$id=intval($_GET['id']);
$row=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM estrutura WHERE id = $id"));
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="images/favicon.ico">

    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="fb:app_id" content="1647290502264267" />
	
	<title><?php echo $row['titulo']; ?></title>
	
    <link href="<?php echo $diretorio; ?>css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo $diretorio; ?>css/estilo.css" rel="stylesheet">
    <script src="<?php echo $diretorio; ?>js/jquery-1.11.2.min.js"></script>	
	
	<script src="<?php echo $diretorio; ?>js/jquery.bxslider.min.js"></script>

	<link href="<?php echo $diretorio; ?>js/jquery.bxslider.css" rel="stylesheet" />

	<meta property="og:url"           content="http://www.softhar.com.br/blog/artigo/<?php echo $url[3] ?>/<?php echo $url[4] ?>/"/>
	<meta property="og:type"               content="article" />
	<meta property="og:title"         content="<?php echo $row['titulo']; ?>" />

	<meta property="og:description"   content="<?php echo strip_tags(substr(strip_tags($row['texto']), 0,1500)); ?>" />
	<meta property="og:image"         content="http://www.softhar.com.br/blog/admin/fotos/<?php echo $row['foto']; ?>" />		
	
	<link href='https://fonts.googleapis.com/css?family=Crimson+Text:400,700italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Cantarell:400,400italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Istok+Web:400,400italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,300' rel='stylesheet' type='text/css'>

	<link href="http://www.softhar.com.br/blog/admin/fotos/<?php echo $row['foto']; ?>" rel="image_src" />
	
	
	
<script src="<?php echo $diretorio; ?>js/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="<?php echo $diretorio; ?>js/jquery.bxslider.css" rel="stylesheet" />
<script>
$(document).ready(function(){
	
  $('.bxslider').bxSlider({
  auto: true,
});

});

</script>
	
	<script>
	function bot(){

$('html, body').animate({
     scrollTop: $('#bot').offset().top
     }, 2000);


};

	function top(){

$('html, body').animate({
     scrollTop: $('#top').offset().top
     }, 2000);


};

	</script>
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.6&appId=1647290502264267";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<script>
// Place this code in the head section of your HTML file 
(function(r, d, s) {
	r.loadSkypeWebSdkAsync = r.loadSkypeWebSdkAsync || function(p) {
		var js, sjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(p.id)) { return; }
		js = d.createElement(s);
		js.id = p.id;
		js.src = p.scriptToLoad;
		js.onload = p.callback
		sjs.parentNode.insertBefore(js, sjs);
	};
	var p = {
		scriptToLoad: 'https://swx.cdn.skype.com/shared/v/latest/skypewebsdk.js',
		id: 'skype_web_sdk'
	};
	r.loadSkypeWebSdkAsync(p);
})(window, document, 'script');
</script>


</head>

<body>

<?php
	require 'header.php';

?>

<main>

	<section class="container-fluid">
		<div class="row">
		
	<div class="col-xs-12 col-lg-2 col-md-2 col-sm-2">
		<div class="row">
			<?php
			 require 'menu-vertical.php';
			 $id=intval($_GET['id']);
			?>
		</div>
	</div>
    <div class=' col-xs-12 col-lg-10 col-md-10 col-sm-10 br bg-index br-bottom' style="background-color:#EEEEEE;">

       <div class="col-xs-12 col-lg-8 col-md-9 col-sm-12"> 
	   <div class="row">
	<div class="col-xs-12 destaque" style="">

	<div class="row">
		<?php
					
					$sql =	"SELECT * FROM estrutura WHERE id = $id";
					$query = mysqli_query($conn,$sql);
					$row = mysqli_fetch_assoc($query);
					$sql_cat = "SELECT * FROM estrutura WHERE categoria =".$row['categoria']." ORDER By id DESC LIMIT 4";
					$query_cat = mysqli_query($conn,$sql_cat);
					while($row_cat = mysqli_fetch_assoc($query_cat))
			{
				
 $string = $row['titulo'];
 
$tr = strtr(
 
    $string,
 
    array (
 
      'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
      'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
      'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N',
      'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O',
      'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Ŕ' => 'R',
      'Þ' => 's', 'ß' => 'B', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
      'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
      'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
      'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
      'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y',
      'þ' => 'b', 'ÿ' => 'y', 'ŕ' => 'r', ' ' => '-', '_' => '-', ',' => '',
	  ':' => '', '"' => '', "'" => '', '(' => '',')' => '','!' => '','@' => '',
	  '#' => '','$' => '','%' => '','¨' => '','&' => '','*' => '','?' => '','.' => '','=' => ''
	  )
);
$titulo = strtolower($tr);
		?>
			<div class="col-xs-12 col-lg-3 col-md-3 col-sm-6 ">
				<div class="row"  style="margin-left:-10px;margin-right:-10px;">
				<a href="<?php echo $diretorio; ?>artigo/<?php echo $row_cat['id']; ?>/<?php echo $titulo; ?>" id="top" class="opacity">
					<div class="col-xs-12 destaque-borda " style="height:220px;">

						<article>
							<figure style="background:url('<?php echo $diretorio; ?>admin/fotos/<?php echo $row_cat['foto']; ?>');height:100px;background-repeat:no-repeat;background-size:auto 100%;background-position:center;margin-top:10px;">
							
							</figure>
							<h2>
									<?php
										echo $texto = $row_cat['titulo'];	
									?>		
							</h2>
						</article>
					</div>
				</a>
				</div>
			</div>
		<?php
			}
		?>
	</div>	 
</div>		
</div>	
			   <div class='row'>

                    <?php 
					
					$sql =	"SELECT * FROM estrutura WHERE id = $id";
					$query = mysqli_query($conn,$sql);
					while($row = mysqli_fetch_assoc($query))
					{
					?>
            
				<article class="col-xs-12">

						<div class="artigo text-justify">	

								<div class="col-xs-12 col-lg-1 col-lg-offset-11 col-md-2 col-md-offset-10 col-sm-2 col-sm-offset-10 br">
									<a href="#" class="col-xs-12 br br-bottom"  onclick="bot()">
										<div class="glyphicon glyphicon-arrow-down" style="font-size:20px;"></div>
									</a>
								</div>
								
								<div class="clearfix"></div>
								
								<figure class="col-xs-12">
									<img src="<?php echo $diretorio; ?>admin/fotos/<?php echo $row['foto']; ?>" class="img-responsive"  alt=""/>	
									<figcaption class="text-center" style="background-color:#FFFFFF;">
										<?php echo $row['legenda']; ?>
									</figcaption>
								</figure>
								<div class="col-xs-12 col-lg-12 col-md-12 col-sm-12">
									<h2 class="text-center br-bottom">
										
											<?php 									
											//echo $titulo = $row['titulo']; 				
											?>
										
									</h2>
								</div>
								<div class="text-justify">
									
										<?php
											echo $texto = $row['texto'];	
										?>
								</div>						

								<div class="col-xs-12 text-right br">
									<a href="#" class="col-xs-12 br br-bottom" id="bot" onclick="top()">
										<div class="glyphicon glyphicon-arrow-up" style="font-size:20px;"></div>
									</a>
								</div>
								
						</div>

				</article>
				
		
		<?php
					}
		?>
		<!-- <div class="col-xs-12">
			<form method="post" action="/comentar.php">
				<input type="hidden" name="artigo" value="<?php echo $id; ?>" />
				<input type="hidden" name="tipo" value="0" />
				<div>
					<input type="text" class="form-control" name="nome" placeholder="Deixe o seu nome(Opcional)" />
				</div>
				<textarea name="comentario" class="form-control"  required placeholder="Adicionar um comentário..."></textarea>
					<script type="text/javascript">
						CKEDITOR.replace('comentario');
					</script>
				<button class="btn btn-default col-xs-12">
					Enviar
				</button>
			</form>
		</div>

		<div class="col-xs-12">
			<?php
				$sql = "SELECT * FROM comentarios WHERE artigo = $id AND tipo = 0 AND status = 1";
				$query = mysqli_query($conn,$sql);
				while($row = mysqli_fetch_array($query))
				{
			?>
				<div>
					<div class="form-control">Teste</div>
				</div>
				<div class="">
				Teste
				</div>
			<?php
				}
			?>
		</div> -->
		
<div class="col-xs-12 ">			
<ul class="share-buttons">
  <li class="br">
	<a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.softhar.com.br/blog%2Fartigo%2F%3C%3Fphp%20echo%20%24url%5B2%5D%20%3F%3E%2F%3C%3Fphp%20echo%20%24url%5B3%5D%20%3F%3E&t=" title="Share on Facebook" target="_blank" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&t=' + encodeURIComponent(document.URL)); return false;">
		<img alt="Share on Facebook" src="<?php echo $diretorio; ?>images/social_flat_rounded_rects_svg/Facebook.svg" width="40px">
	</a>
	</li>
  <li><a href="https://twitter.com/intent/tweet?source=http%3A%2F%2Fwww.softhar.com.br/blog%2Fartigo%2F%3C%3Fphp%20echo%20%24url%5B2%5D%20%3F%3E%2F%3C%3Fphp%20echo%20%24url%5B3%5D%20%3F%3E&text=:%20http%3A%2F%2Fwww.softhar.com.br/blog%2Fartigo%2F%3C%3Fphp%20echo%20%24url%5B2%5D%20%3F%3E%2F%3C%3Fphp%20echo%20%24url%5B3%5D%20%3F%3E" target="_blank" title="Tweet" onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ':%20'  + encodeURIComponent(document.URL)); return false;"><img alt="Tweet" src="<?php echo $diretorio; ?>images/social_flat_rounded_rects_svg/Twitter.svg" width="40px"></a></li>
  <li><a href="https://plus.google.com/share?url=http%3A%2F%2Fwww.softhar.com.br/blog%2Fartigo%2F%3C%3Fphp%20echo%20%24url%5B2%5D%20%3F%3E%2F%3C%3Fphp%20echo%20%24url%5B3%5D%20%3F%3E" target="_blank" title="Share on Google+" onclick="window.open('https://plus.google.com/share?url=' + encodeURIComponent(document.URL)); return false;"><img alt="Share on Google+" src="<?php echo $diretorio; ?>images/social_flat_rounded_rects_svg/Google+.svg" width="40px"></a></li>
  <li><a href="http://www.tumblr.com/share?v=3&u=http%3A%2F%2Fwww.softhar.com.br/blog%2Fartigo%2F%3C%3Fphp%20echo%20%24url%5B2%5D%20%3F%3E%2F%3C%3Fphp%20echo%20%24url%5B3%5D%20%3F%3E&t=&s=" target="_blank" title="Post to Tumblr" onclick="window.open('http://www.tumblr.com/share?v=3&u=' + encodeURIComponent(document.URL) + '&t=' +  encodeURIComponent(document.title)); return false;"><img alt="Post to Tumblr" src="<?php echo $diretorio; ?>images/social_flat_rounded_rects_svg/Tumblr.svg" width="40px"></a></li>
  <li><a href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.softhar.com.br/blog%2Fartigo%2F%3C%3Fphp%20echo%20%24url%5B2%5D%20%3F%3E%2F%3C%3Fphp%20echo%20%24url%5B3%5D%20%3F%3E&description=" target="_blank" title="Pin it" onclick="window.open('http://pinterest.com/pin/create/button/?url=' + encodeURIComponent(document.URL) + '&description=' +  encodeURIComponent(document.title)); return false;"><img alt="Pin it" src="<?php echo $diretorio; ?>images/social_flat_rounded_rects_svg/Pinterest.svg" width="40px"></a></li>
  <li><a href="https://getpocket.com/save?url=http%3A%2F%2Fwww.softhar.com.br/blog%2Fartigo%2F%3C%3Fphp%20echo%20%24url%5B2%5D%20%3F%3E%2F%3C%3Fphp%20echo%20%24url%5B3%5D%20%3F%3E&title=" target="_blank" title="Add to Pocket" onclick="window.open('https://getpocket.com/save?url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;"><img alt="Add to Pocket" src="<?php echo $diretorio; ?>images/social_flat_rounded_rects_svg/Pocket.svg" width="40px"></a></li>
  <li><a href="http://www.reddit.com/submit?url=http%3A%2F%2Fwww.softhar.com.br/blog%2Fartigo%2F%3C%3Fphp%20echo%20%24url%5B2%5D%20%3F%3E%2F%3C%3Fphp%20echo%20%24url%5B3%5D%20%3F%3E&title=" target="_blank" title="Submit to Reddit" onclick="window.open('http://www.reddit.com/submit?url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;"><img alt="Submit to Reddit" src="<?php echo $diretorio; ?>images/social_flat_rounded_rects_svg/Reddit.svg" width="40px"></a></li>
  <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=http%3A%2F%2Fwww.softhar.com.br/blog%2Fartigo%2F%3C%3Fphp%20echo%20%24url%5B2%5D%20%3F%3E%2F%3C%3Fphp%20echo%20%24url%5B3%5D%20%3F%3E&title=&summary=&source=http%3A%2F%2Fwww.softhar.com.br/blog%2Fartigo%2F%3C%3Fphp%20echo%20%24url%5B2%5D%20%3F%3E%2F%3C%3Fphp%20echo%20%24url%5B3%5D%20%3F%3E" target="_blank" title="Share on LinkedIn" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;"><img alt="Share on LinkedIn" src="<?php echo $diretorio; ?>images/social_flat_rounded_rects_svg/LinkedIn.svg" width="40px"></a></li>
  <li><a href="http://wordpress.com/press-this.php?u=http%3A%2F%2Fwww.softhar.com.br/blog%2Fartigo%2F%3C%3Fphp%20echo%20%24url%5B2%5D%20%3F%3E%2F%3C%3Fphp%20echo%20%24url%5B3%5D%20%3F%3E&t=&s=" target="_blank" title="Publish on WordPress" onclick="window.open('http://wordpress.com/press-this.php?u=' + encodeURIComponent(document.URL) + '&t=' +  encodeURIComponent(document.title)); return false;"><img alt="Publish on WordPress" src="<?php echo $diretorio; ?>images/social_flat_rounded_rects_svg/Wordpress.svg" width="40px"></a></li>
  <li><a href="https://pinboard.in/popup_login/?url=http%3A%2F%2Fwww.softhar.com.br/blog%2Fartigo%2F%3C%3Fphp%20echo%20%24url%5B2%5D%20%3F%3E%2F%3C%3Fphp%20echo%20%24url%5B3%5D%20%3F%3E&title=&description=" target="_blank" title="Save to Pinboard" onclick="window.open('https://pinboard.in/popup_login/?url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;"><img alt="Save to Pinboard" src="<?php echo $diretorio; ?>images/social_flat_rounded_rects_svg/Pinboard.svg" width="40px"></a></li>
  <li><a href="mailto:?subject=&body=:%20http%3A%2F%2Fwww.softhar.com.br/blog%2Fartigo%2F%3C%3Fphp%20echo%20%24url%5B2%5D%20%3F%3E%2F%3C%3Fphp%20echo%20%24url%5B3%5D%20%3F%3E" target="_blank" title="Send email" onclick="window.open('mailto:?subject=' + encodeURIComponent(document.title) + '&body=' +  encodeURIComponent(document.URL)); return false;"><img alt="Send email" src="<?php echo $diretorio; ?>images/social_flat_rounded_rects_svg/Email.svg" width="40px"></a></li>
  <li><a href="whatsapp://send?text=http://www.softhar.com.br/blog/artigo/<?php echo $url[2] ?>/<?php echo $url[3] ?>" data-action="share/whatsapp/share"><img src="<?php echo $diretorio; ?>images/social_flat_rounded_rects_svg/Whatsapp.svg" width="40px" /></a></li>
  <li>
  <a href="" class='skype-share' data-href='' data-lang='' data-text='' >
	<img src="<?php echo $diretorio; ?>images/social_flat_rounded_rects_svg/Skype.svg" width="40px" />
  </a>
  <div  ></div>
  </li>
  </ul>
  
</div>		
		
        <div class="fb-comments" data-href="http://www.softhar.com.br/blog/artigo/<?php echo $url[2] ?>/<?php echo $url[3] ?>" data-width="100%" data-numposts="30"></div>		
		  	
                </div>
            </div>	
	

				<div class="row">
		<?php
			require 'midias.php';
		?>
				</div>			
		</div>	
		</div>
	</section>

</main>

<?php
	require('footer.php');
?>

    <script src="<?php echo $diretorio; ?>js/bootstrap.min.js"></script>
</body>
</html>