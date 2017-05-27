<?php
 include("conexionMysql.php");
	session_start();
$id=$_COOKIE['id_user'];
echo " <!DOCTYPE html>
	<html lang='es'>
	<head>
		<meta charset='UTF-8'/>
		<title>Publicaciones</title>
		<script type='text/javascript' src='../javascript/jquery-3.2.1.js'></script>
	</head>
	<body>";
$conexion=mysqli_connect('localhost','root','','NavyBreak');
if(isset($_POST['logout']))
{
	setcookie('usuario',$id,time()-259200,"/");
}
//OJO: PARA SUBIR PUBLICAIONES Y COMENTARIOS, ALGUNOS DATOS SE TENDRAN QUE ENVIAR QUE ENVIAR POR METODO POST CON UN CIERTO NOMBRE, INCLUSO ALGUNOS DEBERAN SER HIDDEN, SI LO CREEN NECESARIO.
if(isset($_POST['comment']))
{
	$idcom=0;
	$idpost=$_POST['post'];
	$idus=$_POST['user'];
	$com=$_POST['comme'];
	$comti=date();
	$likes=0;
	$mecaga=0;
	$verificar_id_com=mysqli_query($conexion, "SELECT * FROM COMMENT WHERE id_comment='$idcom'");
	while(mysqli_num_rows($verificar_id_com)>0)
		$idcom++;
	//Inserta publicaciones a Base de datos
	$coma="INSERT INTO COMMENT(id_comment,id_postcoment,id_usercomment,comment_text,comment_time,likes,mecaga) VALUES ('$idcom','$idpost','$idus','$com','$comti','$likes','$mecaga')";
	$sub=mysqli_query($conexion,$coma);
}
if (isset($_POST['public']))
{
	$idpos=0;
	$idus=$_POST['user'];
	$pub=$_POST['public'];
	$pubti=date();
	$verificar_id_post=mysqli_query($conexion, "SELECT * FROM POST WHERE id_post='$idpos'");
	while(mysqli_num_rows($verificar_id_post)>0)
		$idpos++;
	//Inserta publicaciones a Base de datos
	$publ="INSERT INTO POST(id_post,id_userpost,post_text,post_time) VALUES ('$idpos','$idus','$pub','$pubti')";
	$sub1=mysqli_query($conexion,$publ);
}
if(isset($_POST['likes']))
{
	$idcom=$_POST['idcom'];
	$idpost=$_POST['post'];
	$idus=$_POST['user'];
	$com=$_POST['comme'];
	$comti=date();
	$likes=$_POST['likes'];
	$mecaga=$_POST['mecaga'];
	$verificar_likes=mysqli_query($conexion, "SELECT * FROM COMMENT WHERE id_postcomment='$idpost' AND likes='$likes';");
	while(mysqli_num_rows($verificar_likes)>0)
		$likes++;
	//Inserta publicaciones a Base de datos
	$coma="INSERT INTO COMMENT(id_comment,id_postcoment,id_usercomment,comment_text,comment_time,likes,mecaga) VALUES ('$idcom','$idpost','$idus','$com','$comti','$likes','$mecaga')";
	$sub=mysqli_query($conexion,$coma);
}
if(isset($_POST['mecaga']))
{
	$idcom=$_POST['idcom'];
	$idpost=$_POST['post'];
	$idus=$_POST['user'];
	$com=$_POST['comme'];
	$comti=date();
	$likes=$_POST['likes'];
	$mecaga=$_POST['mecaga'];
	$verificar_mecaga=mysqli_query($conexion, "SELECT * FROM COMMENT WHERE id_postcomment='$idpost' AND mecaga='$mecaga';");
	while(mysqli_num_rows($verificar_mecaga)>0)
		$mecaga++;
	//Inserta publicaciones a Base de datos
	$coma="INSERT INTO COMMENT(id_comment,id_postcoment,id_usercomment,comment_text,comment_time,likes,mecaga) VALUES ('$idcom','$idpost','$idus','$com','$comti','$likes','$mecaga')";
	$sub=mysqli_query($conexion,$coma);
}
echo "<table>";
//Este query obtiene las publicaciones con username, el texto y el tiempo en que se realizo
	$querypub="select id_post,id_user,username,post_text,post_time from POST join USER on POST.id_userpost=USER.id_user where id_user='$id'order by post_time DESC;";
	$res=mysqli_query($conexion,$querypub);
	$fila=mysqli_fetch_assoc($res);
//Este otro query obtiene los comentarios; username, texto, tiempo, likes y mecaga que componen al comentario. EL WHERE SE ENCARGA DE ASEGURARSE DE QUE LOS COMENTARIOS SEAN DE LA PUBLICACION Y EVITAR QUE TODOS LOS COMENTARIOS DE TODAS LAS PUBLICACIONES ESTEN EN UNA PUBLICACION
	$querycom="select username,comment_text,comment_time,likes,mecaga from COMMENT join POST on COMMENT.id_postcomment=POST.id_post join USER on COMMENT.id_usercomment=USER.id_user WHERE id_post=id_postcomment AND id_user='$id'order by post_time DESC;";
	$resc=mysqli_query($conexion,$querycom);
	$comm=mysqli_fetch_assoc($resc);
while($fila)
{
	echo $fila['id_post'];
	echo $fila['username'];
	echo "<br/>";
	echo $fila['id_user'];
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
	echo "<button id='chall'>Challenge</button><br/>";
	$fila=mysqli_fetch_assoc($res);
}
echo "</table>
<script>
		$('#chall').click(function(){

			var duel='yes';
			var challenger=id_user;
			console.log(duel+'  '+challenger);
			$(this).unbind();
			$(this).html('CHALLENGE SENT');
		});
		$.ajax({

			type:'POST',
			url:'../programs/php/chall.php',
			data:'duel'+'challenger',
			success:function(duel,challenger){
       								console.log('success');
       							}
		});
		</script>
</body>
	</html>";
	session_unset();
?>