<?php
 include("conexionMysql.php");
$usu=$_POST['username'];
$contra=$_POST['password'];
$datos = array();
$valus = 0;
$conexion=mysqli_connect('localhost','root','','NavyBreak');
	$query="select username,password from USER;";
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
		
		}		
		else
			echo '<script> 
				alert("Acceso denegado");
				</script>';
	}
	
?>
