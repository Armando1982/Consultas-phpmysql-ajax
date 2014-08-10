<?php
//1.-Variables de Sessión
session_start();
$usuario = $_POST['usuario'];
$contrasena = sha1($_POST['contrasena']);
//$contrasenasha1 = sha1($contrasena);
//echo $contrasenasha1 ;
//2.-Conexión a la Base de Dato
$conexion = mysql_connect("localhost","usuario","usuario13");
$dbase =  mysql_select_db("consultasphp");
$consulta = mysql_query("SELECT idusuarios,usnombre,usdepto,ustipo,uspass
						 FROM usuarios
						 WHERE ustatus='Alta' and idusuarios='".$usuario."'and uspass='".$contrasena."'");
//3.- verificar los resultados
while($fila = mysql_fetch_array($consulta))
{
	$usuariobd = $fila['idusuarios'];
	$contrasenabd = $fila['uspass'];
	$nombreemp = $fila['usnombre'];
	$usdeptobd = $fila['usdepto'];

	if($usuario == $usuariobd & $contrasena == $contrasenabd)
	{
		$_SESSION['usuario'] = $usuariobd;
		$_SESSION['contrasena'] = $contrasenabd;
		$_SESSION['usnombre'] = $nombreemp;
		$_SESSION['usdepto'] = $usdeptobd;
		
		switch($fila['usdepto'])
			{
				case 'PROGRAMACION':
					echo ' <html><head><meta http-equiv="refresh" content="0;url=progrec.php"></head></html>';
					break;
				case 'AUDITORIA':
					echo ' <html><head><meta http-equiv="refresh" content="0;url=menuprincipal.php"></head></html>';
					break;
				case 'CABINA':
					echo ' <html><head><meta http-equiv="refresh" content="0;url=progtra.php"></head></html>';
					break;
				case 'CONTABILIDAD':
					echo '<html><head><meta http-equiv="refresh" content="0;url=muestracargac.php"></head></html>';
					break;
				default:
					echo ' <html><head><meta http-equiv="refresh" content="0;url=salida.php"></head></html>';
					//break;
			}
		}else{
			//echo $usuariobd.$nombreemp.$usdeptobd;
			echo ' <html><head><meta http-equiv="refresh" content="0;url=salida.php"></head></html>';		
	}
}
$cierre = mysql_close($conexion);
?>