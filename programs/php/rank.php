<?php

include("conexionMysql.php");
$query="select username,wgames from user order by wgames DESC limit 25;";
$const=mysqli_query($conexion,$query);

$rank=mysqli_fetch_assoc($const);
$vec=implode(" ",$rank)." ";
while ($rank) 
{
	$rank=mysqli_fetch_assoc($const);
	if(isset($rank))
		$vec=$vec.implode(" ",$rank)." ";
}
echo $vec;
?>