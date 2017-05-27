<?php
 include("conexionMysql.php");
 echo "<meta http-equiv='Refresh' content='1; URL=../../templates/login.html'>";
$usu=$_POST['username'];
$contra=$_POST['password'];
$contra=hash("adler32",$contra);
$datos = array();
$valus = 0;
$conexion=mysqli_connect('localhost','root','','NavyBreak');
	$query="select id_user,username,password from USER;";
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
if ($valus == 0){
	echo '<script> 
				alert("El usuario no existe");
				</script>';
	//header('location:../../templates/login.html');
}
else
	foreach ($datos as $key => $exis) 
		if ($usu == $exis['username'])
		{
//lo dejo comentado para que lo trabajes daniel, pero la netaa no se que hacer aqui
			echo '<script> 
				alert("Acceso concedido");
				</script>';
				header('location:publicaciones.php');
		}		
		else{
			echo '<script> 
				alert("Acceso denegado");
				</script>';
			}

			if ($contra == $exis['password'])
			{
				echo '<script> 
					alert("Acceso concedido");
					</script>';
				$id=$exis['id_user'];
				setcookie('id_user',$id,time()+259200,"/");
			}		
			else
				echo '<script> 
					alert("Acceso denegado");
					</script>';
		

	
?>
