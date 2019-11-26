<?php
session_start();

//error_reporting(NULL);
include_once 'Persistence.php';
include_once 'Util.php';
include_once 'Data_Pagamento.php';

class conexao implements Persistence , Data_Pagamento{
	private $user;
	private $conexao;

        public function conexao()
	{
        
            $this->conexao = mysqli_connect(persistence::HOST, persistence::USER, persistence::PASSWORD);
            mysqli_select_db($this->conexao,persistence::DBNAME);
            
		
	}	


	 public function valida($user,$senha)
	{
				
		$senha = md5($senha);	
		 $sql = mysqli_query($this->conexao,"SELECT * FROM admin WHERE login='".$user."' AND senha='".$senha."'");
		$num=mysqli_num_rows($sql);
		if($num==1){
		$_SESSION["user"]=$user;
		echo "<meta http-equiv='refresh' content='0;URL=painel.php'>";
                die;
		}else{
			

			echo "<meta http-equiv='refresh' content='0;URL=index.php'><script>alert('Login ou senha inválida');</script>";
			
			}
		}
	public function manter(){

		

		if($_SESSION["user"])
		{
			$this->user=$_SESSION["user"];
		}else{
		echo "<meta http-equiv='refresh' content='0;URL=index.php'><script>";
                die;
		}

	}
		public function destruir(){

			$this->user="";
			$_SESSION["user"]="";
			echo "<meta http-equiv='refresh' content='0;URL=index.php'><script>";
                        die;


	}
	public function getUser(){
	
		return $_SESSION["user"];
	}

	public function getconexao(){
	
		return $this->conexao;
	}




}
function limita_caracteres($texto, $limite, $quebra = true) {
    $tamanho = strlen($texto);
    // Verifica se o tamanho do texto é menor ou igual ao limite
    if ($tamanho <= $limite) {
        $novo_texto = $texto;
    // Se o tamanho do texto for maior que o limite
    } else {
        // Verifica a opção de quebrar o texto
        if ($quebra == true) {
            $novo_texto = trim(substr($texto, 0, $limite)).'...';
        // Se não, corta $texto na última palavra antes do limite
        } else {
            // Localiza o útlimo espaço antes de $limite
            $ultimo_espaco = strrpos(substr($texto, 0, $limite), ' ');
            // Corta o $texto até a posição localizada
            $novo_texto = trim(substr($texto, 0, $ultimo_espaco)).'...';
        }
    }
    // Retorna o valor formatado
    $novo_texto = filter_var($novo_texto, FILTER_SANITIZE_STRING);
    return $novo_texto;
}
function curPageURL($absoluto=0) {

     $pageURL = 'http';

     if (isset($_SERVER["HTTPS"])&&$_SERVER["HTTPS"] == "on") {$pageURL .= "s";}

     $pageURL .= "://";

     if ($_SERVER["SERVER_PORT"] != "80") {

      $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];

        if($absoluto==0):

            $pageURL .= $_SERVER["REQUEST_URI"];

        endif;

     } else {

      $pageURL .= $_SERVER["SERVER_NAME"];

        if($absoluto==0):

            $pageURL .= $_SERVER["REQUEST_URI"];

        endif;

     }

     if(isset($_SERVER['QUERY_STRING'])
        &&$_SERVER['QUERY_STRING']!=''
        &&($absoluto!=0&&$absoluto!=1)):

         $pageURL.= '?'.$_SERVER['QUERY_STRING'];

     endif;

     return $pageURL;

    }
?>