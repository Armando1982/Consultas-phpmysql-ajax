// JavaScript Document
//Variables Globales
var idUnidisp_ok = 0;
var udAction_ok = 'noAction';
//var f = new Date();

/*$(document).ajaxStop(function(){
    window.location.reload();
});*/

	$(function(){
		// creación de ventana con formulario con jquery ui
		$('#agregaUnidad').dialog({
			autoOpen: false,
			modal:true,
			width:305,
			height:'auto',
			resizable: false,
			close:function(){
				$('#formUnidades fieldset > span').removeClass('error').empty();
				$('#udUnidad').val('');
		    	$('#udFecha').val('');
				$('#idUnidisp').val('0');
//				$('#agregaUnidad').dialog({title:''});
			}
		});
		
		//Dialogo Borrar
			$('#dialog-borrar').dialog({
				autoOpen:false,
				modal:true,
				width:305,
				height:'auto',
				resizable:false,
			buttons: {
				Si: function() {
					$.ajax({
		            beforeSend: function(){
		            },
		            cache: false,
		            type: "POST",
		            dataType: "json",
		            url:"includes/phpAjaxUnidades.inc.php",
		            data:"udAction=" + udAction_ok + "&idUnidisp=" + idUnidisp_ok + "&id=" + Math.random(),
		            success: function(response){

		            	// Validar mensaje de error
		            	if(response.respuesta == false){
		            		alert(response.mensaje);
					 	}
		            	else{
		            		// si es exitosa la operación
		                	$('#dialog-borrar').dialog('close');
		                	$('#listaUnidadesOk').empty();		                	
		                	$('#listaUnidadesOk').append(response.contenido);
						}
		            },
		            error:function(){
		                alert('ERROR GENERAL DEL SISTEMA, INTENTE MAS TARDE');
		            }
		        });	
				},
				No: function() {
					$( this ).dialog( "close" );
				}
			}
		});

		// funcionalidad del botón que abre el formulario
		$('#goNuevaUnidad').on('click',function(){
			$('#udAction').val('addUnidad');
			//$('#udFecha').val(f.getDate()+"/"+(f.getMonth()+ "/"+ (f.getFullYear())));
			$('#agregaUnidad').dialog({
				title:'Agregar Unidad',
				autoOpen:true
			});
		});

		// Validar Formulario
		$('#formUnidades').validate({
		    submitHandler: function(){
		        var str = $('#formUnidades').serialize();
		        //alert(str);
				$.ajax({
					beforeSend: function(){
						$('#ajaxLoader').show();
					},
					cache:false,
					type:"POST",
					dataType:"json",
					url:"includes/phpAjaxUnidades.inc.php",
					data:str + "&id=" + Math.random(),
					success:function(response){
						//Validar mensaje
						if(response.respuesta == false){
							alert(response.mensaje)
						}
						else{						
						$('#agregaUnidad').dialog('close');
						//alert(response.contenido)	
							if($('#sinDatos').length){
								$('#sinDatos').remove();
							}
								if ($('#udAction').val() == 'editUnidad'){
									$('#listaUnidadesOk').empty();
							}
							$('#listaUnidadesOk').append(response.contenido);
							$('#listaUnidadesOka').append(response.contenido);
						}
						$('#ajaxLoader').hide();
					},
					error:function(){
						alert('ERROR GENERAL DEL SISTEMA, INTENTE MAS TARDE');
					}
				});	
		        return false;

		    },
		    errorPlacement: function(error, element) {
		        error.appendTo(element.prev("span").append());
		    }
		});
	
	//Edición de Registros
		$('body').on('click','#listaUnidadesOk a',function(e){
			e.preventDefault(); //NO se ejecutará automaticamente
			//alert($(this).attr('href'));
			
			//Valor de la accion
			idUnidisp_ok = $(this).attr('href');
			udAction_ok = $(this).attr('data-accion');
			//$('#idUnidisp').val(idUnidisp_ok); //2014/28/07
			
			if(udAction_ok =='agregar'){
			alert("idunidades:"+idUnidisp_ok+"Accion:"+udAction_ok); //2014/28/07
			}
			
			
			if (udAction_ok == 'editar'){			
				$('#udAction').val('editUnidad');
				// id de Unidad Registrada
				$('#idUnidisp').val($(this).attr('href'));
				//$('#agregaUnidad').dialog('open');
				// Enlistar los valores de la tabla para modificar
				$('#udFecha').val($(this).parent().parent().children('td:eq(0)').text());
				$('#udUnidad').val($(this).parent().parent().children('td:eq(1)').text());
				$('#agregaUnidad').dialog({
					title:'Editar Unidad',
					autoOpen:true
				});
			} else if ($(this).attr('data-accion') == 'eliminar'){
				$('#dialog-borrar').dialog('open');
			}

		});
	
	});
