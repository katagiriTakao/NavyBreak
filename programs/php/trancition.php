<?php
include('conexionMysql.php');
$iniQuery="select * from cgame where id_userone='1' OR id_usertwo='1';";
$gameResources=mysqli_query($conexion,$iniQuery);
$gameData=mysqli_fetch_assoc($gameResources);

$_POST['tiro']=strtoupper($_POST['tiro']);

setcookie("id_user","2",time()+60);

function compdata($selShips,$shot){
	$selShips=explode(",",$selShips);
	foreach ($selShips as $value) {
		if($shot==$value)
			return true;
	}
}

	echo  "tu tiro fue ".$_POST['tiro'];

print_r($gameData);

if($gameData['id_userone']==$_COOKIE['id_user']){
	if(!compdata($gameData['cooseone'],$_POST['tiro']))
	{
		//echo "tiro nuevo primer jugador ";
		$queryOne="update cgame set cooseone='".$gameData['cooseone'].",".$_POST['tiro']."' where id_game=".$gameData['id_game'].";";
		//echo $queryOne;
		if(mysqli_query($conexion,$queryOne))
			echo "Datos mandados jug1";
		if(compdata($gameData['cooshtwo'],$_POST['tiro'])){
			echo $_POST['tiro']." ";
			$puntos=$gameData['pone_points']+1;
			$queryOnePoints="update cgame set pone_points='".$puntos."' where id_game=".$gameData['id_game'].";";
			//echo $queryOnePoints;
			if(mysqli_query($conexion,$queryOnePoints))
				echo "Datos puntos actualizados P1";

		}

	}
}
else 
if($gameData['id_usertwo']==$_COOKIE['id_user']){
	if(!compdata($gameData['coosetwo'],$_POST['tiro']))
	{
		echo "tiro nuevo segundo jugador";
		$queryTwo="update cgame set coosetwo='".$gameData['coosetwo'].",".$_POST['tiro']."' where id_game=".$gameData['id_game'].";";
		echo $queryTwo;
		if(mysqli_query($conexion,$queryTwo))
			echo "Datos mandados jug2";
		if(compdata($gameData['cooshone'],$_POST['tiro'])){
			echo $_POST['tiro']." ";
			$puntos=$gameData['ptwo_points']+1;
			$queryTwoPoints="update cgame set ptwo_points='".$puntos."' where id_game=".$gameData['id_game'].";";
			//echo $queryOnePoints;
			if(mysqli_query($conexion,$queryTwoPoints))
				echo "Puntos actualizados P2";

		}
	}
}





?>