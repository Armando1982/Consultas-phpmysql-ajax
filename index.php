<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>:Integración de Operaciones Recolección:</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link type="text/css" href="css/redmond/jquery-ui-1.9.2.custom.css" rel="stylesheet">
<link type="text/css" href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
<link type="text/css" href="css/master.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery_ui/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="js/jquery_ui/jquery-ui-1.8.23.custom.min.js"></script>
<script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
</head>
<?php
session_start();
if(isset($_SESSION['usnombre']) && ($_SESSION['usdepto']))
	{
		switch($_SESSION['usdepto'])
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
					default:
					echo '
							<header></header>
							<br />
							<div id="wraperi">
							<div>
							<form action="login.php" method="post">
								<fieldset>
									<legend>Ingreso a Sistema</legend>
								<label for="usuario">Usuario:</label>
									<input type="text" value="usuario:" name="usuario" placeholder="Número de Empleado">
									<span></span>
								<label for="contrasena">Contraseña:</label>
									<input type="password" name="contrasena" placeholder="contraseña">
									<span></span><br />
									<input type="submit" value="Ingresar" class="btn-success">
								</fieldset>
								<!--Dentro del Case-->
							</form>
							</div>
							</div>
							<footer>Powered by Armando Acosta</footer>';
					break;
					
			}// termina el select
			}else{
					echo ' 
							<header></header>
							<br />
							<div id="wraperi">
							<div>
							<form action="login.php" method="post" class="well">
								<fieldset>
								<legend>Ingreso al Sistema</legend>
								<label for="usuario">Usuario:</label>
									<input type="text" name="usuario" placeholder="Número de Empleado">
									<span></span>
								<label for="contrasena">Contraseña:</label>
									<input type="password" name="contrasena" placeholder="Contraseña">
									<span></span><br />
									<input type="submit" value="Ingresar" class="btn-success">
								</fieldset>
							</form>
							<!--Dentro del If-->
							</div>
							</div>
							<footer>Powered by Armando Acosta</footer>
					';
			}

						
?>
<body>
</body>
</html>