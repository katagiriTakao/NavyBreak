<?php
 include("conexionMysql.php");
	$conexion=mysqli_connect("localhost","root","","NavyBreak");
	$id_us=0;
	$usu=$_POST['username'];
	$contra=$_POST['password'];
	$nom=$_POST['name'];
	$nac=$_POST['b_day'];
	$correo=$_POST['email'];
	$games=0;
	//Validaciones
	$valida = array('username' => '/^(.*[A-ZÑ]|.*[a-zñ]|.*\W|.*\d).{1,}$/','password' => '/^(?=.*[A-ZÑ]{1}).*(?=.*[a-zñ]{1}).*(?=.*\W{1}).*(?=.*\d{1}).*[^\s]{8,}$/','name' => '/^[A-ZÑÁÉÍÓÚÜ][a-zñáéíóúü].*$/','b_day' => '/\d{4}([\-/.])(0?[1-9]|1[1-2])\1(3[01]|[12][0-9]|0?[1-9])$/','email' => '/(?=\w.*@)^.*(comunidad|gmail|outlook|live|hotmail)\.com$/');
	$verificar_id_usuario=mysqli_query($conexion, "SELECT * FROM USER WHERE id_user='$id_us'");
	if(mysqli_num_rows($verificar_id_usuario)>0)
		$id_us++;	
	//Insertar a la base
	$insertar="INSERT INTO USER(id_user,username,password,rname,b_day,email,wgames) VALUES ('$id_us','$usu','$contra','$nom','$nac','$correo','$games')";
	//Validacion de datos
	foreach ($valida as $Jo => $sec) 
	{	
		if(!$_POST['Clave1'])
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
	}
	//Cocinamos
	$contra="S@7r0".$contra."p1M3^|RO";
	//Esta parte es para que cheque si ya hay un usuario con el mismo nombre y entonces no lo vuelvaa registrar
	$verificar_usuario=mysqli_query($conexion, "SELECT * FROM USER WHERE username='$usu'");
	if(mysqli_num_rows($verificar_usuario)>0)
	{
		echo '<script> 
				alert("El usuario ya esta registrado");
				</script>';
		exit;
	}	
	//Ejecutar consulta
	$res=mysqli_query($conexion,$insertar);
	
	if(!$res)
	{
		echo "Error al registrarse";
	}
	else
	{
		echo 
		'<script> alert("Usuario registrado");</script>';
	}
	mysqli_close($conexion);

?>