<?php
class marketingdigital{
	 var $paginacao =12;

	 public function inserir($nome, $descricao){


		$sql = "SELECT * FROM marketingdigital WHERE nome= '".$nome."'";
		 $row = mysql_query($sql);
		 $num=mysql_num_rows($row);

		 if($num<1)
		{

		$sql = "INSERT INTO marketingdigital ( nome,empresa, endereco, cep , bairro, complemento, cidade, estado, pais, email, emailsecundario, tel1, tel2, data, rgie, cpfcnpj) VALUES ('$nome', '$descricao')";
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


	 public function busca($id='')
	{
	if ($id=='') {
	$sql = "SELECT * FROM marketingdigital ";
	}else{
	$sql = "SELECT * FROM  marketingdigital WHERE ´id´='$id'";
	}

	 return $querys = mysql_query($sql);
	}

		 public function alterar($id, $nome, $descricao)
	{
		$sql = "SELECT * FROM marketingdigital WHERE id= '".$id."'";
		 $row = mysql_query($sql);
		 $num=mysql_num_rows($row);

		
		 if($num==1)
		{
		 $sql = "UPDATE marketingdigital SET nome = '$nome', descricao = '$descricao' WHERE id = $id";
				
		 mysql_query($sql);
	
		return 1;
		}else{

		return 0;

		}

}
}
?>