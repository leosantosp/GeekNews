<?php
require 'class/Config.php'; 
error_reporting(null);
header('Content-Type: text/html; charset=utf-8');
$headers = "Content-type: text/html; charset=utf-8\r\n";
$name = $_POST['name'];
$telefone = $_POST['telefone'];
$whatsapp = $_POST['whatsapp'];
$email = $_POST['email'];
$msg = $_POST['mensagem'];
$url = $_POST['url'];
$mensagem = "
<table >
	<tr>
    <td  align='center' style='border-bottom:1px solid #DDDDDD;'>
      <strong>Nome:</strong> $name
    </td>
  </tr>

  <tr>
    <td style='border-bottom:1px solid #DDDDDD;'>
        <strong>Telefone: </strong>
        $telefone "
        . "</td>"
        . "</tr>";
        if (isset($_POST['whatsapp'])):
            $mensagem .= "
        <tr><td style='border-bottom:1px solid #DDDDDD;'>
            <strong>Whatsapp: </strong>
            $whatsapp "
            . "</td></tr>";
            endif;
            if (isset($_POST['assunto'])):
                $mensagem .= "
            <tr ><td style='border-bottom:1px solid #DDDDDD;'>
                <strong>Assunto: </strong>
                $assunto "
                . "</td></tr>";
                endif;
                $mensagem .= "
                <tr>
                  <td style='border-bottom:1px solid #DDDDDD;'><strong>E-mail: </strong>
                    $email </td>
                 </tr>
                 <tr>
                    <td><strong>Mensagem: </strong></td>
                </tr>
                <tr>
                    <td>$msg </td>
                </tr>
            </table>";
// echo $mensagem;
// die;
            mail(Config::EMAIL_ENVIO, "Contato do cliente", $mensagem, $headers);
            mail("marketing@mazukim.com.br", "Contato do cliente via Blog Mazukim ", $mensagem, $headers);
            echo "
            <script>
               alert('Mensagem enviada com sucesso')
           </script>
           <meta http-equiv='refresh' content='0;URL=" . Config::DIRETORIO_SITE . "index/'>
           ";
die;

?>