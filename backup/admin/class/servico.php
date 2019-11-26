<?php
class servico{
	 var $paginacao =12;

	 public function inserir($nome, $descricao){


		$sql = "SELECT * FROM cliente WHERE email= '".$email."' OR cpfcnpj= '".$cpfcnpj."'";
		 $row = mysql_query($sql);
		 $num=mysql_num_rows($row);


		 if($num<1)
		{

			$data = str_replace('/', '-', $data);

			$data = date('Y-m-d',strtotime($data));
		$sql = "INSERT INTO cliente ( nome,empresa, endereco, cep , bairro, complemento, cidade, estado, pais, email, emailsecundario, tel1, tel2, data, rgie, cpfcnpj) VALUES ('$nome','$nomeempresa', '$endereco', '$cep' , '$bairro', '$complemento', '$cidade', '$estado', '$pais', '$email','$emailsecundario', '$tel1', '$tel2', '$data', '$rgie', '$cpfcnpj')";
		$sql2 = "SELECT LAST_INSERT_ID( ) AS id";
				
		mysql_query($sql);

		$query = mysql_query($sql2);
		$row = mysql_fetch_array($query);
		
		 return  $row['id'];
		}else{

		return -1;

		}

		

}
	 public function getpaginacao(){

	 	return $this->paginacao;
	
	}

	public function servicos()
	{

	 $sql = "SELECT * FROM categoria_servico";

	return $querys = mysql_query($sql);

	}

	public function servicosporcategoria($idcategoria)
	{

	$sql = "SELECT * FROM servico WHERE idcategoria='$idcategoria'";

	return $querys = mysql_query($sql);

	}

	 public function busca($id='')
	{
	if ($id!='') {
	 $sql = "SELECT * FROM  servicos ";
	}else{
	$sql = "SELECT * FROM  servicos WHERE ´id´='$id'";
	}

	 return $querys = mysql_query($sql);
	}


	 public function buscapaginacao($busca,$status='')
	{
	$paginacao =	$this->paginacao;

	if($status!=''){
		$atividade = "status='$status' AND";
	}

	 $sql ="SELECT  nome, cidade, estado, cpfcnpj FROM cliente WHERE $atividade  (nome LIKE '%$busca%' OR endereco LIKE '%$busca%' OR cep LIKE '%$busca%' OR bairro LIKE '%$busca%' OR complemento LIKE '%$busca%' OR cidade LIKE '%$busca%' OR estado LIKE '%$busca%' OR pais LIKE '%$busca%' OR email LIKE '%$busca%' OR tel1 LIKE '%$busca%' OR tel2 LIKE '%$busca%' OR data LIKE '%$busca%' OR rgie LIKE '%$busca%' OR cpfcnpj  LIKE '%$busca%')"; 

	  $querys = mysql_query($sql);
	  return $num=mysql_num_rows($querys);
	  
	}

	 public function buscaporid($busca)
	{
				
	 $sql ="SELECT * FROM cliente WHERE id=$busca";

	 return $querys = mysql_query($sql);
	}


	 public function excluir($id)
	{
	 $sql ="UPDATE  `cliente` SET  `status` =  'Inativo' WHERE  `cliente`.`id` =$id LIMIT 1 ";

	 mysql_query($sql);

	 $sql = "SELECT status FROM cliente WHERE id= '".$id."' AND status = 'Inativo'";
		 $row = mysql_query($sql);
		 $num=mysql_num_rows($row);
	if($num!=1){
		return 1;
	}else{
		return 0;
	}

	}
		 public function alterar($id, $cliente, $tipo, $nome, $endereco, $cep , $bairro, $complemento, $cidade, $estado, $pais, $email, $tel1, $tel2, $data, $rgie, $cpfcnpj,$status)
	{
		$sql = "SELECT * FROM cliente WHERE email= '".$email."' OR cpfcnpj= '".$cpfcnpj."'";
		 $row = mysql_query($sql);
		 $num=mysql_num_rows($row);

		
		 if($num<=1)
		{
			$data = str_replace('/', '-', $data);
			$data = date('Y-m-d',strtotime($data));

		 
		 $sql = "UPDATE cliente SET cliente = '$cliente', tipo = '$tipo', nome = '$nome', endereco = '$endereco', cep = '$cep' , bairro = '$bairro', complemento = '$complemento', cidade = '$cidade', estado = '$estado', pais = '$pais', email = '$email', tel1 = '$tel1', tel2 = '$tel2', data = '$data', rgie = '$rgie', cpfcnpj = '$cpfcnpj', status = '$status' WHERE id = $id";
				
		 mysql_query($sql);
	
		return 1;
		}else{

		return 0;

		}

}
}
?>