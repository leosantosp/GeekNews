<?php

class categoria{
	 var $paginacao =12;

	 public function inserir($categoria)
	{		

		 if($categoria==""){return 0;}

		 


		 $sql = "SELECT id FROM  categoria WHERE nome = '$categoria' LIMIT 1";
		 $row = mysql_query($sql);
		 $num=mysql_num_rows($row);

		
		 if($num<1)
		{

		$sql = " INSERT INTO categoria (nome) VALUES ('$categoria')";

				
		mysql_query($sql);
	
		return 1;
		}else{

		return 0;

		}

		

}
	 public function getpaginacao(){

	 	return $this->paginacao;
	
	}
	 public function getCategoria()
	{
	$paginacao =	$this->paginacao;

	 $sql = "SELECT * FROM categoria 
	 ";

	 return $querys = mysql_query($sql);
	}

	 public function busca($busca,$pagina=0)
	{
	$paginacao =	$this->paginacao;

	 $sql = "SELECT * FROM categoria
			WHERE  categoria.nome LIKE '%$busca%' 
			LIMIT $paginacao OFFSET $pagina 
	 ";

	 return $querys = mysql_query($sql);
	}


	 public function buscapaginacao($busca)
	{
	$paginacao =	$this->paginacao;
	 $sql ="SELECT * FROM categoria
			WHERE  categoria.nome LIKE '%$busca%'"; 

	  $querys = mysql_query($sql);
	  return $num=mysql_num_rows($querys);
	  
	}

	 public function buscaporid($busca)
	{
	$sql =	"SELECT * FROM categoria
			WHERE  categoria.id = $busca
";
	 return $querys = mysql_query($sql);
	}


	 public function buscanomeporid($busca)
	{

		$query = $this->buscaporid($busca);
        $row = mysql_fetch_array($query);
	 return $row['nome'];
	}





	 public function excluir($id)
	{
		require 'class/subcategoria.php';
		$sub = new subcategoria();
		$result = $sub->excluirporcategoria($id);
		if ($result==0) {
			return 0;
		}else{
				
	 $sql ="DELETE FROM categoria WHERE id='$id'";

	 mysql_query($sql);

	 $sql = "SELECT id FROM categoria WHERE id= '".$id."'";
		 $row = mysql_query($sql);
		 $num=mysql_num_rows($row);
	if($num!=1){
		return 1;
	}else{
		return 0;
	}

	}

	}
		 public function alterar($id, $nome)
	{
		$sql = "SELECT id FROM categoria WHERE id = $id";
		 $row = mysql_query($sql);
		 $num=mysql_num_rows($row);

		
		 if($num==1)
		{
			

		 $sql = "UPDATE categoria SET nome = '$nome' WHERE id = $id";
				
		 mysql_query($sql);
	
		return 1;
		}else{

		return 0;

		}

}
}
?>