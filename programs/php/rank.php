<?php

include("conexionMysql.php");
$query="select username,wgames from user limit 50;";
$const=mysqli_query($conexion,$query);

$rank=mysqli_fetch_assoc($const);
$vec=json_encode($rank);
while ($rank) 
{
	$rank=mysqli_fetch_assoc($const);
	if(isset($rank))
		$vec=$vec.json_encode($rank);
	
}
echo $vec;
?>