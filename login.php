<?php
$usu = $_POST['Usuario'];
$contra = $_POST['Clave'];
$datos = array();
$valus = 0;
$conn=mysqli_connect('localhost','root','','NavyBreak');
	$query="select usuario,contra from USUARIOS;";
	$res=mysqli_query($conn,$query);
	$fila=mysqli_fetch_assoc($res);
	$concat="";
//Se guardan los datos en una matriz
while($fila)
{
	$datos [] = $fila;
	$fila=mysqli_fetch_assoc($res);
}
foreach ($datos as $key => $exis) 
	if ($usu == $exis['nombre_usuario'])
		$valus = 1;
if ($valus == 0)
	echo '<script> 
				alert("El usuario no existe");
				</script>';
else
	foreach ($datos as $key => $exis) 
	if ($usu == $exis['nombre_usuario'])
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
