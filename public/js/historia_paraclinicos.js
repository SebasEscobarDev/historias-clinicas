$(document).ready(function(){
	console.log('historia_paraclinicos v0.1')
	init_paraclinicos()
})

function init_paraclinicos(){
	var host = window.location.hostname
	$('#guardar_paraclinico').click(function(){
			var valido_campos = 0
			$('#paraclinicos input, #paraclinicos textarea').each(function(){
				if( $(this).val() == 0 || $(this).val() == '' ){
					var ide = $(this).attr('id')
					valido_campos = 1
					$('#'+ide).css('border-bottom', '1.5px solid red')
          $('#'+ide).parent('.input-field').append('<span class="request-input">*Requerido</span>')
				}
			})

			$('#paraclinicos select').each(function(){
				if( $(this).val() == 0 || $(this).val() == '' ){
					var ide = $(this).attr('id')
					valido_campos = 1
					$('#'+ide).parent('.select-wrapper').children('input').css('border-bottom', '1.5px solid red')
          $('#'+ide).parent('.select-wrapper').append('<span class="request-input">*Requerido</span>')
				}
			})

			//si ningun input es vacio envio
			if( valido_campos == 0 ){
				//GUARDAR NUEVA ORDEN
				save_paraclinico(host, $('#historia_id').val() )
			}else{
				M.toast({
	        html: 'Hay campos sin llenar para la formula!', 
	        classes: 'toast-error'
	      });
			}

		})
}

//id	historia_id	td	solicitud	fecha	entidad	profesional_medico	diagnosticos
//capturar información y guardar paraclinico
function save_paraclinico(host, historia_id){
	
	var paraclinico = {
		historia_id: historia_id,
		td: $('#p_td').val(),
		solicitud: $('#solicitud').val(),
		fecha: $('#p_fecha').val(),
		entidad: $('#p_entidad').val(),
		profesional_medico: $('#p_profesional_medico').val(),
		diagnosticos: $('#diagnosticos').val() 
	}
	
	//enviar contenido ajax al controlador Historia Paraclinicos para crear
  $.ajaxSetup({
    headers: {
    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: "http://"+host+"/paraclinicos/crear",
    method: 'post',
    data: {
    	paraclinico:paraclinico
    },
    success: function(result){

      if( result.error ){
        M.toast({html: result.msg, classes: 'toast-error'});
      }

      if( result.yes ){
        M.toast({html: result.yes, classes: 'toast-success'});
      }

      if( result.paraclinico ){
        //AGREGAR DATOS DE ORDEN EN MODAL DE CONSULTAS

				//push_content_html_in_modal( 'paraclinicos', '#js-paraclinicos-lista-fechas', '#js-paraclinicos-lista-formulas', result)
				//function push_content_html_in_modal( vista, tabla3, tabla4, result ){
	      //AGREGAR DATOS DE ORDEN EN MODAL DE CONSULTAS
	      //result.paraclinico.historia_id
	      var fecha_formula = ''+
	        '<tr class="row ver-formula-paciente" data-orden="'+result.paraclinico.id+'" style="margin-bottom: 0px;">'+
	          '<td class="col-md-4" style="padding-left:36px; padding-bottom:7px;padding-top:7px;">'+result.paraclinico.solicitud+'</td>'+
	          '<td class="col-md-8 text-center" style="padding-left:0px; padding-bottom:7px;padding-top:7px;">'+result.paraclinico.fecha+'</td>'+
	        '</tr>';
	      $('#js-paraclinicos-lista-fechas').append(fecha_formula)

	      var content_formula = ''+
	        '<tr class="row" data-detalle-orden="'+result.paraclinico.id+'" style="margin-bottom: 0px;">'+
	          '<td class="col-md-12 text-center blue darken-2 text-white" style="padding:0px">'+
	            '<h5 style="padding-top:7px;">Entidad: '+result.paraclinico.entidad.nombre+'</h5>'+
	          '</td>'+
	          '<td class="col-md-12" style="padding-bottom:0px">'+
	            '<div class="row" style="margin-bottom: 0px;">'+
	              '<div class="col-md-3">'+
	                '<b>Formula:<br></b> '+result.paraclinico.solicitud+'<br>'+
	              '</div>'+
	              '<div class="col-md-3">'+
	                '<b>Fecha:</b> <br>'+result.paraclinico.fecha+
	              '</div>'+
	              '<div class="col-md-6">'+
	                '<b>Profesional Médico:</b> <br>'+result.paraclinico.medicoEspecialista.nombre+
	              '</div>'+
	              '<div class="col-md-12">'+
	                '<b>Diagnosticos:</b> <br>'+result.paraclinico.diagnosticos+
	              '</div>'+
	            '</div>'+
	          '</td>'+
	          '<!-- Archivo Descargable -->'+
	          '<td class="col-md-12" style="padding-bottom:0px;padding-top:0px;">'+
	            '<div class="row" style="margin-bottom: 0px;">'+
	              '<div class="col-md-12 text-center">'+
	                '<a href="'+window.location.origin+'/descargar-paraclinico/'+result.paraclinico.id+'" class="waves-effect waves-light btn blue darken-4 ver-documento" target="_blank">'+
	                  '<i class="material-icons small">insert_drive_file</i>&nbsp;<span>Ver Orden</span>'+
	                '</a>'+
	              '</div>'+
	            '</div>'+
	          '</td>'+
	        '</tr>';

	      $('#js-paraclinicos-lista-formulas').append(content_formula)

		    var nueva_orden = result.paraclinico.solicitud;
		    nueva_orden++
		    $('#p_td').val(nueva_orden)
		    $('#solicitud').val(nueva_orden)

	      $('#js-paraclinicos-lista-formulas > tr').hide()
			  $('#js-paraclinicos-lista-formulas > tr:nth-child(1)').show()
			  $('#js-paraclinicos-lista-fechas > tr.ver-formula-paciente:nth-child(1)').addClass('active')
			  $('#js-paraclinicos-lista-fechas .ver-formula-paciente').click(function(){
			    $('#js-paraclinicos-lista-fechas > tr.ver-formula-paciente[data-orden="'+result.orden.id+'"]').removeClass('active')
			    $(this).addClass('active')
			    $('#js-paraclinicos-lista-formulas > tr').hide()
			    var id_tab = $(this).data('orden')
			    $('#js-paraclinicos-lista-formulas tr[data-detalle-orden="'+id_tab+'"]').show()
			  })

	      //limpiar campos formulario
				$('#p_entidad').val(0)
				$('#p_profesional_medico').val(0)
				$('#p_entidad, #p_profesional_medico').formSelect()
				$('#diagnosticos').val('')


      }

    },
    error: function(i,o,u){
      console.log('Error al validar')
      console.log(i)
      console.log(o)
      console.log(u)
    }
  });

}


function get_entidad( id ){

  return $('#entidad option[value="'+id+'"]').html()

}

function get_profesional( id ){

  return $('#profesional_medico option[value="'+id+'"]').html()

}