<?php 

function debugpostget($tela)
{
	if ($tela==1) {
echo "_GET <br>";
foreach ($_GET as $key => $value) {

  		echo "($key=>$value),";
		}
		echo "<br>";
	}


	if ($tela==0) {
			echo "_POST <br>";
foreach ($_POST as $key => $value) {
  echo "($key=>$value),";
}

echo "<br>";
}
}


 ?>