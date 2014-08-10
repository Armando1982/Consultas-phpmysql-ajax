<?php
session_start();
$usuario = $_SESSION['usuario'];
$nombreu = $_SESSION['usnombre'];
$depto = $_SESSION['usdepto'];
// Incluimos nustro script php de funciones y conexión a la base de datos
include('includes/mainfunctionsp.inc.php');
include('includes/functionsp.php');
if($errorDbConexion == false){
	// MAnda a llamar la función para mostrar la lista de usuarios
	$consultaProgramas = consultaProgramas($mysqli);
}
else
{
	// Regresa error en la base de datos
	$consultaUnidades = '
		<tr id="sinDatos">
			<td colspan="9" class="centerTXT">ERROR AL CONECTAR CON LA BASE DE DATOS</td>
	   	</tr>
	';
}
?>
<!doctype html>
<html lang="ES">
<head>
<meta charset="utf-8">
<title>**Programar la Recolección**</title>
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
<script type="text/javascript">
$(function() {
	$('#tabs').tabs();
});
</script>
<script>
$(document).ready(function(){				
		$('td.edit').click(function(){
		$('.ajax').html($('.ajax input').val());
		$('.ajax').removeClass('ajax');		
		$(this).addClass('ajax');
		$(this).html('<input id="editbox" size="'+$(this).text().length+'" type="text" value="' + $(this).text() + '">');
		$('#editbox').focus();
	});			  
		$('td.edit').keydown(function(event){							  
			 arr = $(this).attr('class').split( " " ); 
		 
		 if(event.which == 13) { 
			$.ajax({
				type: "POST",
				url:"includes/functionsp.php",
				data: "value="+$('.ajax input').val()+"&rownum="+arr[2]+"&field="+arr[1],
				success: function(data){
					 $('.ajax').html($('.ajax input').val());
					 $('.ajax').removeClass('ajax');
						}});
		 } 
	  }
						 
	 );	
		$('#editbox').live('blur',function(){
					 $('.ajax').html($('.ajax input').val());
					 $('.ajax').removeClass('ajax');
					 $('#listaPtogramasOk').append(response.contenido);
		});
				
	});

</script>
</head>
<header>Asignación de Operador</header>
<body>
<br>
<div align="right" class="alert-info"><table><tr><td>Usuario:</td><td><?php echo $nombreu ?><br /></td></tr><tr><td>Depto:</td><td><?php echo $depto ?></td></tr><tr><td>&nbsp;</td><td align="right"><a class="btn btn-mini btn-info" href="salida.php">Cerrar Sessión</a></td></tr></table></div>
<br />
<div id="tabs">
	<ul>
    	<li><a href="#tabs-1">Programación de Hoy</a></li>
    </ul>
    <div id="tabs-1">
	<div id="wrapera">
    	<section id="contenido">
            <div id="" class="centraDiv">
            	<table id="listadoProgramas" class="table table-striped table-bordered table-hover">
                	<thead>
                    	<tr>
                        	<th>Fecha de Salida</th>
                            <th>Orden de Salida</th>
                            <th>Unidad</th>
                            <th>Placas</th>
                            <th>Chofer</th>
                            <th>Salida</th>
                        </tr>
                    </thead>    
                        <tbody id="listaProgramasOk">
							<?php echo $consultaProgramas?>
                        </tbody>
                </table>
            </div>        	
        </section>
        </div>
        </div>
</div>
</body>
<footer>
	Powered Desarrollo 2013
</footer>
</html>