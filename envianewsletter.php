<?php
require 'class/Config.php'; 
error_reporting(null);
header('Content-Type: text/html; charset=utf-8');
$headers = "Content-type: text/html; charset=utf-8\r\n";
$email = $_POST['email'];
$nome = $email;
$mensagem = "
<table >
  <tr>
    <td  align='center' style='border-bottom:1px solid #DDDDDD;'>
      <strong>$nome deseja receber novidades da Geek News:</strong> 
    </td>
  </tr>

  <tr>
    <td style='border-bottom:1px solid #DDDDDD;'>
      <strong>Email:</strong> $email
    </td>
  </tr>

</table>";
// echo $mensagem;
// die;
            mail(Config::EMAIL_ENVIO, "Assinatura da Newsletter", $mensagem, $headers);
            echo "
            <script>
               alert('Newsletter cadastrada com sucesso')
           </script>
           <meta http-equiv='refresh' content='0;URL=" . Config::DIRETORIO_SITE . "index.php'>
           ";
die;

?>