<?php
include('conexionMysql.php');
$iniQuery="select * from cgame where id_userone='1' OR id_usertwo='1';";
$gameResources=mysqli_query($conexion,$iniQuery);
$gameData=mysqli_fetch_assoc($gameResources);

$_POST['tiro']=strtoupper($_POST['tiro']);

setcookie("id_user","1",time()+60);

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
		echo "tiro nuevo";
		if(compdata($gameData['cooshtwo'],$_POST['tiro']))
			echo $_POST['tiro'];
	}
}
else 
if($gameData['id_usertwo']==$_COOKIE['id_user']){
	if(!compdata($gameData['coosetwo'],$_POST['tiro']))
	{
		echo "tiro nuevo";
		if(compdata($gameData['cooshone'],$_POST['tiro']))
			echo $_POST['tiro'];
	}
}





?>