<?php


class banner 
{
	

	public  function getBanner(){

		$log = new conexao();




			return $query;
		
	}

	public  function getBannerNome( $id){

		$sql = "SELECT nome FROM banner WHERE id = $id";

		$query = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($query);
		  return $row[0];


		
	}

	public  function setBannerNome( $id, $nome){

		$sql = "UPDATE banner SET nome='$nome' WHERE id = $id";

		mysqli_query($conn,$sql);
		


		
	}
}
?>