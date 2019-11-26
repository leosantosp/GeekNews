<?php
;
require 'class/conexao.php';
require 'class/Simple_Mysql.php';
$log = new conexao();
$log->manter();
$l = new conexao();
$l->manter();
$conn = $l->getconexao();
$busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);
$si =  new Simple_Mysql();
$si->table = array('produto_cor_tam');
$si->column =array('*');
$si->select();
$qu = $si->execute();
$produto = array();
 while ($row = mysqli_fetch_array($qu)):
     $produto[] = $row;
 endwhile;
 
 $simple =  new Simple_Mysql();
    $cor = array();
    $simple->sql =  "SELECT * FROM `cor`";
    $query_cor = $simple->execute();
    while ($row_c = mysqli_fetch_array($query_cor)):
        $cor[$row_c['id']]=$row_c['nome'];
    endwhile;
    
    $tamanho = array();
    $simple->sql =  "SELECT * FROM `tamanho`";
    $query_tam = $simple->execute();
    while ($row_t = mysqli_fetch_array($query_tam)):
        $tamanho[$row_t['id']]=$row_t['nome'];
    endwhile;
 
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
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <?php 
                        $exibindo =0 ;
                        if($busca !=''):
                           
                            $simple =  new Simple_Mysql();
                            $simple->table = array('produtos');
                            $simple->column =array('*');
                            $simple->operador='LIKE';
                            $simple->where= array('nome'=>'%'.$busca.'%',
                                'OR',
                                'descricao'=>'%'.$busca.'%',
                                );
                            $simple->select();
                            $query = $simple->execute();
                            
                            
                            $exibindo = mysqli_num_rows($query);
                        endif;
                            
                            $sim =  new Simple_Mysql();
                            $sim->table = array('produtos');
                            $sim->column =array('*');
                            $sim->select();
                            $existem = mysqli_num_rows($sim->execute());

                            ?>
                        Busca Ver Estoque
                    </h1>
                    <h3>Exibindo: <?php echo $exibindo;?> de <?php echo $existem;?> </h3>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-12 br-bottom">
                    <form method="get">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Busca</label>
                        <input type="text" name='busca' class="form-control" id="exampleInputEmail1">
                      </div>
                      <button type="submit" class="btn btn-default pull-right">Buscar</button>
                    </form>
                </div>
                <div class='clearfix br br-bottom'></div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

    <section class="container-fluid">
        <section class="row">
        <?php if($busca !=''):
        while ($row = mysqli_fetch_array($query)):?>

      <div class="col-sm-8 col-xs-12">
          <div class="row">
              <div class="col-sm-6 col-xs-12"
              <p><label>Produto: </label> <?php echo (isset($row['nome']))?$row['nome']:'';?></p>
            <p><label>Preço: </label> R$ <?php echo (isset($row['preco']))?$row['preco']:'';?></p>  
             </div>
              <div class="col-sm-6 col-xs-12">
              <p><label>Contém Imagens: </label> <?php echo ($row['visibilidade'])?'Sim':'Não';?></p>
              <p><label>Promovido: </label> <?php echo ($row['promocao'])?'SIM':'Não';?></p>

             </div>
              <div class="col-xs-12">
                  <label> Estoque: </label>
              <?php foreach ($produto as $value_prod):
                    if($row['id']==$value_prod['id_produto']): ?>
                
                   <p>
                       <label> Cor:</label>  <?php echo  $cor[$value_prod['cor']]?> - 
                       <label> Tamanho: </label> <?php echo  $tamanho[$value_prod['tamanho']]?> - 
                       <label> Quantidade:</label> <span style="font-size: 1.8rem;"><?php echo  $value_prod['estoque']?></span>  
                   </p> 
                
                <?php endif;
                endforeach;?>
              </div>
          </div>
      </div>
      <div class="col-sm-4 col-xs-12">
            <a class='btn btn-warning pull-right' href='produto_adm.php?cat=<?php echo $row['categoria']?>&sub=<?php echo $row['subcategoria']?>&id=<?php echo $row['id']?>'> Ver / Alterar</a>
      </div>

          <div class="clearfix"></div>
                  <hr/>
        <?php endwhile; endif;?>
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
