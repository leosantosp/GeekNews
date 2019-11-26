<?php
;
require 'class/conexao.php';
require_once 'class/Simple_Mysql.php';

$l = new conexao();
$l->manter();
$conn = $l->getconexao();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Painel</title>

<?php require 'links_header.php';?>

<script>
function ConfirmaExclusao(id) {
  if( confirm( 'Tem certeza que deseja excluir esta imagem?' ) ) {
  location="class/control_estrutura.php?var="+id+"&control=delete";

}
};

</script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->

<?php require 'menu.php';?>

        <div id="page-wrapper">
            <div class="row">
            <h2 style="text-align: center; font-weight: bold;">BEM-VINDO!</h2>
			<h3 style="text-align: center;">VOCÊ ESTÁ NA ÁREA ADMINISTRATIVA DE <b> GEEK NEWS </b> </h3>
			<h5 style="text-align: center; font-weight: bold;"> <<- Acesse as opções no menu lateral e comece a editar o blog.</h5>

            </div>
            <!-- /.row -->
            <div class="row">
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

</body>

</html>
