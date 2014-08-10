<?php
	//Constantes de conexión a la base de datos
	define('server',"localhost");
	define('user',"usuario");
	define('pass',"usuario13");
	define('mainDatabase',"consultasphp");
	$errorDbConexion = false;
	function consultaUnidades($linkDB){
		$salida = '';
		$fechaAct= date("Y-m-d");
		//$fechaActm=date("Y-m-d")++;
		$consulta = $linkDB -> query("SELECT unidades.umarca, unidades.usubmarca,unidades.umodelo,unidades.uplacas,unidisp.idUnidisp,unidisp.udUnidad,unidisp.udFecha
									  FROM unidades inner join unidisp on unidisp.udUnidad = unidades.unoeconomico
									  WHERE udFecha BETWEEN '".$fechaAct++."' AND '".$fechaAct."'
									  ORDER BY unidisp.udFecha ASC
									  ");//ORDER BY unidisp.udFecha ASC ");//WHERE udFecha = \'2013-10-22\'");'".$fechaAct."' AND '".$fechaActm."'
		//Verificar la consulta	
		//$idUnidisp = $mysqli -> idUnidisp; 	
		if($consulta -> num_rows != 0) {
			//Leemos y lo convertimos en un objeto 'RecordSet'
			while($listadoOk = $consulta -> fetch_assoc())
			{
				$salida .= '
					<tr>
						<td>'.$listadoOk['udFecha'].'</td>
						<td>'.$listadoOk['udUnidad'].'</td>
						<td>'.$listadoOk['umarca'].'</td>
						<td>'.$listadoOk['usubmarca'].'</td>
						<td>'.$listadoOk['umodelo'].'</td>
						<td>'.$listadoOk['uplacas'].'</td>
	<td class="centerTXT"><a data-accion="editar" class="btn btn-info" href="'.$listadoOk['idUnidisp'].'">Editar</a> <a data-accion="eliminar" class="btn btn-danger" href="'.$listadoOk['idUnidisp'].'">Eliminar</a></td>
					
					</tr>
				';
			}
		}
		else
		{
			$salida = '
					<tr id="sinDatos">
						<td colspan="8" class="centerTXT">'.$fechaAct.' NO HAY REGISTROS EN LA BASE DE DATOS </td>
					</tr>
		';
		}
		return $salida;
	}
	//Verificamos la Conexión a la Base
	if(defined('server') && defined('user') && defined('pass') && defined('mainDatabase'))
{
	// Conexión con la base de datos
		$mysqli = new mysqli(server, user, pass, mainDatabase);
		// Verificamos si hay error al conectar
	if (mysqli_connect_error()) {
	    $errorDbConexion = true;
	}
	// Evitando problemas con acentos
	$mysqli -> query('SET NAMES "utf8"');
}
?>
