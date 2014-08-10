<?php
session_start();// variables de session
$usuario = $_SESSION['usuario'];
$nombreu = $_SESSION['usnombre'];
$depto = $_SESSION['usdepto'];

include('includes/mainFunctionsa.inc.php');

if($errorDbConexion == false){
	// Manda a llamar la función para mostrar la lista de usuarios
	$consultaUnidades = consultaUnidades($mysqli);
}else{
	// Regresa error en la base de datos
	$consultaUnidades = '
		<tr id="sinDatos">
			<td colspan="7" class="centerTXT">ERROR AL CONECTAR CON LA BASE DE DATOS</td>
	   	</tr>
	';
}
?>
<!doctype html>
<html lang="ES">
<head>
<meta charset="utf-8">
<title>**Programación de Unidades**</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link type="text/css" href="css/redmond/jquery-ui-1.9.2.custom.css" rel="stylesheet">
<link type="text/css" href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
<link type="text/css" href="css/master.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery_ui/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="js/jquery_ui/jquery-ui-1.8.23.custom.min.js"></script>
<script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery-validation-1.10.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/jquery-validation-1.10.0/jquery.metadata.js"></script>
<script type="text/javascript" src="js/jquery-validation-1.10.0/localization/messages_es.js"></script>
<script type="text/javascript" src="js/mainJavaScripta.js"></script>
<script type="text/javascript">
$(function() {
	$('#tabs').tabs();
});
</script>
</head>
<body>
<header><h3>Alta de Unidades</h3></header>

<br />
<div class="hide" id="agregaUnidad" title="Agregar Unidad">
	<form action="" method="post" id="formUnidades" name="formUnidades">
    	<fieldset id="ocultos">
        	<input type="hidden" value="addUnidad" id="udAction" name="udAction" class="{required:true} span3"/>
            <input type="hidden" value="0" id="idUnidisp" name="idUnidisp"  class="{required:true} span3"/>
        </fieldset>
        <fieldset id="datosUnidad">
        	<p>Fecha</p>
            <span></span>
        	<input type="date" name="udFecha" id="udFecha" class="{required:true} span3"/>
            <p>Unidad</p>
            <span></span>
            <select name="udUnidad" id="udUnidad" class="{required:true} span3">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
            
            </select>
           	<!--<input type="number" name="udUnidad" id="udUnidad" class="{required:true} span3"/>-->
        <!--</fieldset>-->
        <fieldset id="btnAgregar" style="text-align:center">
            	<input type="submit" id="continuar" value="Agregar" />
        </fieldset>
        <fieldset id="ajaxLoader" style="text-align:center" class="ajaxLoader hide">
        	<img src="images/default-loader.gif">
            <span>Espere un momento Porfavor...</span>
        </fieldset>
    </form>

</div>
<div id="dialog-borrar" title="Eliminar Registro" class="hide">
	<p><span class="ui-icon ui-icon-alert" style="float:left: margin: 0 7px 20 px 0:"></span>Este Registro se eliminará Permanentemente</p>
</div>
<div align="right" class="alert-info"><table><tr><td>Usuario:</td><td><?php echo $nombreu ?><br /></td></tr><tr><td>Depto:</td><td><?php echo $depto ?></td></tr><tr><td>&nbsp;</td><td align="right"><a class="btn btn-mini btn-info" href="salida.php">Cerrar Sessión</a></td></tr></table></div>
<br />
<div id="tabs">
	<ul>
    	<li><a href="#tabs-1">Disposición de Unidades</a></li>
    </ul>   
   <div id="tabs-1">
    <div id="wraper">
    	<section id="contenido">
        	<div id="btnAgregar" class="center addUser">
            	<button id="goNuevaUnidad" class="btn btn-warning"><i class="icon-plus"></i>Agrega Unidad</button>
            </div>
            <div id="" class="centraDiv">
            	<table id="listadoUnidades" class="table table-striped table-bordered table-hover table-condensed">
                	<thead>
                    	<tr>
                        	<th>Fecha</th>
                            <th>Unidad</th>
                            <th>Marca</th>
                            <th>Submarca</th>
                            <th>Modelo</th>
                            <th>Placas</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                        <tbody id="listaUnidadesOk">
								<?php echo $consultaUnidades?>
                        </tbody>                   
                </table>
            </div>        	
        </section>
    </div>
    </div>
</div>
<footer>Powered Desarrollo 2013</footer>
</body>
</html>