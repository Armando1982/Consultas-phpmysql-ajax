<?php
//sleep(1);
$respuestaOk = false;
$mensajeError = "No se puede ejecutar la aplicación ";
$contenidoOk = "";
$fechaAct= date("Y-m-d");
//$fechaActm=$fechaAct++;
//se incluye el archivo de la conexion
include('mainFunctionsa.inc.php');
// validamos la conexion
if($errorDbConexion == false){
	//Variables POST
	if(isset($_POST) && !empty ($_POST)){
		switch($_POST['udAction']){
			case 'addUnidad':
				$query = sprintf("INSERT INTO unidisp SET udFecha = '%s', udUnidad = '%s'", $_POST['udFecha'],$_POST['udUnidad']);
				$consultaU = "SELECT unidades.umarca, unidades.usubmarca,unidades.umodelo,unidades.uplacas,unidisp.idUnidisp,unidisp.udUnidad,unidisp.udFecha
						   		FROM unidades inner join unidisp on unidisp.udUnidad = unidades.unoeconomico
						   		WHERE udUnidad ='".$_POST['udUnidad']."' AND unidisp.udFecha BETWEEN '".$fechaAct++."' AND '".$fechaAct."'";// '".$fechaAct."' AND '".$fechaActm."'";//'".$fechaAct."'='".$_POST['udFecha']."' AND ";
			   $resultadoQuery = $mysqli -> query($query);
			   $resultado = $mysqli -> query($consultaU);
			  // $idUnidisp = $mysqli -> idUnidisp; 
				if($resultadoQuery == true ){
						$fila = $resultado -> fetch_assoc();
						$respuestaOk = true;
						$mensajeError = "Se ha agregado el contenido Correctamente";
						$contenidoOk ='
								<tr>
									<td>'.$_POST['udFecha'].'</td>
									<td>'.$_POST['udUnidad'].'</td>
									<td>'.$fila['umarca'].'</td>
									<td>'.$fila['usubmarca'].'</td>
									<td>'.$fila['umodelo'].'</td>
									<td>'.$fila['uplacas'].'</td>
<td class="centerTXT"><a data-accion="editar" class="btn btn-mini btn-info" href="'.$fila['idUnidisp'].'">Editar</a> <a data-accion="eliminar" class="btn btn-mini btn-danger" href="'.$fila['idUnidisp'].'">Eliminar</a></td>
								</tr>
						';
						$resultado -> close();
//					$mysqli -> close();
					}
					else{
						$mensajeError = "No se ha podido guardar el registro";
					}
			break;
			case 'editUnidad':
			//Armado de Campos
				$query = sprintf("UPDATE unidisp 
								  SET udFecha='%s', udUnidad='%s' 
					     		  WHERE idUnidisp='%s' LIMIT 1", $_POST['udFecha'],$_POST['udUnidad'],$_POST['idUnidisp']);
				// Ejecutamos el query
				$resultadoQuery = $mysqli -> query($query);
				// Validamos que se haya actualizado el registro
				if($mysqli -> affected_rows == 1){
					$respuestaOk = true;
					$mensajeError = 'Se ha actualizado el registro correctamente';
					$contenidoOk = consultaUnidades($mysqli);
				}else{
					$mensajeError = 'No se ha actualizado el registro';
				}	
			break;
			case 'eliminar':
				$query = sprintf("DELETE FROM unidisp
								 WHERE idUnidisp=%d LIMIT 1",
								 $_POST['idUnidisp']);

				// Ejecutamos el query
				$resultadoQuery = $mysqli -> query($query);

				// Validamos que se haya actualizado el registro
				if($mysqli -> affected_rows == 1){
					$respuestaOk = true;
					$mensajeError = 'Se ha eliminado el registro correctamente';

					$contenidoOk = consultaUnidades($mysqli);

				}else{
					$mensajeError = 'No se ha eliminado el registro';
				}
			break;
			default: $mensajeError = 'Esta accion no se encuentra disponible';
			break;
		}
	}
	else{
//		$respuestaOk=false;
		$mensajeError= 'No se puede ejecutar la aplicacion';
	}
}
else{
//	$respuestaOk=false;
	$mensajeError= 'No se ha podido realizar la conexión a la base de datos';
}
 
//Se arma el mensaje json
$salidaJson = array("respuesta" => $respuestaOk,
					"mensaje" => $mensajeError,
					"contenido"=> $contenidoOk);
echo json_encode($salidaJson);
?>