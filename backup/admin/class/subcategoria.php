<?php
class subcategoria{
	 var $paginacao =12;

	 public function inserir($subcategoria,$categoria)
	{		

		 if($subcategoria==""){return 0;}

		 


		 $sql = "SELECT id FROM  subcategoria WHERE nome = '$subcategoria' LIMIT 1";
		 $row = mysql_query($sql);
		 $num=mysql_num_rows($row);

		
		 if($num<1)
		{

		$sql = " INSERT INTO subcategoria (nome,categoria) VALUES ('$subcategoria','$categoria')";

				
		mysql_query($sql);
	
		return 1;
		}else{

		return 0;

		}

		

}
	 public function getpaginacao(){

	 	return $this->paginacao;
	
	}
	 public function busca($categoria,$busca,$pagina=0)
	{
	$paginacao =	$this->paginacao;

	 $sql = "SELECT * FROM subcategoria
			WHERE subcategoria.categoria ='$categoria' AND   subcategoria.nome LIKE '%$busca%' 
			LIMIT $paginacao OFFSET $pagina 
	 ";

	 return $querys = mysql_query($sql);
	}


	 public function buscapaginacao($busca)
	{
	$paginacao =	$this->paginacao;
	 $sql ="SELECT * FROM subcategoria
			WHERE subcategoria.categoria ='$categoria' AND subcategoria.nome LIKE '%$busca%'"; 

	  $querys = mysql_query($sql);
	  return $num=mysql_num_rows($querys);
	  
	}

	 public function buscaporid($busca)
	{

	$sql =	"SELECT subcategoria.id, subcategoria.nome, subcategoria.categoria AS idcategoria, categoria.nome AS categoria FROM subcategoria INNER JOIN categoria ON categoria.id = subcategoria.categoria WHERE  subcategoria.id = $busca";

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
				
	 $sql ="DELETE FROM subcategoria WHERE id='$id'";

	 mysql_query($sql);

	 $sql = "SELECT id FROM subcategoria WHERE id= '".$id."'";
		 $row = mysql_query($sql);
		 $num=mysql_num_rows($row);
	if($num!=1){
		return 1;
	}else{
		return 0;
	}

	}

		 public function excluirporcategoria($id)
	{
				
	 $sql ="DELETE FROM subcategoria WHERE categoria='$id'";

	 mysql_query($sql);

	 $sql = "SELECT id FROM subcategoria WHERE categoria= '".$id."'";
		 $row = mysql_query($sql);
		 $num=mysql_num_rows($row);
	if($num!=1){
		return 1;
	}else{
		return 0;
	}

	}
		 public function alterar($id, $nome)
	{
		$sql = "SELECT id FROM subcategoria WHERE id = $id";
		 $row = mysql_query($sql);
		 $num=mysql_num_rows($row);

		
		 if($num==1)
		{

		 $sql = "UPDATE subcategoria SET nome = '$nome'WHERE id = $id";
				
		 mysql_query($sql);
	
		return 1;
		}else{

		return 0;

		}

}
}
?>