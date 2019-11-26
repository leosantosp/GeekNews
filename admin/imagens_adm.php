<?php
date_default_timezone_set("Brazil/East");
require 'class/conexao.php';
require 'class/Simple_Mysql.php';


$l = new conexao();
$l->manter();
$conn = $l->getconexao();

$itens= filter_input(INPUT_GET, 'itens', FILTER_SANITIZE_NUMBER_INT);
$itens = ($itens=='')? 0 : $itens;

$items_por_pagina = 12;

$simples = new Simple_Mysql();
$simples->table = array('imagens');
$simples->column = array('*');

$simples->select();
$querys = $simples->execute();
$paginacao  = mysqli_num_rows($querys);

$simples->limit = $items_por_pagina;
$simples->offset = $itens;
$simples->select();
$querys = $simples->execute();


$paginacao_numeros="";

if($paginacao>$items_por_pagina){

  $paginacao_numeros .= "<div class='col-xs-12 text-center id='to'>";
  $paginas = ceil($paginacao/$items_por_pagina);

  $count = 0;

  for ($i=0; $i < ($paginas*$items_por_pagina); $i=$i+$items_por_pagina) { 
    $string ="itens=".$i."#painel-parceiro";
    $count++;
    $primeiro =   $itens - $items_por_pagina;
    $pontos = $itens  + $items_por_pagina;  

    if($i <= $pontos &&  $i >= $primeiro) 
    {
      if($i==$primeiro)
      {
        $paginacao_numeros .= "<a class='btn btn-default' style='background-color:#FFFFFF;color:#999999;border:1px solid #999999;border-radius:0px' href='?$string' ><span class='glyphicon glyphicon-menu-left'></span></a>";
      }
      elseif($i==$pontos)
      {
        $paginacao_numeros .=  "<a class='btn btn-default ' style='background-color:#FFFFFF;color:#999999;border:1px solid #999999;border-radius:0px' href='?$string' ><span class='glyphicon glyphicon-menu-right'></span></a>";
      }
      else
      {     
        $paginacao_numeros .=  "<a class='btn btn-default' style='background-color:#FFFFFF;color:#999999;border:1px solid #999999;border-radius:0px' href='?$string' >$count</a>";
      }

    }

  }

  $paginacao_numeros .=  " <div class='btn' style='background-color:#FFFFFF;color:#999999;border:1px solid #999999;border-radius:0px' > de $paginas</div>";

  $paginacao_numeros .=  "</div>";
}

?>
<!DOCTYPE html>
<html lang="pt-Br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Painel</title>

  <script src="ckeditor/ckeditor.js"></script>
  <script src="js/tag.js"></script>
  <?php require 'links_header.php'; ?>


</head>

<body>



  <div id="wrapper">

    <!-- Navigation -->

    <?php require 'menu.php'; ?>

    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            Banco de Imagens
          </h1>

        </div>

        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <div class="row">


        <section class="container-fluid">
          <section class="row">
            <div class="clearfix"></div>
            <div class='col-xs-12'>

              <form action="imagens_control.php" method="post" enctype='multipart/form-data'>
                <input type="hidden" name="id" value='<?php echo $id_adm ?>'/>
                <input type="hidden" name="acao" value='inseririmagem' />
                <div class="col-xs-12 ">
                  <label>Imagem</label>
                  <input type="file" name="imagem" class="form-control" required/>
                </div>
                <div class="col-sm-4 col-sm-offset-4 brm text-left">
                  <div class="col-xs-12 br">
                    <button class="form-control btn btn-success">Gravar</button>
                  </div>
                </div>
              </form>
            </div>

            <?php while ($imagens = mysqli_fetch_array($querys)): ?>  
              <div class='col-xs-12' style="margin-top:20px;">
                <form class='row' action="produto_control.php" method="post" enctype='multipart/form-data'>
                  <input type="hidden" name="acao" value='alterarimagem' />
                  <input type="hidden" name="id" value='<?php echo $imagens['id'] ?>' />

                  <div class="col-xs-12 col-sm-6 col-md-4 br">
                    <?php
                    echo (isset($imagens['imagem']) && $imagens['imagem'] != '') ?
                    '<img class="img-responsive img-responsive img-center" src="images/'.$imagens['imagem'] . '"/>':'';
                    ?>
                  </div>

                  <div class="col-md-8 col-sm-6 col-xs-12  text-left">
                    <div class=" br">
                      <label>Endereço / URL  da Imagem:</label>
                      <div class="clearfix"></div>
                      <?php echo curPageURL(1). Config::DIRETORIO_SITE.'admin/images/'.$imagens['imagem'];?>
                    </div>
                  </div>

                  <div class="col-md-8 col-sm-6 col-xs-12 ">
                    <div class=" br text-right">
                      <a href='imagens_control.php?acao=excluirimagem&id=<?php echo $imagens['id']; ?>&imagem=<?php echo $imagens['imagem']; ?>' class=" btn btn-danger link_confirm ">Excluir</a>
                    </div>
                  </div>


                </form>
              </div>
              <div class="col-xs-12"><hr/></div>
              
              <div class="clearfix"></div>
            <?php endwhile; 
            echo $paginacao_numeros;
            ?>

          </section>
        </section>
      </div>


    </div>
    <!-- /.row -->
  </div>
  <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php
require 'scripts_footer.php';
?>

<script>
  $(".valor").maskMoney({thousands: '', decimal: ',', allowZero: true, suffix: '', prefix: 'R$ ', affixesStay: false});

</script>

<style> .ui-datepicker-div{ z-index: 9999999; } </style>
<script src="../js/bootstrap.min.js"></script>

</body>

</html>
