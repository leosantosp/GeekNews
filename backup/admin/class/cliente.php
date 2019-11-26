<?php
class cliente{
	 var $paginacao =12;

	 public function inserir($nome,$nomeempresa, $endereco, $cep , $bairro, $complemento, $cidade, $estado, $pais, $email,$emailsecundario, $tel1, $tel2, $data, $rgie, $cpfcnpj){


		$sql = "SELECT * FROM cliente WHERE email= '".$email."'";
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
	 public function busca($busca,$pagina=0,$status='')
	{
	$paginacao =	$this->paginacao;




	 $sql = "SELECT * FROM cliente WHERE (nome LIKE '%$busca%' OR endereco LIKE '%$busca%' OR cep LIKE '%$busca%' OR bairro LIKE '%$busca%' OR complemento LIKE '%$busca%' OR cidade LIKE '%$busca%' OR estado LIKE '%$busca%' OR pais LIKE '%$busca%' OR email LIKE '%$busca%' OR tel1 LIKE '%$busca%' OR tel2 LIKE '%$busca%' OR data LIKE '%$busca%' OR rgie LIKE '%$busca%' OR cpfcnpj  LIKE '%$busca%')
	 LIMIT $paginacao OFFSET $pagina ";


	 return $querys = mysql_query($sql);
	}


	 public function buscapaginacao($busca,$status='')
	{
	$paginacao =	$this->paginacao;

	if($status!=''){
		$atividade = "status='$status' AND";
	}


	 $sql ="SELECT  nome, cidade, estado, cpfcnpj FROM cliente WHERE (nome LIKE '%$busca%' OR endereco LIKE '%$busca%' OR cep LIKE '%$busca%' OR bairro LIKE '%$busca%' OR complemento LIKE '%$busca%' OR cidade LIKE '%$busca%' OR estado LIKE '%$busca%' OR pais LIKE '%$busca%' OR email LIKE '%$busca%' OR tel1 LIKE '%$busca%' OR tel2 LIKE '%$busca%' OR data LIKE '%$busca%' OR rgie LIKE '%$busca%' OR cpfcnpj  LIKE '%$busca%')"; 

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
		 public function alterar($id, $nome,$nomeempresa, $endereco, $cep , $bairro, $complemento, $cidade, $estado, $pais, $email,$emailsecundario, $tel1, $tel2, $data, $rgie, $cpfcnpj)

	{
		$sql = "SELECT * FROM cliente WHERE email= '".$email."' OR cpfcnpj= '".$cpfcnpj."'";
		 $row = mysql_query($sql);
		 $num=mysql_num_rows($row);

		
		 if($num==1)
		{
			$data = str_replace('/', '-', $data);
			$data = date('Y-m-d',strtotime($data));

		$sql = "UPDATE cliente SET nome = '$nome', empresa = '$empresa' endereco = '$endereco', cep = '$cep' , bairro = '$bairro', complemento = '$complemento', cidade = '$cidade', estado = '$estado', pais = '$pais', email = '$email', emailsecundario = '$emailsecundario', tel1 = '$tel1', tel2 = '$tel2', data = '$data', rgie = '$rgie', cpfcnpj = '$cpfcnpj' WHERE id = $id";
				
		 mysql_query($sql);
	
		return 1;
		}else{

		return -1;

		}


}
	 public function associarservico($id,$servicos)
	{
		if(isset($servicos)){
			foreach ($servicos as $key => $value) {

			$sql .= "INSERT INTO cliente_servico ( idcliente,idservico) VALUES ('$id','$value');";
			}
			mysql_query($sql);
		}

	}
}
?>