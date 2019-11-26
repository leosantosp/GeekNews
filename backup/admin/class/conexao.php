<?php
error_reporting(NULL);
class conexao{
	private $user;
	private $conexao;
	
	 public function conexao()
	{
	
//$this->conexao = mysqli_connect("localhost", "softhar_muzzi", "muzzi321");
$this->conexao = mysqli_connect("localhost", "softhar_sistema", "151211cd");
//$this->conexao = mysqli_connect("localhost", "root", "");
		//mysqli_select_db($this->conexao,"softhar_muzzi");
		mysqli_select_db($this->conexao,"softhar_sistema");
		
	}	


	 public function valida($user,$senha)
	{
				
		$senha = md5($senha);	
		 $sql = mysqli_query($this->conexao,"SELECT * FROM admin WHERE login='".$user."' AND senha='".$senha."'");
		$num=mysqli_num_rows($sql);
		if($num==1){
		$_SESSION["user"]=$user;
		echo "<meta http-equiv='refresh' content='0;URL=painel.php'>";

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

		}

	}
		public function destruir(){

			$this->user="";
			$_SESSION["user"]="";
			echo "<meta http-equiv='refresh' content='0;URL=index.php'><script>";


	}
	public function getUser(){
	
		return $_SESSION["user"];
	}

	public function getconexao(){
	
		return $this->conexao;
	}




}
?>