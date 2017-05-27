<?php
	$myarr=($_POST['encapsulado']);
		$lugar= json_decode($myarr);
		echo($lugar);
	include("conexionMysql.php");
	$conexion=mysqli_connect("localhost","root","","NavyBreak");
	$idgame=$_POST['id_game'];
	$id1=$_COOKIE['id_user'];
	$id2=$_POST['id_user2'];
	$cooosh1=$_POST['coo1'];
	$ponepoints=$_POST['ponepoints'];
	$cooosh2=$_POST['coo2'];
	$ptwopoints=$_POST['ptwopoints'];
	//Insertar a la base
	$insertar="INSERT INTO CGAME(id_game,id_userone,id_usertwo,cooshone,pone_points,cooshtwo,ptwo_points) VALUES ('$idgame','$id1','$id2','$cooosh1','$ponepoints','$cooshtwo','$ptwopoints')";
	//Ejecutar consulta
	$res=mysqli_query($conexion,$insertar);
	
	if(!$res)
	{
		echo "Error al enviar datos";
	}
	else
	{
		echo 
		'Datos enviados';
	}
	mysqli_close($conexion);
?>