<?php
 include("conexionMysql.php");
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
//Este query obtiene las publicaciones con username, el texto y el tiempo en que se realizo
	$querypub="select username,post_text,post_time from POST join USER on POST.id_userpost=USER.id_user order by post_time DESC;";
	$res=mysqli_query($conexion,$querypub);
	$fila=mysqli_fetch_assoc($res);
//Este otro query obtiene los comentarios; username, texto, tiempo, likes y mecaga que componen al comentario. EL WHERE SE ENCARGA DE ASEGURARSE DE QUE LOS COMENTARIOS SEAN DE LA PUBLICACION Y EVITAR QUE TODOS LOS COMENTARIOS DE TODAS LAS PUBLICACIONES ESTEN EN UNA PUBLICACION
	$querycom="select username,comment_text,comment_time,likes,mecaga from COMMENT join POST on COMMENT.id_postcomment=POST.id_post join USER on COMMENT.id_usercomment=USER.id_user WHERE id_post=id_postcomment order by post_time DESC;";
	$resc=mysqli_query($conexion,$querycom);
	$comm=mysqli_fetch_assoc($resc);
while($fila)
{
	echo $fila['username'];
	echo "<br/>";
	echo $fila['post_time'];
	echo "<br/>";
	echo $fila['post_text'];
	echo "<br/>";
	//Muestra primero las publicaciones y despues los comentarios, hay br para que se muestren los datos, pero se pueden quitar.
	while($comm)
	{
		echo $comm['username'];
		echo "<br/>";
		echo $comm['comment_text'];
		echo $comm['comment_time'];
		echo "<br/>";
		echo $comm['likes'];
		echo "<br/>";
		echo $comm['mecaga'];
		echo "<br/>";
		$comm=mysqli_fetch_assoc($resc);
	}
	$fila=mysqli_fetch_assoc($res);
}
session_unset();
echo "</table>
</body>
	</html>"
?>