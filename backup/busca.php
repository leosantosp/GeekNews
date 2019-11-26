<?php
include_once 'class/config.php';
include_once 'class/loader.php';
$loader = new loader();
$l = new conexao();

$carrinho = new carrinho();
$carrinho->teste();
$lib = new lib();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="images/favicon.ico">

    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    $busca = filter_input(INPUT_GET, 'busca');
    $item = filter_input(INPUT_GET, 'item');

        
    ?>
    
	<title>Busca: <?php  echo $busca; ?> :: Muzzi</title>
	
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/estilo.css" rel="stylesheet">
    <script src="js/jquery-1.11.2.min.js"></script>	
    <script src="js/jquery.elevatezoom.js" type="text/javascript"></script>
    
	<link href='https://fonts.googleapis.com/css?family=Crimson+Text:400,700italic' rel='stylesheet' type='text/css'>


        
</head>

<body>
<?php
	require 'header.php';
	require 'menu.php';

?>
  <?php 
$images_nome = array('imagem1','imagem2','imagem3','imagem4');

foreach ($images_nome as $value):
    if($prod_row[$value]!=''):
        $images[] = $prod_row[$value];  
    endif;
endforeach;

 $image_num = count($images);

$ima='';
$dir =  config::dir_img_prod_thumb;


?>
<main>

<aside class="container-fluid">
	<div class="row">

            	<div class="col-xs-12 promocoes">
		<div class="row">
                    <div class="text-center br"></div>
		</div>
	</div>	

		
            <div class="clearfix" id='produto'></div>
            <div class=' col-xs-12 col-lg-3 col-md-3 col-sm-3 br'>
                <div class='row'>
            <?php
                require_once 'menu-lateral.php';
            ?>
                </div>
            </div>
            
            <div class=' col-xs-12 col-lg-9 col-md-9 col-sm-9'>
                <h1 class="categoria text-center"><?php  echo $prod_nome_cat; ?></h1>
                <div class='row'>
                    
                    <?php 
$produto_inst = new produto();
$produto_query = $produto_inst->busca($busca,0,36);

if(mysql_num_rows($produto_query)==0):
    echo "<h1 class='categoria text-center'>Não há produtos para essa busca.</h1>";
else:
    echo "<h1 class='categoria text-center'>Resultados para <u>$busca</u></h1>";
endif;
                while($produto_row = mysql_fetch_array($produto_query))
          {
                   $produto_id = $produto_row['id'];
                   $produto_nome = $produto_row['nome'];
                   $produto_imagem = $produto_row['imagem1'];
                   $produto_preco = number_format($produto_row['preco'], 2, ',', '.');
?>
            
		<div class="col-xs-12 col-lg-4 col-md-4 col-sm-4  br-bottom" style="min-height: 320px">
			<div class="col-xs-12 ">
				<div class="row">
					<figure class="col-xs-12 borda br br-bottom" style="min-height: 320px">
						<img src="admin/images/produtos/<?= $produto_imagem?>" class="img-responsive img-center image-height-p" width="150px" alt=""/>
						<figcaption class="product">

<?= $produto_nome?>
							<br/>
							
							<br/>
							<span class="col-xs-12 col-lg-6">
								<div class="row">
									R$ <?= $produto_preco?>
								</div>
							</span> 
								<a href="detalhes.php?id=<?= $produto_id?>" class="col-xs-12 col-lg-6 text-right meio-br">
									+ Detalhes
								</a>
						</figcaption>
					</figure>
				</div>
			</div>
		</div>
<?php 
          }
?>
                    
                </div>
            </div>
		
		<div class="clearfix br"></div>
		<?php
    require 'lancamento.php';
    ?>
		
	
	</div>
</aside>
<aside class="container-fluid busca br br-bottom">
	<div class="row">
		<h5 class="col-xs-12 col-lg-6 col-md-6 col-sm-6 text-center">
		</h5>
			
	</div>
</aside>
</main>

<?php
	require('footer.php');
?>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.elevatezoom.config.js"></script>
<script>
    
$('#tamanhoid').on('change',function(e){
var valores = $('#formcompra').serialize();
    $.ajax({
        url : 'tamanhocorproduto.php',
        type: 'get',
        dataType : 'html',
        data: valores,
        success : function(retorno){
            $('#corid').html(retorno);
        } 
    });
});
$('#itemQuantitinput').change(function(s){
var valores = $('#itemQuantitinput').val();
var itemQuantitinput = $('#itemQuantit').val(valores);
});


function passavalor(vale){
 alert('ddd');
corx.testo = vale.value;   
 alert(corx.testo);
}
document.getElementById("formcompra").addEventListener("submit", function(event){
    event.preventDefault();
    
    var cor = corx.testo;
var tamanho = $('#tamanhoid').val();
if(tamanho===undefined){
    tamanho ='';
}
if(cor===undefined){
    cor ='';
}
var nome = $('#nomeid').val();

$('#itemDescriptio').val(nome +" - "+tamanho+" - "+cor);
document.getElementById("formcompra").submit();
});
</script>
</body>
</html>