<?php
	session_start();
echo " <!DOCTYPE html>
	<html lang='es'>
	<head>
		<meta charset='UTF-8'/>
		<title>Publicaciones</title>
	</head>
	<body>";
$conn=mysqli_connect('localhost','root','','NavyBreak');
echo "<table>";
//Mando a llamar las publicaciones relacionandolas con el el nombre del usuario pero si agregamos ID al usuario habra que cambiar Usuario por Id_Usuario
	$query="select * from PUBLICACIONES join USUARIOS on PUBLICACIONES.Usuario=USUARIOS.Usuario order by Tiempo_publicacion DESC;";
	$res=mysqli_query($conn,$query);
	$fila=mysqli_fetch_assoc($res);
while($fila)
{
	echo $fila['Usuario'].$fila['Tiempo_publicacion'];
	echo $fila['Texto_publicacion'];
	$fila=mysqli_fetch_assoc($res);
}
session_unset();
echo "</table>
</body>
	</html>"
?>