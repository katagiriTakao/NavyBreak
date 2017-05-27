<?php
 include("conexionMysql.php");
	session_start();
$id=$_COOKIE['id_user'];
echo " <!DOCTYPE html>
	<html lang='es'>
	<head>

		<title>Navy Break | Principal </title>
		<link href='http://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
		<link type='text/css' rel='stylesheet' href='../../styles/materialize/css/materialize.css'  media='screen,projection'/>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
		<script type='text/javascript' src='../javascript/jquery-3.2.1.js'></script>
		<meta charset='utf-8'>

	</head>
	<body class='light-blue lighten-5'>";
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
	echo "<nav>
			<div class='nav-wrapper light-blue lighten-3'>
				<a href='' class='brand-logo'>NavyBreak</a>
			</div>
		</nav>";
//Este query obtiene las publicaciones con username, el texto y el tiempo en que se realizo
	$querypub="select id_post,id_user,username,post_text,post_time from POST join USER on POST.id_userpost=USER.id_user order by post_time DESC;";
	$res=mysqli_query($conexion,$querypub);
	$fila=mysqli_fetch_assoc($res);
//Este otro query obtiene los comentarios; username, texto, tiempo, likes y mecaga que componen al comentario. EL WHERE SE ENCARGA DE ASEGURARSE DE QUE LOS COMENTARIOS SEAN DE LA PUBLICACION Y EVITAR QUE TODOS LOS COMENTARIOS DE TODAS LAS PUBLICACIONES ESTEN EN UNA PUBLICACION
	$querycom="select username,comment_text,comment_time,likes,mecaga from COMMENT join POST on COMMENT.id_postcomment=POST.id_post join USER on COMMENT.id_usercomment=USER.id_user WHERE id_post=id_postcomment order by post_time DESC;";
	$resc=mysqli_query($conexion,$querycom);
	$comm=mysqli_fetch_assoc($resc);
while($fila)
{
	
	echo "<div class='row'>
			<div class='col s12 m10 offset-m1'>
				<div id='post' class='card-panel light-blue accent-4'>";
	echo /*$fila['id_post'].*/" <h5 id='us-tim'><b>".$fila['username']."</b> <em>".$fila['post_time']."</em></h5>";
	echo "			<h4 id='post' class='card-panel light-blue accent-3'>".$fila['post_text']."</h4>
					<div id='reacc' class='card-panel light-blue accent-2'>
						<a class='waves-effect waves-light btn'><i class='material-icons left'>thumb_up</i>Like</a>
						<a class='waves-effect waves-light btn'><i class='material-icons left'>thumb_down</i>Dislike</a><br/><br/>
						New comment<br/><input type='text' id='new_comm'/>
					</div>";
	//echo $fila['id_user'];
	//Muestra primero las publicaciones y despues los comentarios, hay br para que se muestren los datos, pero se pueden quitar.
	while($comm)
	{
		echo "
					<div id='comment' class='card-panel light-blue accent-1'>
						<b id='us-com'>".$comm['username']."</b> <em id='tim-com'>".$comm['comment_time']."</em><br/>
						<p id='txt-com'>".$comm['comment_text']."</p>
					</div>
				</div>
			</div>
		</div>";
		//echo .$comm['likes'].;
		//echo .$comm['mecaga'].;
		$comm=mysqli_fetch_assoc($resc);
	}
	echo "<button class='chall'>Challenge</button><br/>";
	$fila=mysqli_fetch_assoc($res);
}
echo "</table>
<script>

		$('.chall').click(function(){

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