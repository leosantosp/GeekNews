<?php
class materiaprima{
	 var $paginacao =12;

	 public function inserir($fornecedor, $data, $nome,$unidade, $custo, $estmaximo, $estminimo , $estatual, $ultimaentrada, $ultimasaida, $observacoes)
	{		

		 


		 $sql = "SELECT * FROM fornecedor WHERE id= '".$fornecedor."' ";
		 $row = mysql_query($sql);
		 $num=mysql_num_rows($row);

		 if($fornecedor==""){
		 $num=0;
		 }

		
		 if($num>0)
		{
			$ultimaentrada = str_replace('/', '-', $ultimaentrada);
			$ultimasaida = str_replace('/', '-', $ultimasaida);

			$ultimaentrada = date('Y-m-d',strtotime($ultimaentrada));
			$ultimasaida = date('Y-m-d',strtotime($ultimasaida));

		$sql = " INSERT INTO materiaprima ( fornecedor, datacadastro , nome , unidade , custo , estoquemaximo , estoqueminimo , estoqueatual , dataentrada , datasaida , observacoes) VALUES ('$fornecedor' , '$data',  '$nome',  '$unidade',  '$custo',  '$estmaximo',  '$estminimo',  '$estatual',  '$ultimaentrada',  '$ultimasaida',  '$observacoes' )";

				
		mysql_query($sql);
	
		return 1;
		}else{

		return 0;

		}

		

}
	 public function getpaginacao(){

	 	return $this->paginacao;
	
	}
	 public function busca($busca,$pagina=0)
	{
	$paginacao =	$this->paginacao;



	 $sql = "SELECT materiaprima.id,
materiaprima.datacadastro,
materiaprima.nome,
materiaprima.unidade,
materiaprima.custo,
materiaprima.estoquemaximo,
materiaprima.estoqueminimo,
materiaprima.estoqueatual,
materiaprima.dataentrada,
materiaprima.datasaida,
materiaprima.observacoes,
fornecedor.nome AS fornecedor
FROM materiaprima
INNER JOIN fornecedor ON materiaprima.fornecedor = fornecedor.id
WHERE  fornecedor.nome LIKE '%$busca%' OR materiaprima.datacadastro LIKE '%$busca%' OR materiaprima.nome LIKE '%$busca%' OR unidade LIKE '%$busca%' OR materiaprima.custo LIKE '%$busca%' OR materiaprima.estoquemaximo LIKE '%$busca%' OR materiaprima.estoqueminimo LIKE '%$busca%' OR materiaprima.estoqueatual LIKE '%$busca%' OR materiaprima.dataentrada LIKE '%$busca%' OR materiaprima.datasaida LIKE '%$busca%' OR materiaprima.observacoes LIKE '%$busca%'
LIMIT $paginacao OFFSET $pagina 
	 ";

	 return $querys = mysql_query($sql);
	}


	 public function buscapaginacao($busca)
	{
	$paginacao =	$this->paginacao;
	 $sql ="SELECT materiaprima.id,
materiaprima.datacadastro,
materiaprima.nome,
materiaprima.unidade,
materiaprima.custo,
materiaprima.estoquemaximo,
materiaprima.estoqueminimo,
materiaprima.estoqueatual,
materiaprima.dataentrada,
materiaprima.datasaida,
materiaprima.observacoes,
fornecedor.nome AS fornecedor
FROM materiaprima
INNER JOIN fornecedor ON materiaprima.fornecedor = fornecedor.id
WHERE  fornecedor.nome LIKE '%$busca%' OR materiaprima.datacadastro LIKE '%$busca%' OR materiaprima.nome LIKE '%$busca%' OR unidade LIKE '%$busca%' OR materiaprima.custo LIKE '%$busca%' OR materiaprima.estoquemaximo LIKE '%$busca%' OR materiaprima.estoqueminimo LIKE '%$busca%' OR materiaprima.estoqueatual LIKE '%$busca%' OR materiaprima.dataentrada LIKE '%$busca%' OR materiaprima.datasaida LIKE '%$busca%' OR materiaprima.observacoes LIKE '%$busca%'
"; 

	  $querys = mysql_query($sql);
	  return $num=mysql_num_rows($querys);
	  
	}

