<?php

	$connect=mysqli_connect("localhost","root","","NavyBreak");
	$nom=$_POST['Nombre'];
	$nac=$_POST['Fecha_nac'];
	$correo=$_POST['Correo'];
	$usu=$_POST['Usuario'];
	$contra=$_POST['Clave'];
	//Validaciones
	$valida = array('Nombre' => '/^[A-ZÑÁÉÍÓÚÜ][a-zñáéíóúü].*$/','Fecha_nac' => '/\d{4}([\-/.])(0?[1-9]|1[1-2])\1(3[01]|[12][0-9]|0?[1-9])$/','Correo' => '/(?=\w.*@)^.*(comunidad|gmail|outlook|live|hotmail)\.com$/','Usuario' => '/^(.*[A-ZÑ]|.*[a-zñ]|.*\W|.*\d).{1,}$/','Clave' => '/^(?=.*[A-ZÑ]{1}).*(?=.*[a-zñ]{1}).*(?=.*\W{1}).*(?=.*\d{1}).*[^\s]{8,}$/');
	//Insertar a la base
	$insertar="INSERT INTO USUARIOS(Nombre,Fecha_Nac,Correo,Usuario,Contra) VALUES ('$nom','nac','$correo','$usu','$contra')";
	//Validacion de datos
	foreach ($valida as $Jo => $sec) 
	{	
		$sec[1]=preg_match($sec, $_POST[$Jo]);
		if ($sec[1]!=1) 
		{
			echo '<script> 
				alert('.$Jo.' inválido);
				</script>';
			exit;
		}
	}
	//Esta parte es para que cheque si ya hay un usuario con el mismo nombre y entonces no lo vuelvaa registrar
	$verificar_usuario=mysqli_query($connect, "SELECT * FROM USUARIOS WHERE usuario='$usu'");
	if(mysqli_num_rows($verificar_usuario)>0)
	{
		echo '<script> 
				alert("El usuario ya esta registrado");
				</script>';
		exit;
	}	
	//Ejecutar consulta
	$res=mysqli_query($connect,$insertar);
	
	if(!$res)
	{
		echo "Error al registrarse";
	}
	else
	{
		echo 
		'<script> alert("Usuario registrado");</script>';
	}
	mysqli_close($connect);

?>