<?php
<<<<<<< Updated upstream
 include(conexionMysql.php);
=======
 include("conexionMysql.php");
>>>>>>> Stashed changes
	session_start();
echo " <!DOCTYPE html>
	<html lang='es'>
	<head>
		<meta charset='UTF-8'/>
		<title>Publicaciones</title>
	</head>
	<body>";
$conexion=mysqli_connect('localhost','root','','NavyBreak');
echo "<table>";
//Mando a llamar las publicaciones relacionandolas con el el nombre del usuario pero si agregamos ID al usuario habra que cambiar Usuario por Id_Usuario
	$query="select * from POST join USER on POST.id_user=USER.id_user order by post_time DESC;";
	$res=mysqli_query($conexion,$query);
	$fila=mysqli_fetch_assoc($res);
while($fila)
{
	echo $fila['username'].$fila['post_time'];
	echo $fila['post_text'];
	$fila=mysqli_fetch_assoc($res);
}
session_unset();
echo "</table>
</body>
	</html>"
?>