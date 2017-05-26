<?php
 include("conexionMysql.php");
$usu=$_POST['username'];
$contra="S@7r0".$_POST['password']."p1M3^|RO";
$datos = array();
$valus = 0;
$conexion=mysqli_connect('localhost','root','','NavyBreak');
	$query="select id_user,username,password,b_day,wgames from USER;";
	$res=mysqli_query($conexion,$query);
	$fila=mysqli_fetch_assoc($res);
	$concat="";
//Se guardan los datos en una matriz
while($fila)
{
	$datos [] = $fila;
	$fila=mysqli_fetch_assoc($res);
}
foreach ($datos as $key => $exis) 
	if ($usu == $exis['username'])
		$valus = 1;
if ($valus == 0)
	echo '<script> 
				alert("El usuario no existe");
				</script>';
else
	foreach ($datos as $key => $exis) 
	if ($usu == $exis['username'])
	{
		if ($contra == $exis['password'])
		{
			echo '<script> 
				alert("Acceso concedido");
				</script>';
			echo $exis['id_user'];
			echo $exis['username'];
			echo $exis['b_day'];
			echo $exis['wgames'];
		
		}		
		else
			echo '<script> 
				alert("Acceso denegado");
				</script>';
	}
	
?>
