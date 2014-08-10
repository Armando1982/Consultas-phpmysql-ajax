<title>**Programa de Recolección**</title>
<?php
	//Constantes de conexión a la base de datos
	define('server',"localhost");
	define('user',"usuario");
	define('pass',"usuario13");
	define('mainDatabase',"consultasphp");
	$errorDbConexion = false;
	function consultaProgramas($linkDB){
		$salida = '';
		$fechaAct= date("Y-m-d");
		$consulta = $linkDB -> query("SELECT unidisp.idUnidisp, unidisp.udFecha, unidisp.udProgrec, unidisp.udUnidad,unidisp.udNchofer,unidisp.udSalida, unidades.unoeconomico,unidades.uplacas,usuarios.usnombre
									  FROM unidisp
									  INNER JOIN unidades ON unidisp.udUnidad = unoeconomico
									  LEFT JOIN usuarios ON unidisp.udNChofer = idusuarios
  									  WHERE udFecha = '".$fechaAct."'
									  ORDER BY udProgrec
		
		");
		if($consulta -> num_rows != 0) {
			//Leemos y lo convertimos en un objeto 'RecordSet'
			while($listadoOk = $consulta -> fetch_assoc())
			{
				$salida .= '
					<tr>			
						<td align="right">'.$listadoOk['udFecha'].'</td>
						<td class="edit udProgrec '.$listadoOk['idUnidisp'].'" title="Click para Editar">'.$listadoOk['udProgrec'].'</td>
						<td align="right">'.$listadoOk['udUnidad'].'</td>
						<td>'.$listadoOk['uplacas'].'</td>
						<td class="edit udNchofer '.$listadoOk['idUnidisp'].'" title="Click para Editar">'.$listadoOk['usnombre'].'</td>
						<td  align="right" class="edit udSalida '.$listadoOk['idUnidisp'].'" title="Click para Editar">'.$listadoOk['udSalida'].'</td>
				';
			}
		}
		else
		{
			$salida = '
					<tr id="sinDatos">
						<td colspan="9" class="centerTXT">'.$fechaAct.' NO HAY REGISTROS EN LA BASE DE DATOS </td>
					</tr>
		';
		}
		return $salida;
	}
	//Verificamos la Conexión a la Base
	if(defined('server') && defined('user') && defined('pass') && defined('mainDatabase')){
	// Conexión con la base de datos
		$mysqli = new mysqli(server, user, pass, mainDatabase);
		// Verificamos si hay error al conectar
	if (mysqli_connect_error()){
	    $errorDbConexion = true;
	}
	// Evitando problemas con acentos
	$mysqli -> query('SET NAMES "utf8"');
}
?>