	 public function buscaporid($busca)
	{
	$sql =	"SELECT materiaprima.id,
materiaprima.datacadastro,
materiaprima.nome,
materiaprima.unidade,
materiaprima.custo,
materiaprima.estoquemaximo,
materiaprima.estoqueminimo,
materiaprima.estoqueatual,
materiaprima.dataentrada,
materiaprima.datasaida,
materiaprima.observacoes,
fornecedor.nome AS fornecedor
FROM materiaprima
INNER JOIN fornecedor ON materiaprima.fornecedor = fornecedor.id WHERE materiaprima.id = $busca
";
				


	 return $querys = mysql_query($sql);
	}
public function produtocomateriaprima($id){


$sql = "SELECT produtos.id, produtos.nome FROM materiaprimaprodutos 
	INNER JOIN produtos  ON materiaprimaprodutos.idproduto = produtos.id
	WHERE materiaprimaprodutos.idmateria = '$id'";
	$query = mysql_query($sql);


	return $query;
}

	 public function excluir($id)
	{
$sql = "SELECT produtos.nome FROM materiaprimaprodutos 
	INNER JOIN produtos  ON materiaprimaprodutos.idproduto = produtos.id
	WHERE materiaprimaprodutos.idmateria = '$id'";
	$query = mysql_query($sql);
	$num=mysql_num_rows($query);

	if($num>0){
		return -1;
	}else{
	 $sql ="DELETE FROM materiaprima WHERE id='$id'";

	 mysql_query($sql);

	 $sql = "SELECT id FROM materiaprima WHERE id= '".$id."'";
		 $row = mysql_query($sql);
		 $num=mysql_num_rows($row);
	if($num!=1){
		return 1;
	}else{
		return 0;
	}

	}

	}
		 public function alterar($id, $nome,$unidade, $custo, $estmaximo, $estminimo , $estatual, $ultimaentrada, $ultimasaida, $observacoes)
	{
		$sql = "SELECT id FROM materiaprima WHERE id = $id";
		 $row = mysql_query($sql);
		 $num=mysql_num_rows($row);

		
		 if($num==1)
		{
			$ultimaentrada = str_replace('/', '-', $ultimaentrada);
			$ultimaentrada = date('Y-m-d',strtotime($ultimaentrada));
			
			$ultimasaida = str_replace('/', '-', $ultimasaida);
			$ultimasaida = date('Y-m-d',strtotime($ultimasaida));

		 $sql = "UPDATE materiaprima SET nome = '$nome', unidade = '$unidade', custo = '$custo' , estoqueminimo = '$estminimo', estoquemaximo = '$estmaximo', estoqueatual = '$estatual', dataentrada = '$ultimaentrada', datasaida = '$ultimasaida', observacoes = '$observacoes' WHERE id = $id";
				
		 mysql_query($sql);
	
		return 1;
		}else{

		return 0;

		}

}

		 public function baixadeestoquepedido($id)
	{
$sql = "SELECT pedido_itens.idpedido AS idpedido, (materiaprimaprodutos.quatidade * pedido_itens.quantidade) AS materiagasta, produtos.id AS idproduto, materiaprima.estoqueatual, materiaprimaprodutos.idmateria  FROM pedido_itens
 INNER JOIN produtos ON pedido_itens.idproduto = produtos.id
 INNER JOIN materiaprimaprodutos ON materiaprimaprodutos.idproduto = produtos.id
 INNER JOIN materiaprima ON materiaprimaprodutos.idmateria = materiaprima.id
 WHERE pedido_itens.idpedido = $id GROUP BY produtos.id";
		 $query = mysql_query($sql);
		 $num=mysql_num_rows($query);


		 if($num>0)
		{
			echo $ultimasaida = date("Y-m-d");

			while ($row = mysql_fetch_array($query)) {

			$idmateria = $row['idmateria'];
			$estoqueatual =$row['estoqueatual'] - $row['materiagasta'];


		$sqls = "UPDATE materiaprima SET estoqueatual = '$estoqueatual', datasaida = '$ultimasaida' WHERE id = '$idmateria'";
				
		mysql_query($sqls);

		}

		return 1;
		}else{

		return 0;

		}

}

		 public function materiaestoque()
	{
	$sqls = "SELECT `id`, `nome`,`estoqueminimo`, `estoqueatual` , `estoquemaximo` FROM `materiaprima` WHERE  CAST( `estoqueatual` AS DECIMAL) <= CAST( `estoqueminimo` AS DECIMAL)";

	$query = mysql_query($sqls);

	return $query;

	}

}
?>