<!DOCTYPE html>
<html lang="pt">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Painel</title>

<?php require 'links_header.php';

?>

</head>

<body>
<div id='alert'>
</div>             
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">

                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Área restrita</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" id="form" method='post' action="valida.php">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Login" name="user" type="text"  autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha" name="senha" type="password" value="">
                                </div>
                                <div class="checkbox">

                                </div>
                                
                                <button id='login' href="index.html" class="btn btn-lg btn-success btn-block">Entrar</button>
                            </fieldset>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- jQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!--<script>
$('#login').click(function(e){
    e.preventDefault();
var valores = $('#form').serialize()
    $.ajax({
        url : 'valida.php',
        type: 'post',
        dataType : 'html',
        data: valores,
        beforeSend : function(){

        },
        success : function(retorno){
            $('body').append(retorno);
        } 
    });
});
</script> -->

</body>

</html>
