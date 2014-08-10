<?php
//Constantes para Conexión a la base de datos  
define('DBHOST','localhost');
define('DBUSER','usuario');
define('DBPASS','usuario13');
define('DBNAME','consultasphp');
$fechaAct= date("Y-m-d");
//Realizamos la conexión hacia la base de datos, agregando una función para la conexi{on
$conn = mysql_connect(DBHOST,DBUSER,DBPASS);
mysql_select_db(DBNAME,$conn);
//Verificar las variables POST
if(isset($_POST['rownum']))
{
	update_data($_POST['field'],$_POST['value'],$_POST['rownum']);
}
//Consulta de Datos'".$fechaAct."'
function get_data(){
	$sql = "SELECT unidisp.idUnidisp, unidisp.udFecha, unidisp.udProgrec, unidisp.udUnidad, unidisp,udNextel,unidisp.udNchofer, unidisp.udSalida, unidades.unoeconomico,unidades.uplacas,usuarios.idusuarios,usuarios.usnombre
									  FROM unidisp
									  INNER JOIN unidades ON unidisp.udUnidad = unoeconomico
									  LEFT JOIN usuarios ON unidisp.udNchofer = idusuarios
									  WHERE udFecha = '".$fechaAct."''
									  ORDER BY udProgrec";
	
	$rs=mysql_query($sql);
	return $rs;	
}
function update_data($field, $data, $rownum)
{
	$sql = "UPDATE unidisp set ".$field." = '".$data."' where idUnidisp = ".$rownum;
	mysql_query($sql) or die("No me pude conectar a la Base de Datos");
}

?>