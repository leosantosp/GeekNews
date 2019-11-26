<?php
class produto{
	 var $paginacao =12;


	public function buscarprodutocategoria($idproduto){
$sql ="SELECT subcategoria.nome AS subcategoria,  categoria.nome AS categoria FROM categoria
 INNER JOIN subcategoria ON categoria.id = subcategoria.categoria INNER JOIN produtos ON produtos.subcategoria = subcategoria.id WHERE produtos.id = 
 '".$idproduto."' LIMIT 1";


 return mysql_query($sql);

}


	 public function inserir($data,$nome,$subcategoria,$descricao,$image1,$preco)
	{	


		 $sql = "SELECT * FROM produtos WHERE nome= '".$nome."' ";
		 $row = mysql_query($sql);
		 $num=mysql_num_rows($row);

		 if($nome==""){
		 $num=0;
		 }

		
		 if($num==0)
		{

		$sql = " INSERT INTO produtos( subcategoria, datadecadastro, nome, imagem1, descricao,preco) VALUES ('$subcategoria', '$data', '$nome','$image1','$descricao','$preco')";


				
		mysql_query($sql);

		$sql = "SELECT * FROM produtos WHERE nome= '".$nome."' ";
		 $querys = mysql_query($sql);
		 $row = mysql_fetch_array($querys);
		return $row['id'];
		
		}else{

		return -1;

		}
		

		

}
	 public function getpaginacao(){

	 	return $this->paginacao;
	
	}
	 public function busca($busca,$pagina=0)
	{
	$paginacao =	$this->paginacao;



	 $sql = "SELECT * FROM produtos
WHERE  produtos.nome LIKE '%$busca%' OR produtos.descricao LIKE '%$busca%' 
LIMIT $paginacao OFFSET $pagina 
	 ";

	 return $querys = mysql_query($sql);
	}

	public function buscarprodutoporcategoria($idcategoria){
$sql ="SELECT produtos.nome AS nome,  produtos.id AS id FROM categoria
 INNER JOIN subcategoria ON categoria.id = subcategoria.categoria INNER JOIN produtos ON produtos.subcategoria = subcategoria.id WHERE categoria.id = 
 '".$idcategoria."'";


 return mysql_query($sql);

}

	 public function buscapaginacao($busca)
	{
	$paginacao =	$this->paginacao;
	 $sql ="SELECT * FROM produtos
WHERE  produtos.nome LIKE '%$busca%' OR produtos.descricao LIKE '%$busca%' 
"; 

	  $querys = mysql_query($sql);
	  return $num=mysql_num_rows($querys);
	  
	}

	 public function buscaporid($busca)
	{
		 $sql = "SELECT id, subcategoria, datadecadastro, nome, imagem1, descricao, preco
FROM produtos
WHERE produtos.id = $busca";


				


	 return $querys = mysql_query($sql);
	}

	public function excluirporsubcategoria($id,$dir)
	{
		$sql = "SELECT * FROM produtos WHERE subcategoria= '".$id."' ";
		 $querys = mysql_query($sql);
		 while ($row = mysql_fetch_array($querys)) {
		 	if($row ['imagem1']!=""){
			unlink($dir.$row ['imagem1']);
		}

		 }
	 $sql ="DELETE FROM produtos WHERE subcategoria='$id'";

	 mysql_query($sql);

	 $sql = "SELECT subcategoria FROM produtos WHERE id= '".$id."'";
		 $row = mysql_query($sql);
		 $num=mysql_num_rows($row);
	if($num!=1){
		return 1;
	}else{
		return 0;
	}

	}


		public function excluirporcategoria($id,$dir)
	{
		 $sql = "SELECT subcategoria.id AS idsubcategoria,  produtos.id, produtos.imagem1 FROM categoria
 INNER JOIN subcategoria ON categoria.id = subcategoria.categoria INNER JOIN produtos ON produtos.subcategoria = subcategoria.id WHERE categoria.id = '".$id."'";

		 $querys = mysql_query($sql);
		 while ($row = mysql_fetch_array($querys)) {
		 	if($row ['imagem1']!=""){
			unlink($dir.$row ['imagem1']);

		}

		$sql1 ="DELETE FROM produtos WHERE id='".$row ['id']."'";

	 mysql_query($sql1);



		 }

	}


	 public function excluir($id)
	{
				
	 $sql ="DELETE FROM produtos WHERE id='$id'";

	 mysql_query($sql);


	 $sql = "SELECT id FROM produtos WHERE id= '".$id."'";
		 $row = mysql_query($sql);
		 $num=mysql_num_rows($row);
	if($num!=1){
		return 1;
	}else{
		return 0;
	}

	}

		 public function alterar($id,$nome,$descricao,$new_name1,$preco)

	{
		$sql = "SELECT id FROM produtos WHERE id = $id";
		 $row = mysql_query($sql);
		 $num=mysql_num_rows($row);

		
		 if($num==1)
		{
			

		 $sql = "UPDATE produtos SET nome = '$nome', imagem1 = '$new_name1', descricao = '$descricao', preco = '$preco'WHERE id = $id";
				
		 mysql_query($sql);
	
		return 1;
		}else{

		return -1;

		}

}
}
?>