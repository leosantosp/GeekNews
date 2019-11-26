<?php

require 'class/conexao.php';
require 'class/Simple_Mysql.php';

$l = new conexao();
$l->manter();
$conn = $l->getconexao();

$tagRaw = filter_input(INPUT_GET, 'tags', FILTER_SANITIZE_STRING);
$tags = explode('|', $tagRaw);
$tagsFiltre = filter_var_array($tags, FILTER_SANITIZE_NUMBER_INT);

$tagsSelec = '';
$tagsSelecCollec = array();

$sqlTag = "SELECT tags.* FROM  tags ";
$queryTag = mysqli_query($conn, $sqlTag);
while ($rowTag = mysqli_fetch_array($queryTag)){ $tagAll[$rowTag['id']] = $rowTag; }


$sqlIdTag = 'WHERE ';
$countFilter = 0;
$countAll = count($tagsFiltre);
foreach ($tagsFiltre as $key => $value) {
  if($value !=''){
    $sqlIdTag .= "tag_materia.idTag = '$value'";
    $countFilter++;
    $sqlIdTag .= ($countAll > $countFilter)?' OR ':'';
    $tagsSelecCollec[] = $tagAll[$value]['nome'] ;
  }
}


$tagsSelec = implode(', ', $tagsSelecCollec);
$tagsSelec .= (count($tagsSelecCollec)!=0)?'.':'Nenhuma.';


if (isset($_GET['to'])) { $to = filter_var($_GET['to'], FILTER_VALIDATE_INT); } else { $to = 0; }
if($countFilter==''){ $sqlIdTag.= "tag_materia.id is null ";}


$items_por_pagina = 6;

$sqlTag = "SELECT materias.*, tag_materia.id AS tagId FROM materias LEFT JOIN tag_materia ON materias.id = tag_materia.idMateria $sqlIdTag GROUP BY materias.id DESC";
$queryS = mysqli_query($conn,$sqlTag);
$paginacao = mysqli_num_rows($queryS);

$sqlTag = "SELECT materias.*, tag_materia.id AS tagId FROM materias LEFT JOIN tag_materia ON materias.id = tag_materia.idMateria $sqlIdTag GROUP BY materias.id DESC LIMIT $items_por_pagina OFFSET $to";
$query = mysqli_query($conn,$sqlTag);


$paginacao_numeros = '';
if ($paginacao > $items_por_pagina) {
  $paginacao_numeros .= "<div class='col-xs-12 text-center br-bottom' style='margin-bottom:10px;' id='to'>";
  $paginas = ceil($paginacao / $items_por_pagina);
  $count = 0;
  for ($i = 0; $i < ($paginas * $items_por_pagina); $i = $i + $items_por_pagina) {
    $string ="?to=".$i."&tags=".$tagRaw. "#top";
    $count++;
    $primeiro = $to - $items_por_pagina;
    $pontos = $to + $items_por_pagina;
    if ($i <= $pontos && $i >= $primeiro) { /*exibe o número atual o próximo e o anterior*/
      if ($i == $primeiro) {
        $paginacao_numeros .= "<a class='btn btn-default' style='border-radius:0px' href='$string' ><span class='glyphicon glyphicon-menu-left'></span></a>";
      } elseif ($i == $pontos) {
        $paginacao_numeros .= "<a class='btn btn-default ' style='border-radius:0px' href='$string' ><span class='glyphicon glyphicon-menu-right'></span></a>";
      } else {
        $paginacao_numeros .= "<a class='btn btn-default' style='border-radius:0px' href='$string' >$count</a>";
      }
    }
  }
  $paginacao_numeros .= " <div class='btn' style='background-color:#FFFFFF;color:#999999;border:1px solid #999999;border-radius:0px' > de $paginas</div>";
  $paginacao_numeros .= "</div>";
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

  <?php require 'links_header.php';?>


</head>

<body>



 <div id="wrapper">

  <!-- Navigation -->

  <?php require 'menu.php';?>

  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12 br text-right">
        <a class="btn btn-warning" href="materia_busca_tag.php">
          <span class="glyphicon glyphicon-arrow-left"></span>
          Voltar
        </a>
      </div>
      <div class="col-lg-12">
        <h2 style="font-size: 2.8rem">Tag: 
        <span style="font-size:80%;">
            <?php echo $tagsSelec;?>
          </span>
        </h2>
      </div>
      <div class='clearfix br br-bottom'></div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <section class="container-fluid">
      <section class="row">

        <?php 


        while ($row = mysqli_fetch_array($query)){?>

        <div class="col-sm-12 col-xs-12">
          <div class="row">
            <div class="col-xs-12">
            <p><label>Título: </label> <?php echo (isset($row['titulo']))?$row['titulo']:'';?></p>
            <p><label>Destacado: </label> <?php echo ($row['destaque'])?'SIM':'NÃO';?></p>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-xs-12">
        <a class='btn btn-success pull-right' href='materia_adm_tag.php?id=<?php echo $row['id']?>'> Ver/Alterar</a>
        <a class='btn btn-danger pull-left link_confirm' href='materia_control.php?id=<?php echo $row['id']?>&acao=excluir'> Excluir</a>

      </div>

      <div class="clearfix"></div>
      <hr/>
      <?php } ?>
      <?php echo $paginacao_numeros ?>
      <?php if($paginacao==0){ ?>

      <h3 class="text-center">Não há produtos.</h3>

      <?php } ?>

    </section>
  </section>


</div>
<!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php 
require 'scripts_footer.php';
?>
<script src="../js/bootstrap.min.js"></script>
</body>

</html>
